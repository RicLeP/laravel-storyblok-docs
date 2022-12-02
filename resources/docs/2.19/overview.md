# Laravel Storyblok Overview

---

- Hello, if you find any problems let me know - <a href="mailto:ric@sirric.co.uk?subject=Laravel Storyblok">ric@sirric.co.uk</a>

### Use Storyblok’s amazing headless CMS in way that feels familiar to Laravel developers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/riclep/laravel-storyblok.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok)
[![Build](https://img.shields.io/scrutinizer/build/g/riclep/laravel-storyblok?style=flat-square)](https://scrutinizer-ci.com/g/riclep/laravel-storyblok)
[![Quality Score](https://img.shields.io/scrutinizer/g/riclep/laravel-storyblok.svg?style=flat-square)](https://scrutinizer-ci.com/g/riclep/laravel-storyblok)
[![Total Downloads](https://img.shields.io/packagist/dt/riclep/laravel-storyblok.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok)
[![Twitter](https://img.shields.io/twitter/follow/riclep.svg?style=social&label=Follow)](https://twitter.com/intent/follow?screen_name=riclep)


[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/M4M2C42W6)

This package allows you to use fantastic [Storyblok](https://www.storyblok.com/) headless CMS with the amazing [Laravel](https://laravel.com/) PHP framework. It’s designed to try and feel natural to Laravel developers and part of the ecosystem whilst also converting Storyblok’s API JSON responses into something powerful with minimal effort.

## Key Features

- Pages from Storyblok mapped to [PHP Pages classes](/{{route}}/{{version}}/pages) giving access to the nested content ([Blocks](/{{route}}/{{version}}/blocks)) and meta data for SEO, OpenGraph and more.
- Each Storyblok component is automatically transformed into a [PHP class](/{{route}}/{{version}}/blocks) using a simple naming convention - just match your class and component names.
- All fields in your components are converted to a [Field PHP class](/{{route}}/{{version}}/fields) allowing you to manipulate their data. The package automatically detects common types like rich text fields, assets and markdown.
- Asset fields are converted to [Assets classes](/{{route}}/{{version}}/assets) allowing you to manipulate them as required.
- Blocks and fields know where they sit in relation to their ancestors and CSS classes can be created to help your styling.
- The structure of the JSON data is preserved but super powered making it simple to loop over in your views.
- It’s simple to link to the Storyblok visual composer by including one view and calling a method for each block in your Blade.
- Request ‘[Folders](/{{route}}/{{version}}/folders)’ of content such as a list of articles or a team of people complete with pagination.
- Feels like Laravel - use date casting and accessors exactly as you would with models.
- Richer Typography with a supporting package that utilities [PHP Typography](https://github.com/mundschenk-at/php-typography).
- Live preview of text changes in the visual editor! [Live view](/{{route}}/{{version}}/linking-the-visual-editor#live-preview)
- [Image transformations](/{{route}}/{{version}}/images) and picture element generation


## Future plans

- More transformations of content
- Better support for more components types
- Cache expensive transformations
- And more…

### Changelog

[View it here](https://github.com/RicLeP/laravel-storyblok/blob/master/CHANGELOG.md)

## Contributing

Feel free to help out! 😀

### Security

If you discover any security related issues, please email <a href="mailto:ric@sirric.co.uk?subject=Laravel Storyblok">ric@sirric.co.uk</a> instead of using the issue tracker.

## Credits and thanks

- Richard Le Poidevin [GitHub](https://github.com/riclep) / [Twitter](https://twitter.com/riclep)
- [The contributors](https://github.com/RicLeP/laravel-storyblok/graphs/contributors) 😍
- [Storyblok](https://www.storyblok.com/) 😻
- [Laravel](https://laravel.com/) 🥰

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).

> {info.fa-podcast} I make a podcast with my son called The Curiosity of a Child. It’s about the world around us. We’ve covered corpse medicine, the first man to photograph the sun, pigments, oxen, gone ghost hunting, audio perception and more! [Check it out](https://www.curiosityofachild.com/)!