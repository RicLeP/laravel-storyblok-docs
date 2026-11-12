---
title: Installation
description: 'Step-by-step instructions for installing and configuring the Laravel Storyblok package.'
---

# Installation

## Installing {#installing}

You can install the package via composer by running the following command.

```php
composer require riclep/laravel-storyblok
```

---

## Configuration {#configuration}

After installing the package update your .env file with your Storyblok Content Delivery API keys and if you want to receive draft content in development:

```php
STORYBLOK_PREVIEW_API_KEY=your_preview_key
STORYBLOK_PUBLIC_API_KEY=your_public_key
STORYBLOK_DRAFT=true
```

> [!NOTE]
> Not sure where to find your API keys? [Check the Storyblok FAQs](https://www.storyblok.com/faq/where-to-find-my-content-delivery-api-key)

---

Next you need to publish the default Page and Block classes. These will be used for all your Storyblok Pages and Components unless you create your own custom instances. The default classes are published to `app/Storyblok`. This will also publish a `storyblok.php` configuration file.

```php
php artisan vendor:publish
```

---

## Routing {#routing}

The easiest way to get started is to add a catchall route to your `routes/web.php` file that directs all traffic to the package. Of course you’re still free to decide on your own routing method if you prefer. The default catchall route will map your apps route to the matching route within Storyblok.

```php
Route::get('/{slug?}', '\Riclep\Storyblok\Http\Controllers\StoryblokController@show')->where('slug', '(.*)');
```

> [!WARNING]
> If using the catch-all this should be your last route to stop it intercepting any other requests in your application.

## VueJS Configuration {#vue-js}

A big part of the magic of Storyblok is the live editor. This uses special HTML comments to link your HTML to their editor. However, VueJS will remove comments by default so make sure you update your VueJS app configuration as so:

```javascript
const app = new Vue({
	el: '#app',
	comments: true,
    ...
});
```

To add the comments to your code use the `@{!! editableBridge() !!}` method on the block, full details are in the [Blocks documentation](blocks.md).

> [!WARNING]
> If you forget to update your VueJS configuration you can waste many hours debugging why the visual editor link isn’t working. 😅
