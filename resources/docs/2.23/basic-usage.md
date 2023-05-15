# Basic usage

---

- [Determining the view to use](#determining-view)
- [Determining the Page class](#the-page-class)
- [Available data](#available-data)
- [Using draft content](#draft-content)


Once [installed](/{{route}}/{{version}}/installation) you can start working with Storyblok in your Laravel application just by creating the appropriate Blade views.

The package will consume Storyblok’s JSON responses and automatically convert them to nested PHP objects. The type of object created can be set just by matching the filename to that of the Storyblok component. This is covered in more detail in the [blocks documentation](/{{route}}/{{version}}/blocks).

The best way to understand this is to `dd($story)` in Blade file and check out the document structure.

Create the following folder `resources/views/storyblok/pages`, this is the default location where you will store all of your Blade views but you are free to use any structure you want. You can read more about how the package selects which view is loaded and how to define your own rules in the [views documentation](/{{route}}/{{version}}/views).

> {info} You can change the default view path in the `storyblok.php` configuration file

---

<a name="determining-view">
## Determining the view to use
</a>

Every `Page` has a `views()` method that returns an array of possible views to pass to Laravel’s `view()->first()` function ([see the Laravel docs](https://laravel.com/docs/7.x/views)). The package looks for a Blade file matching the name of the [Content Type](https://www.storyblok.com/docs/the-key-concept#content-types) component used for the current page in Storyblok, that doesn’t exist then `page.blade.php` will be tried.

If you have a Content Type component called `episode` being used for the page then it will look for an `episode.blade.php` file in `resources/views/storyblok/pages`.

Each `Block` implements `views()` and  `render()` methods that will give you a list of possible views to use and render the block. You can read more about this in the [blocks documentation](/{{route}}/{{version}}/blocks).

---

<a name="the-page-class">
## Determining the Page class
</a>

By default it uses the `App\Storyblok\Page` class. To provide your own object for the page create a class in `App\Storyblok\Pages` and name it as the Studly case version of the Content Type from Storyblok. Be sure to extend `Riclep\Storyblok\Page` or the website’s default `Page` if you want common functionality.

In the `episode` example above you’d create an `Episode` class like so:

```php
<?php
// episode.php

namespace App\Storyblok\Pages;

class Episode extends App\Storyblok\Page
{

}
```

<a name="available-data">
## Available Data
</a>

The selected view will be passed the complete `Page` object in a variable called `$story` which contains all the processed data for the current page. To display your content just print it to the screen, if our Episode has fields for `title`, `text` and a `nested` field containing child blocks we’d access them as so:

```html
<main>
    <header>
        <h1>{{ $story->title }}</h1>
    </header>

    <section>
        {{ $story->text }}

        <div>
        	{{ $story->nested[0]->name }}<br>
        	{{ $story->nested[0]->role }}
        </div>
    </section>
</main>

```

If the `text` field was rich-text it would automatically be converted in a `Riclep\Storyblok\Fields\RictText` class. Printing it to screen will automatically covert it to HTML.

The nested blocks will be transformed into `App\Storyblok\Block` classes and all of their fields processed and converted. You can of course override this. If the JSON for the block looked like this:

```json
{
    "name": "Richard Le Poidevin",
    "_uid": "xxx",
    "role": "Host",
    "component": "person",
    "_editable": "xxx"
}
```

Creating a class called `Person` in `App\Storyblok\Blocks` would make this block become that type. Within this block you are free to manipulate the data and fields as desired.



<a name="draft-content">
## Using draft content
</a>

By default Storyblok will only load draft content when inside their visual editor. Sometimes it’s helpful to have access to draft content during development. To load draft content outside of the editor make a new .env variable like so.

```php
STORYBLOK_DRAFT=true
```

> {warning} Be careful not to use draft content in production! Either remove the env variable or set it to false.


Every time you publish in Storyblok the webhook will clear Laravel’s cache but the package provides a `storyblok.clear-cache` route if you need to do this manually in your code. You can of course clear the cache with Artisan too. If you’re using a taggable Cache driver the package uses the `storyblok` tag.