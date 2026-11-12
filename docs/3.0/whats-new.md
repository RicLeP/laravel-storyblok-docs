---
title: 'What’s new'
description: 'Release notes and new feature highlights across Laravel Storyblok versions.'
---

# What’s new

See the [releases page](https://github.com/RicLeP/laravel-storyblok/releases) for more details.

## Version 3.0.3 {#3-0-3}

- Fixed 1-indexed pagination on `Folder` queries so requesting page 1 properly queries the first page from Storyblok.
- Refined story cache keys to incorporate language and fallback language settings to prevent translation collisions.

## Version 3.0.2 {#3-0-2}

- Fixed folder cache keys by hashing serialized request DTO parameters.
- Improved `StoriesApi` query execution when filtering by slug or UUID.

## Version 3.0.1 {#3-0-1}

- Fixed relationship resolving and link resolution when requesting stories in draft and published modes.
- Fixed `_filterRelations` handling on related blocks with the official API client.

## Version 3.0.0 {#3-0-0}

- **Official Storyblok PHP Client**: Upgraded to use Storyblok's official Content API (`storyblok/php-content-api-client`) and Management API (`storyblok/php-management-api-client`) PHP packages.
- **PHP & Laravel Requirements**: Added support for PHP 8.3, 8.4, and 8.5; requires Laravel 11, 12, or 13 (dropped Laravel 10).
- **Reworked Folders**: Custom `Folder` classes now configure default query settings fluently inside `setDefaults()`.
- **Strongly Typed Filtering & Sorting**: Folders use typed DTOs from `Storyblok\Api\Domain\Value\QueryParameter\*` (such as `PublishedAtGt`, `PublishedAtLt`, `UpdatedAtGt`, `StoryLevel`) and typed sort direction enums (`Direction::Asc`, `Direction::Desc`).
- **1-Indexed Pagination**: Folder pagination is 1-indexed and requests only the required page on demand.
- **Multilingual Caching**: Story and Folder cache keys now include language, fallback language, and request parameter hashes.

## Version 2.54.0 {#2-54-0}

- Enhanced TipTap RichText figure handling, captions, and attributes.
- Added RichText field parsing inside Table field cells.
- Fixed relation resolution for deeply nested multi-option fields.

## Version 2.53.0 {#2-53-0}

- Added support for Laravel 13.
- Updated dependencies for PHP 8.4 compatibility.

## Version 2.52.0 {#2-52-0}

- Updated `storyblok/storyblok-php-client` to 2.9.0.
- Improved link resolving with Storyblok API v2.

## Version 2.51.0 {#2-51-0}

- Added support for Laravel 12.

## Version 2.50.0 {#2-50-0}

- Added ability to override default field classes via `App\Storyblok\Fields\Default`.
- Added support for custom default `Image`, `Asset`, `RichText`, and `Markdown` field implementations.

## Version 2.49.0 {#2-49-0}

- Added support for rich-text content inside Table fields.
- Added TipTap figure extension enhancements and caption rendering.

## Version 2.48.0 {#2-48-0}

- Added Blade SVG and responsive `<picture>` element helpers.
- Improved focal point alignment calculations for transformed images.

## Version 2.47.0 {#2-47-0}

- Added multi-assets sorting support.
- Added support for nullable pages when requesting missing stories.

## Version 2.46.0 {#2-46-0}

- Added `storyblok:clear-cache` Artisan command.
- Improved webhook event listeners and cache tags invalidation.

## Version 2.45.0 {#2-45-0}

- Enhanced visual editor bridge script with fallback loading for live preview.
- Added support for custom editor bridge options.

## Version 2.44.0 {#2-44-0}

- Added configurable `DateTime` format strings and Carbon casting.
- Added configurable schema depth for Spatie Schema.org integration.

## Version 2.43.0 {#2-43-0}

- Added support for taggable cache stores with automatic cache tag assignment (`storyblok`).

## Version 2.42.0 {#2-42-0}

- Added `resolve_links` configuration option (`story`, `url`, `link`).

## Version 2.41.0 {#2-41-0}

- Added support for HTML attribute-based editor links (`{!! $story->editorLink(true) !!}`).

## Version 2.40.0 {#2-40-0}

- Added configurable `denylist` in `storyblok.php` to prevent catch-all routes from handling bot or admin requests.

## Version 2.30.0 {#2-30-0}

- Enhanced inverse relationships to return full headers and transformed stories.

## Version 2.29.0 {#2-29-0}

- Added support for registering custom TipTap extensions in RichText fields.

## Version 2.28.0 {#2-28-0}

- Added support for custom asset domain (`asset_domain`) and custom image service domain (`image_service_domain`).

## Version 2.27.0 {#2-27-0}

- Added support for PHP 8.2, PHP 8.3, and Laravel 11.

## Version 2.26.0 {#2-26-0}

- Fixed nested block default values and custom casting resolution.

## Version 2.25.0 {#2-25-0}

- Added `TrimStrings` middleware exception handling for live preview requests.

## Version 2.24.0 {#2-24-0}

- Updated Storyblok Richtext Renderer dependency.

## Version 2.23.0 {#2-23-0}

- Added page-based component view resolution hierarchy (`storyblok.pages.page-type.blocks.block-name`).

## Version 2.22.0 {#2-22-0}

- Fixed default field values on `Block` instances using `$_defaults`.

## Version 2.21.1 {#2-21-1}

- Fixed case-sensitive file extension matching for multi-asset image fields.

## Version 2.21.0 {#2-21-0}

- Laravel 10 support!
- Improved stub-views Artisan command

## Version 2.20.0 {#2-20-0}

- Added ls:page Artisan command to stub out a new page
- Set default `DateTime` string format in config
- Set `DateTime` format in `Field` class
- Empty date time fields from Storyblok are cast to empty strings

## Version 2.19.0 {#2-19-0}

- Updated `Storyblok\Client` to 2.3.0
- Added support for language and fullback language

## Version 2.18.0 {#2-18-0}

- Fixed: `stub-views` command now skips tabs
- Added: `stub-views` command now uses Block class for $block typehint in Blade if it exists
- Added: `stub-views` command now adds `transform()` default code for images
- Added: `$_defaults` property to Block class
- Added: Artisan commend for making folders
- Folder’s can now have their cache-key prefix set
- Folders sort order and field can now be separately set
- Folders have `asc()` and `desc()` methods for setting sort order
- Folders have `toArray()` method
- Many folder methods now return `$this` for chaining
- Updated `Embed/Embed` to version 4

## Version 2.17.0 {#2-17-0}

- Added the ability to specify the class to be used [when resolving related stories](requesting-pages.md#resolving-related-stories).
- Class properties have had type added - any classes that extend these classes will need to be updated to match. For example if you’re using `protected $_resolveRelations = ['something]` you’ll need to change it to `protected array $_resolveRelations = ['something]`.

## Version 2.16.0 {#2-16-0}

- Added the ability to [request inverse relationships on Blocks](requesting-pages.md#resolving-inverse-relationships).

## Version 2.15.0 {#2-15-0}

Many of the Artisan commands for managing Stories and Components have been moved to [their own package](cli.md). The commands for generating code (Block classes) specific to the Laravel Storyblok package are still available in the core package.

## Version 2.14.0 {#2-14-0}

This update extracts certain functionality into external packages to keep the core purer. The `CssClasses` and `AppliesTypography` traits have been moved and need to be installed separately if required.

- Moved `AppliesTypography` to its [own package](https://github.com/RicLeP/laravel-storyblok-typography)
- Moved `CssClasses` to its [own package](https://github.com/RicLeP/laravel-storyblok-css)
- Added `fieldsReady()` method to blocks called after fields are processed but before any self initialising traits are called
- Ignition updated to Spatie version

## Version 2.13.0 {#2-13-0}

- Updated Storyblok php client to v2.2, this had the effect of moving from v1 to v2 of their content API. This should be a seemless upgrade
- Updated to Storyblok Richtext Renderer v2
- Added support for selecting Storyblok API region in the config file

## Version 2.12.0 {#2-12-0}

- The config setting `component_class_namespace` now correctly checks multiple namespaces before loading package defaults
- **2.12.1** Added `renderUsing()` to Blocks
- **2.12.2** Added ‘auto’ to image transformations
- **2.12.5** Added `hasChildBlock()` to Blocks
- **2.12.6** Added `ls:import` and `ls:export` artisan commands

## Version 2.11.0 {#2-11-0}

- Add `with()` method to `Field`s allowing data to be passed in
- `Block`’s `render()` method can now take an array of additional data that is passed to the view
- `Folders`s no longer default to 10 stories - they will load the maximum possible Set `$perPage = 10` on your folders to restore the old functionality 

## Version 2.10.0 {#2-10-0}

- Folders now support pagination out-of-the-box
- **2.10.5** The Storyblok API is now called using SSL by default - can be changed in config file
- **2.10.5** `Image` field focal-point alignment CSS helper

## Version 2.9.0 {#2-9-0}

- The Storyblok publish webhook now fires the `Riclep\Storyblok\Events\StoryblokPublished` event allow you to hook into this functionality

## Version 2.8.0 {#2-8-0}

- Support for the new Storyblok image service URL format
- Image transformations now use a driver class meaning more services can be supported

## Version 2.7.0 {#2-7-0}

- Upgraded to CommonMark 2.0
- **2.7.3** Added `srcset()` method to images to create `<img>` tag using your transformations
- **2.7.4** Unpublished relations no longer 404

## Version 2.6.0 {#2-6-0}

- Live preview of changes in the visual editor!
- Removed old ‘live field’ support as it didn’t work well

## Version 2.5.0 {#2-5-0}

- Added support components in [Rich text Fields](fields.md) 
- **2.5.16** Added `ls:stub-views` command to scaffold Blade files for each component
- **2.5.22** Create picture elements directly in Blade

## Version 2.4.0 {#2-4-0}

- [Embed media](embedding-media.md) such as Twitter and YouTube in Fields

## Version 2.3.0 {#2-3-0}

- Legacy images are converted into [Image](images.md) classes.
- [Tables Fields](fields.md#table-field) can now have a caption and CSS class specified.
- **2.3.2** Added support for clearing cache via the Storyblok Publish webhook. This means the Editor Bridge Blade view has had the JavaScript publish event removed.

## Version 2.2.0 {#2-2-0}

- Added support for [image transformations](images.md) in the visual editor

## Version 2.1.0 {#2-1-0}

- Added support for the [live preview](linking-the-visual-editor.md#live-preview) in the visual editor

- Table fields are now automatically converted to HTML

## Version 2.0.0 {#2-0-0}

- A complete rewrite of the entire package
- Added new Field classes (previously everything was a Block)
- Automatically detect common field types such as richtext and assets and convert them into the appropiate format.
- Remove the need to manually specify markdown and richtext fields
- Lots of tweaks and bug fixes

## Version 1.2.0 {#1-2-0}

- Blocks now have a `parent()` method which returns the parent Block or Page if you’re on the root Block
- Blocks have a `page()` method returning the Page the block is part of
- Added Schema.org support using [Spatie’s Schema.org package](https://github.com/spatie/schema-org)
- Full Page object is now passed to views

## Version 1.1.0 {#1-1-0}

- Blocks now have a _compontentPath array which includes the current and all parent components. This enables you to work out the context of the current Block.
- New CssClassses trait that can be used to generated css classes for the current Block, the layout it’s in, it’s parent Blocks etc.
- Traits added to Blocks can be auto-initialised
