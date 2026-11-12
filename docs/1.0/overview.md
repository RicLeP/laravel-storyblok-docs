---
title: Overview
description: 'Overview of the Laravel Storyblok package for building headless CMS applications in Laravel.'
---

# Overview

---

- Hello, if you find any problems let me know - [ric@sirric.co.uk](mailto:ric@sirric.co.uk?subject=Laravel%20Storyblok)

### Use Storyblok’s amazing headless CMS in way that feels familiar to Laravel developers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/riclep/laravel-storyblok.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok)
[![Build Status](https://img.shields.io/travis/riclep/laravel-storyblok/master.svg?style=flat-square)](https://travis-ci.org/riclep/laravel-storyblok)
[![Quality Score](https://img.shields.io/scrutinizer/g/riclep/laravel-storyblok.svg?style=flat-square)](https://scrutinizer-ci.com/g/riclep/laravel-storyblok)
[![Total Downloads](https://img.shields.io/packagist/dt/riclep/laravel-storyblok.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok)

This package allows you to use fantastic [Storyblok](https://www.storyblok.com/) headless CMS with the amazing [Laravel](https://laravel.com/) PHP framework. It’s designed to try and feel natural to Laravel developers and part of the ecosystem whilst also converting Storyblok’s API JSON responses into something powerful with minimal effort.

## Key Features

- Pages from Storyblok mapped to [PHP Pages classes](pages.md) giving access to the nest content ([Blocks](blocks.md)) and meta data for SEO, OpenGraph and more
- Each Storyblok component is automatically transformed into a [PHP class](blocks.md) using a simple naming convention - just match your class and component names
- The structure of the JSON data is preserved but super powered making it simple to loop over in your views
- Simple to link to the Storyblok visual composer
- Request ‘[Folders](folders.md)’ of content such as a list of articles or a team of people
- Feels like Laravel - use date casting and accessors exactly as you would with models
- Built in support for Storyblok Markdown and Richtext fields - just add a property to your class
- Richer Typography with [PHP Typography](https://github.com/mundschenk-at/php-typography) baked in

## Future plans

- More transformations of content
- Better support for more components types
- Better image transformation
- Cache expensive transformations
- And more…

### Changelog

[View it here](https://github.com/RicLeP/laravel-storyblok/blob/master/CHANGELOG.md)

## Contributing

Feel free to help out! 😀

### Security

If you discover any security related issues, please email [ric@sirric.co.uk](mailto:ric@sirric.co.uk?subject=Laravel%20Storyblok) instead of using the issue tracker.

## Credits and thanks

- Richard Le Poidevin [GitHub](https://github.com/riclep) / [Twitter](https://twitter.com/riclep)
- [Storyblok](https://www.storyblok.com/) 😻
- [Laravel](https://laravel.com/) 🥰

## License

The MIT License (MIT). Please see [License File](https://github.com/RicLeP/laravel-storyblok/blob/master/LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
