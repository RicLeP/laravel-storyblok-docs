---
title: Installation
description: 'Step-by-step instructions for installing and configuring the Laravel Storyblok package.'
---

# Installation

## Installing {#installing}

You can install the package via composer by running the following command.

```bash
composer require riclep/laravel-storyblok
```

---

## Configuration {#configuration}

After installing the package update your `.env` file with your Storyblok Content Delivery API keys and specify if you want to receive draft content.

```env
STORYBLOK_PREVIEW_API_KEY=your_preview_key
STORYBLOK_PUBLIC_API_KEY=your_public_key
STORYBLOK_DRAFT=true
STORYBLOK_WEBHOOK_SECRET=someComplexKeySuchAsAHash #free Storyblok plans don’t use a secret
```

### Artisan commands

To use the Artisan generator commands you’ll also need to specify your Space ID and OAuth Token.

```env
STORYBLOK_SPACE_ID=your_space_id
STORYBLOK_OAUTH_TOKEN=your_oauth_token
```

### Webhooks

The webhook handler responds to `publish`, `unpublish` and `delete` Story webhooks. In Storyblok’s settings add the ‘Story published & unpublished’ [webhook URL](https://www.storyblok.com/docs/guide/in-depth/webhooks) as so: https://[yourdomain]/api/laravel-storyblok/webhook/publish. Make sure this is the exact URL as the webhook will not follow redirections on your server such as going from www to non-www. Next create your webhook secret in Storyblok and copy this to your `.env` file.

In **Laravel 11+** register the event listeners in `App\Providers\AppServiceProvider`. See the [Laravel docs for more on events](https://laravel.com/docs/events#registering-events-and-listeners).

```php
use Illuminate\Support\Facades\Event;
use Riclep\Storyblok\Events\StoryblokPublished;
use Riclep\Storyblok\Events\StoryblokUnpublished;
use Riclep\Storyblok\Listeners\ClearCache;

public function boot(): void
{
    Event::listen(
        StoryblokPublished::class,
        ClearCache::class,
    );

    Event::listen(
        StoryblokUnpublished::class,
        ClearCache::class,
    );
}
```

> [!NOTE]
> The default webhook only clears the Laravel cache of the saved API responses. If you need something more sophisticated implement your own functionality. See the [Storyblok webhook docs](https://www.storyblok.com/docs/Guides/using-storyblok-webhooks). The listeners receive the webhook JSON in the `handle(PublishingEvent $event)` method as so: `$event->webhookPayload`.

If you need to test or debug your webhooks locally I highly recommend [ngrok](https://ngrok.com/).

> [!NOTE]
> Not sure where to find your API keys? [Check the Storyblok FAQs](https://www.storyblok.com/faq/where-to-find-my-content-delivery-api-key)

---

Next you need to publish the default Page and Block classes. These will be used for all your Storyblok Pages and Components but can be overridden by your own classes. The default classes are published to `app/Storyblok`. This will also publish a `storyblok.php` configuration file.

```bash
php artisan vendor:publish --tag=storyblok
```

---

## Routing {#routing}

The easiest way to get started is to add a catchall route to your `routes/web.php` file that directs all traffic to the package. Of course you’re still free to decide on your own routing method if you prefer. The default catchall route will map your apps route to the matching route within Storyblok.

```php
// routes/web.php
use Riclep\Storyblok\Http\Controllers\StoryblokController;

// Catch-all route for Storyblok - this may lead to a lot of 404s from their API as it matches everything
Route::get('/{slug?}', [StoryblokController::class, 'show'])->where('slug', '(.*)');

// Or a more specific route that doesn't match the img folder
Route::get('/{slug?}', [StoryblokController::class, 'show'])->where('slug', '^(?!img).*$');
```

> [!NOTE]
> To stop the catch-all route from matching bot traffic you should configure the `denylist` in your `storyblok.php` configuration file.

> [!WARNING]
> If using the catch-all this should be your last route to stop it intercepting any other requests in your application.

**Since 2.40.0**

For more control over which routes are excluded from the catch-all add a list of exclusions to the `storyblok.php` configuration file.
The array can contain strings or regular expressions.

```php
'denylist' => [
    '/^\.well-known\/.*$/',
    'another-bad-slug',
    '/^admin\/.*$/',
    '/\.(php|sqt|exe)$/',
],
```

The package also creates a named route that posts to `storyblok.clear-cache` which is used when publishing in the visual editor.

### Link the visual editor

To finalise setting up the package see [linking to the visual editor](linking-the-visual-editor.md).

To add the link to your code use the Block’s `{!! $someBlock->editorLink() !!}` method, this adds a HTML comment prior the the block when in edit mode. You can also add a attribute to an HTML tag `<section {{ $someBlock->editorLink(true) }}>`. For more see [linking to the visual editor](linking-the-visual-editor.md).

> [!WARNING]
> If you forget to update your VueJS configuration you can waste many hours debugging why the visual editor link isn’t working! 😅
