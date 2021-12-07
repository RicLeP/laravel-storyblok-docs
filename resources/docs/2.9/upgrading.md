# Upgrading

---

## 2.8.0 -> 2.9.0

If you are using the default package webhook handler this functionality has changed to use Laravel events. Make sure you register this in your `App\Providers\EventServiceProvider`.

```php
use Riclep\Storyblok\Events\StoryblokPublished;
use Riclep\Storyblok\Listeners\ClearCache;

/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    StoryblokPublished::class => [
        ClearCache::class,
    ],
];
```

## 2.7.0 -> 2.8.0

The updated image transformation service requires you to define a transformer in the Storyblok config file. The default transformer is `Riclep\Storyblok\Support\ImageTransformers\Storyblok` which uses the [new image service URLs](https://www.storyblok.com/docs/image-service#migrating-from-the-previous-version-of-the-service). To use your own set the config `image_transformer` key.

The `meta()` width and height details have been removed from image fields as each transformer will offer different features. Image field contains a `width()` and `height()` methods which will check the transformer for values or the image if not transformed.

Two config keys have been renamed with underscores for consistency: `live-preview` -> `live_preview` and `live-element` -> `live_element`. The package template files have been updated but any custom files will need amending.



## 2.5.0 -> 2.6.0

To enable [live preview support](/{{route}}/{{version}}/linking-the-visual-editor#live-preview) include the latest `laravel-storyblok::editor-bridge` in your view and adding the required wrapping element and configuration options.


## 2.3.1 -> 2.3.2

Set up the publishing webhook as specified in the installation instructions. Removed the JavaScript published event from the Editor Bridge Blade view.


## 2.2.0 -> 2.3.0

Legacy image fields are now converted to [Image](/{{route}}/{{version}}/images) classes.


## 2.1.0 -> 2.2.0

The `$casts` property on Blocks has been renamed to `$_casts` to reduce the likelihood of clashing with field names.

