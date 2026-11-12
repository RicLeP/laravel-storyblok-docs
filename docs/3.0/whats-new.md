---
title: 'What’s new'
description: 'Release notes and new feature highlights across Laravel Storyblok versions.'
---

# What’s new

See the [releases page](https://github.com/RicLeP/laravel-storyblok/releases) for more details.

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
