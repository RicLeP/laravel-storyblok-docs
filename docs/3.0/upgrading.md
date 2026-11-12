---
title: Upgrading
description: 'Upgrade guides and breaking changes for Laravel Storyblok releases.'
---

# Upgrading

---

## 2.x -> 3.0.0

Version 3 updates Laravel Storyblok to use Storyblok's official Content API and Management API PHP clients (`storyblok/php-content-api-client` and `storyblok/php-management-api-client`). While most Page, Block, and Field implementations remain backward compatible, Folder classes and folder querying have been heavily reworked.

### Updating dependencies

Version 3 requires:
- PHP 8.3, 8.4, or 8.5
- Laravel 11, 12, or 13 (Laravel 10 support is dropped)

Update your `composer.json` requirement:

```json
"riclep/laravel-storyblok": "^3.0"
```

Then run:

```bash
composer update riclep/laravel-storyblok -W
```

### Folder classes and `setDefaults()`

In version 2, custom `Folder` classes set default query parameters using class properties (such as `protected string $slug` or `protected string $sortBy`) or by calling `$this->settings([...])` inside the constructor.

In version 3, folder defaults must be configured inside a `protected function setDefaults(): void` method using fluent configuration methods:

<CodeGroup>
```php v2
namespace App\Storyblok\Folders;

use App\Storyblok\Folder;

class Speakers extends Folder
{
    protected string $slug = 'speakers';
    protected string $sortBy = 'content.year:desc, content.surname:asc';

    public function __construct()
    {
        // $this->settings(['per_page' => 10]);
    }
}
```

```php v3
namespace App\Storyblok\Folders;

use App\Storyblok\Folder;
use Storyblok\Api\Domain\Value\Dto\Direction;

class Speakers extends Folder
{
    protected function setDefaults(): void
    {
        $this->slug('speakers')
            ->startPage(false)
            ->sort('content.year', Direction::Desc)
            ->sort('content.surname', Direction::Asc)
            ->perPage(11);
    }
}
```
</CodeGroup>

### Fluent sorting and typed query parameters

Sorting and filtering on `Folder` instances now use strongly typed methods and DTOs from the official Storyblok client:

- **Sorting**: The `sort()` method accepts the field name and a `Storyblok\Api\Domain\Value\Dto\Direction` enum (`Direction::Asc` or `Direction::Desc`). Helper methods `asc($field)` and `desc($field)` remain available.
- **Typed filters**: Filters accept parameter objects from `Storyblok\Api\Domain\Value\QueryParameter\*` (such as `PublishedAtGt`, `PublishedAtLt`, `FirstPublishedAtGt`, `FirstPublishedAtLt`, `UpdatedAtGt`, `UpdatedAtLt`, and `StoryLevel`).

```php
use Storyblok\Api\Domain\Value\Dto\Direction;
use Storyblok\Api\Domain\Value\QueryParameter\PublishedAtGt;

$folder = new Folder();
$stories = $folder->slug('news')
    ->sort('content.date', Direction::Desc)
    ->publishedAtGt(new PublishedAtGt('2024-01-01 00:00'))
    ->perPage(10)
    ->read();
```

See the [Folders documentation](folders.md) for full details on querying folders.

### Folder pagination

Folder pagination is 1-indexed (page 1 is the initial page) and queries the requested page on demand. If your application customized pagination offsets or query parameters, ensure it expects 1-indexed page numbers with Laravel's `LengthAwarePaginator`.

### Official Storyblok API clients

Version 3 replaces `riclep/storyblok-php-client` with the official `storyblok/php-content-api-client` and `storyblok/php-management-api-client` packages.

If your application accessed underlying client methods directly via `$storyblok->getStoryblok()`, update those calls to use the official Storyblok Content API client interface and value objects.

### Multilingual caching and cache invalidation

Story cache keys now include the requested language and fallback language to prevent collisions across translations. Folder responses are cached based on a hash of the serialized request parameters.

Clear the application cache after upgrading:

```bash
php artisan cache:clear
```

---

## 2.17.0

Class properties have had type added - any classes that extend these classes will need to be updated to match. For example if you’re using `protected $_resolveRelations = ['something]` you’ll need to change it to `protected array $_resolveRelations = ['something]`.

## 2.13.0 -> 2.14.0

If you use either the `AppliesTypography` or `CssClasses` traits these have been moved to separate packages and must be installed and the namespace updated. see:
- [AppliesTypography](typography.md)
- [CSSClasses](css-classes.md)

## 2.9.0 -> 2.10.0

Folders have been reworked with the stories now sitting under the `stories` property. They also now support pagination.

```php
@foreach ($news->stories as $article)
    {{ $article->title }}
@endforeach

{!! $news->paginate()->links() !!}
```

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
    StoryblokUnpublished::class => [
		ClearCache::class
	]
];
```

## 2.7.0 -> 2.8.0

The updated image transformation service requires you to define a transformer in the Storyblok config file. The default transformer is `Riclep\Storyblok\Support\ImageTransformers\Storyblok` which uses the [new image service URLs](https://www.storyblok.com/docs/image-service#migrating-from-the-previous-version-of-the-service). To use your own set the config `image_transformer` key.

The `meta()` width and height details have been removed from image fields as each transformer will offer different features. Image field contains a `width()` and `height()` methods which will check the transformer for values or the image if not transformed.

Two config keys have been renamed with underscores for consistency: `live-preview` -> `live_preview` and `live-element` -> `live_element`. The package template files have been updated but any custom files will need amending.

## 2.5.0 -> 2.6.0

To enable [live preview support](linking-the-visual-editor.md#live-preview) include the latest `laravel-storyblok::editor-bridge` in your view and adding the required wrapping element and configuration options.

## 2.3.1 -> 2.3.2

Set up the publishing webhook as specified in the installation instructions. Removed the JavaScript published event from the Editor Bridge Blade view.

## 2.2.0 -> 2.3.0

Legacy image fields are now converted to [Image](images.md) classes.

## 2.1.0 -> 2.2.0

The `$casts` property on Blocks has been renamed to `$_casts` to reduce the likelihood of clashing with field names.
