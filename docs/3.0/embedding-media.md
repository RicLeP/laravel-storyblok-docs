---
title: 'Embedding Media'
description: 'Embedding external media like YouTube and Twitter into Storyblok fields.'
---

# Embedding Media

[![Latest Version on Packagist](https://img.shields.io/packagist/v/riclep/laravel-storyblok-embed.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok-embed)
[![Total Downloads](https://img.shields.io/packagist/dt/riclep/laravel-storyblok-embed.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok-embed)
[![Twitter](https://img.shields.io/twitter/follow/riclep.svg?style=social&label=Follow)](https://twitter.com/intent/follow?screen_name=riclep)

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/M4M2C42W6)

Use the fantastic [Embed package by Óscar Otero](https://github.com/oscarotero/Embed) to embed nearly anything in your website - YouTube videos, Tweets, Instagram images etc.

This is a simple wrapper to get you started.

## Installation

You can install the package via composer:

```bash
composer require riclep/laravel-storyblok-embed
```

To make a [Field](fields.md) embeddable simply add the `EmbedsMedia` trait. Your field should be of type ‘text’ and return a URL of what you’re wanting to embed.

Requested media responses are cached to avoid requesting them on every page load. By default the duration is identical to that of your Laravel Storyblok cache settings but can be overridden in the config file if published.

```php
<?php

namespace App\Storyblok\Fields;

use Riclep\Storyblok\Field;
use Riclep\StoryblokEmbed\Traits\EmbedsMedia;

class YouTubeVideo extends Field
{
	use EmbedsMedia;
}
```

The `EmbedsMedia` trait adds a `render()` method to your field which will return the HTML for the embedded media. The returned HTML is generated using a Blade view which you can customise by publishing the package’s views.

> [!WARNING]
> Embedding lots of media in a page can be slow as it needs to be requested when the page loads. Although the package will cache the response you may be better asynchronously loading the media after the page has loaded.

```blade
{{-- uses /vendor/riclep/laravel-storyblok-embed/src/resources/views/default.blade.php --}}

{!! $block->you_tube_video->render() !!}
```

Each different embedded source will return different fields - see the [Embed package documentation](https://github.com/oscarotero/Embed) for more information. As we can’t serialize the Embed object for caching we return a subset of the data. The following fields are available (depending on the media source):

```php
[
    'title' => $response->title,
    'description' => $response->description,
    'url' => (string) $response->url,
    'keywords' => $response->keywords,
    'image' => $response->image,
    'code' => $response->code,
    'feeds' => $response->feeds,
    'authorName' => $response->authorName,
    'authorUrl' => (string) $response->authorUrl,
    'providerName' => $response->providerName,
    'publishedTime' => $response->publishedTime,
    'language' => $response->language,
];
```

If you want to specify a different view to use for rendering the embed you can pass the view name as the first parameter to the `renderWith()` method.

```blade
{!! $block->you_tube_video->renderWith('some-view') !!}
```

## Code based embeds {#code-based-embeds}

Some sources such as Twitter will return a `code` field which is the HTML for the embedded media. This is the default view used to render the media. Twitter and some other media require a `<script>` tag to render their code. As placing `<script>` tags willy-nilly throughout your HTML isn’t ideal and can causes errors if using libraries like Vue we extract them into a Laravel Stack called `ls-embed-scripts`. Remember to include the stack in your layout.

```blade
@stack('ls-embed-scripts')
```

## Customising the embeds {#customising-the-embeds}

You can publish the package’s view and config files with:

```bash
php artisan vendor:publish --provider="Riclep\StoryblokEmbed\StoryblokEmbedServiceProvider"
```
