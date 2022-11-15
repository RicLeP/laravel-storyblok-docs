# What’s new

---


- [Version 2.16.0](#2-16-0)
- [Version 2.15.0](#2-15-0)
- [Version 2.14.0](#2-14-0)
- [Version 2.13.0](#2-13-0)
- [Version 2.12.0](#2-12-0)
- [Version 2.11.0](#2-11-0)
- [Version 2.10.0](#2-10-0)
- [Version 2.9.0](#2-9-0)
- [Version 2.8.0](#2-8-0)
- [Version 2.7.0](#2-7-0)
- [Version 2.6.0](#2-6-0)
- [Version 2.5.0](#2-5-0)
- [Version 2.4.0](#2-4-0)
- [Version 2.3.0](#2-3-0)
- [Version 2.2.0](#2-2-0)
- [Version 2.1.0](#2-1-0)
- [Version 2.0.0](#2-0-0)
- [Version 1.2.0](#1-2-0)
- [Version 1.1.0](#1-1-0)


<a name="2-16-0">
## Version 2.16.0
</a>

Added the ability to [request inverse relationships on Blocks](/{{route}}/{{version}}/requesting-pages#resolving-inverse-relationships).


<a name="2-15-0">
## Version 2.15.0
</a>

Many of the Artisan commands for managing Stories and Components have been moved to [their own package](/{{route}}/{{version}}/cli). The commands for generating code (Block classes) specific to the Laravel Storyblok package are still available in the core package.

<a name="2-14-0">
## Version 2.14.0
</a>

This update extracts certain functionality into external packages to keep the core purer. The `CssClasses` and `AppliesTypography` traits have been moved and need to be installed separately if required.

- Moved `AppliesTypography` to its [own package](https://github.com/RicLeP/laravel-storyblok-typography)
- Moved `CssClasses` to its [own package](https://github.com/RicLeP/laravel-storyblok-css)
- Added `fieldsReady()` method to blocks called after fields are processed but before any self initialising traits are called
- Ignition updated to Spatie version


<a name="2-13-0">
## Version 2.13.0
</a>

- Updated Storyblok php client to v2.2, this had the effect of moving from v1 to v2 of their content API. This should be a seemless upgrade
- Updated to Storyblok Richtext Renderer v2
- Added support for selecting Storyblok API region in the config file


<a name="2-12-0">
## Version 2.12.0
</a>

- The config setting `component_class_namespace` now correctly checks multiple namespaces before loading package defaults
- **2.12.1** Added `renderUsing()` to Blocks
- **2.12.2** Added ‘auto’ to image transformations
- **2.12.5** Added `hasChildBlock()` to Blocks
- **2.12.6** Added `ls:import` and `ls:export` artisan commands


<a name="2-11-0">
## Version 2.11.0
</a>

- Add `with()` method to `Field`s allowing data to be passed in
- `Block`’s `render()` method can now take an array of additional data that is passed to the view
- `Folders`s no longer default to 10 stories - they will load the maximum possible Set `$perPage = 10` on your folders to restore the old functionality 


<a name="2-10-0">
## Version 2.10.0
</a>

- Folders now support pagination out-of-the-box
- **2.10.5** The Storyblok API is now called using SSL by default - can be changed in config file
- **2.10.5** `Image` field focal-point alignment CSS helper

<a name="2-9-0">
## Version 2.9.0
</a>

- The Storyblok publish webhook now fires the `Riclep\Storyblok\Events\StoryblokPublished` event allow you to hook into this functionality


<a name="2-8-0">
## Version 2.8.0
</a>

- Support for the new Storyblok image service URL format
- Image transformations now use a driver class meaning more services can be supported


<a name="2-7-0">
## Version 2.7.0
</a>

- Upgraded to CommonMark 2.0
- **2.7.3** Added `srcset()` method to images to create `<img>` tag using your transformations
- **2.7.4** Unpublished relations no longer 404


<a name="2-6-0">
## Version 2.6.0
</a>

- Live preview of changes in the visual editor!
- Removed old ‘live field’ support as it didn’t work well

<a name="2-5-0">
## Version 2.5.0
</a>

- Added support components in [Rich text Fields](/{{route}}/{{version}}/fields) 
- **2.5.16** Added `ls:stub-views` command to scaffold Blade files for each component
- **2.5.22** Create picture elements directly in Blade

<a name="2-4-0">
## Version 2.4.0
</a>

- [Embed media](/{{route}}/{{version}}/embedding-media) such as Twitter and YouTube in Fields


<a name="2-3-0">
## Version 2.3.0
</a>

- Legacy images are converted into [Image](/{{route}}/{{version}}/images) classes.
- [Tables Fields](/{{route}}/{{version}}/fields#table-field) can now have a caption and CSS class specified.
- **2.3.2** Added support for clearing cache via the Storyblok Publish webhook. This means the Editor Bridge Blade view has had the JavaScript publish event removed.


<a name="2-2-0">
## Version 2.2.0
</a>

- Added support for [image transformations](/{{route}}/{{version}}/images) in the visual editor


<a name="2-1-0">
## Version 2.1.0
</a>

- Added support for the [live preview](/{{route}}/{{version}}/linking-the-visual-editor#live-view) in the visual editor

- Table fields are now automatically converted to HTML

<a name="2-0-0">
## Version 2.0.0
</a>

- A complete rewrite of the entire package
- Added new Field classes (previously everything was a Block)
- Automatically detect common field types such as richtext and assets and convert them into the appropiate format.
- Remove the need to manually specify markdown and richtext fields
- Lots of tweaks and bug fixes

<a name="1-2-0">
## Version 1.2.0
</a>

- Blocks now have a `parent()` method which returns the parent Block or Page if you’re on the root Block
- Blocks have a `page()` method returning the Page the block is part of
- Added Schema.org support using [Spatie’s Schema.org package](https://github.com/spatie/schema-org)
- Full Page object is now passed to views


<a name="1-1-0">
## Version 1.1.0
</a>

- Blocks now have a _compontentPath array which includes the current and all parent components. This enables you to work out the context of the current Block.
- New CssClassses trait that can be used to generated css classes for the current Block, the layout it’s in, it’s parent Blocks etc.
- Traits added to Blocks can be auto-initialised


