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

After installing the package update your .env file with your Storyblok Content Delivery API keys and specify if you want to receive draft content in development:

```php
STORYBLOK_PREVIEW_API_KEY=your_preview_key
STORYBLOK_PUBLIC_API_KEY=your_public_key
STORYBLOK_DRAFT=true
```

> {info} Not sure where to find your API keys? [Check the Storyblok FAQs](https://www.storyblok.com/faq/where-to-find-my-content-delivery-api-key)

---

Next you need to publish the default Page and Block classes. These will be used for all your Storyblok Pages and Components but can be overridden by your own classes. The default classes are published to `app/Storyblok`. This will also publish a `storyblok.php` configuration file.

```php
php artisan vendor:publish
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

The package also creates a named route that posts to `clear-storyblok-cache` which is used when publishing in the visual editor. See [linking to the visual editor](/{{route}}/{{version}}/linking-the-visual-editor).

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