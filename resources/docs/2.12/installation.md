# Installation

---

- [Installing](#installing)
- [Configuration](#configuration)
- [Routing](#routing)
- [VueJS Configuration](#vue-js)

<a name="installing">
## Installing
</a>

You can install the package via composer by running the following command.

```php
composer require riclep/laravel-storyblok
```

---

<a name="configuration">
## Configuration
</a>

After installing the package update your `.env` file with your Storyblok Content Delivery API keys and specify if you want to receive draft content.

```php
STORYBLOK_PREVIEW_API_KEY=your_preview_key
STORYBLOK_PUBLIC_API_KEY=your_public_key
STORYBLOK_DRAFT=true
STORYBLOK_WEBHOOK_SECRET=someComplexKeySuchAsAHash
```

### Webhooks

The webhook handler responds to `publish`, `unpublish` and `delete` Story webhooks. In Storyblok’s settings add the ‘Story published & unpublished’ [webhook URL](https://www.storyblok.com/docs/guide/in-depth/webhooks) as so: https://[yourdomain]/api/laravel-storyblok/webhook/publish. Make sure this is the exact URL as the webhook will not follow redirections on your server such as going from www to non-www. Next create your webhook secret in Storyblok and copy this to your `.env` file. Finally register the event listeners in `App\Providers\EventServiceProvider`. See the [Laravel docs for more on events](https://laravel.com/docs/8.x/events#registering-events-and-listeners).

```php
use Riclep\Storyblok\Events\StoryblokPublished;
use Riclep\Storyblok\Listeners\ClearCache;

/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    // published webhook
    StoryblokPublished::class => [
		ClearCache::class
	],
	// unpublished / deleted webhook
	StoryblokUnpublished::class => [
		ClearCache::class
	]
];
```

> {info} The default webhook only clears the Laravel cache of the saved API responses. If you need something more sophisticated implement your own functionality. See the [Storyblok webhook docs](https://www.storyblok.com/docs/Guides/using-storyblok-webhooks). The listeners receive the webhook JSON in the `handle(PublishingEvent $event)` method as so: `$event->webhookPayload`.

If you need to test or debug your webhooks locally I highly recommend [ngrok](https://ngrok.com/).

### Artisan commands

To use the Artisan generator commands you’ll also need to specify your Space ID and OAuth Token.

```php
STORYBLOK_SPACE_ID=your_space_id
STORYBLOK_OAUTH_TOKEN=your_oauth_token
```


> {info} Not sure where to find your API keys? [Check the Storyblok FAQs](https://www.storyblok.com/faq/where-to-find-my-content-delivery-api-key)

---

Next you need to publish the default Page and Block classes. These will be used for all your Storyblok Pages and Components but can be overridden by your own classes. The default classes are published to `app/Storyblok`. This will also publish a `storyblok.php` configuration file.

```php
php artisan vendor:publish --tag=storyblok
```

---

<a name="routing">
## Routing
</a>

The easiest way to get started is to add a catchall route to your `routes/web.php` file that directs all traffic to the package. Of course you’re still free to decide on your own routing method if you prefer. The default catchall route will map your apps route to the matching route within Storyblok.

```php
Route::get('/{slug?}', '\Riclep\Storyblok\Http\Controllers\StoryblokController@show')->where('slug', '(.*)');
```

> {warning} If using the catch-all this should be your last route to stop it intercepting any other requests in your application.

The package also creates a named route that posts to `storyblok.clear-cache` which is used when publishing in the visual editor.

### Link the visual editor

To finalise setting up the package see [linking to the visual editor](/{{route}}/{{version}}/linking-the-visual-editor).

<a name="vue-js">
## VueJS Configuration
</a>

A big part of the magic of Storyblok is the live editor. This uses special HTML comments to link your HTML to their editor. However, VueJS will remove comments by default so make sure you update your VueJS app configuration as so:

```javascript
const app = new Vue({
	el: '#app',
	comments: true,
    ...
});
```

To add the link to your code use the Block’s `@{!! $someBlock->editorLink() !!}` method, for more see [linking to the visual editor](/{{route}}/{{version}}/linking-the-visual-editor).

> {warning} If you forget to update your VueJS configuration you can waste many hours debugging why the visual editor link isn’t working! 😅
