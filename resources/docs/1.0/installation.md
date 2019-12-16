# Installation

---

- [Installing](#installing)
- [Configuration](#configuration)
- [Routing](#routing)

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

After installing the package update your .env file with your Storyblok Content Delivery API Key:

```php
STORYBLOK_API_KEY=yourkeyhere
```

> {info} Not sure where to find your API key? [Check their FAQs](https://www.storyblok.com/faq/where-to-find-my-content-delivery-api-key)

---

Next you need to publish the default Page and Block classes. These will be used for all your Storyblok Pages and Components unless you create your own custom instances. The default classes are published to `app/Storyblok`. This will also publish a `storyblok.php` configuration file.

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