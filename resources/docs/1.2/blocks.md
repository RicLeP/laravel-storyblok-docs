# Blocks

---

- [Running methods upon creation](#running-methods-upon-creation)
- [Getting a Block’s position](#getting-a-blocks-position)
- [Date casting](#date-casting)
- [Markdown](#markdown)
- [Richtext](#richtext)
- [Automatically adding paragraphs](#adding-paragraphs)
- [Accessors](#accessors)
- [Linking to the visual editor](#editable-comment-link)
- [Schema.org data](#schema-org-data)


Blocks are the key err.. building block of your pages. Every Storyblok component is transformed into a Block class. The class they become is determined by the component’s name - if you have a matching Block class that will be used, for example a component called `cat-images` transforms into `App\Storyblok\Blocks\CatImages` if available. Blocks should extend `Riclep\Storyblok\Block` or `App\Storyblok\DefaultBlock`.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;

class CatImages extends Block
{

}
```

You can get a Block’s parent with the `parent()` method and the `Page` by calling `page()`.


<a name="running-methods-upon-creation">
## Running methods upon creation
</a>

Sometimes you may want to run some code when a Block is created. To do this implement an `init()` method on your block. This is run after any built-in transformations outlined below and is free to modify the Block and it’s contents as required. 

---

## Built in methods

Blocks borrow some concepts from Laravel’s Eloquent models to make using them feel familiar such as creating accessors or casting variables to dates, but we don’t stop there, we also have a bunch of helpful features for Storyblok content - automatically transforming markdown fields, apply typographical fixes and flourishes or returning rendered HTML - we want to help make building websites enjoyable. 

---

<a name="getting-a-blocks-position">
## Getting a Block’s position
</a>

Sometimes it’s useful to know the parent and ancestors of the current Block. Every Block has a `_componentPath` property which is an array of the names of every Storyblok component passed through to reach the current point. There are several methods to help you work with this informtion.

```php
// Returns the current component’s name
$currentComponent->component(); // 'current-component'

// Returns the current path 
$currentComponent->componentPath(); // ['root-component', 'ancestor-component', 'parent-component', 'current-component']

// Checks if a compontent has a particular child
$parentComponent->hasChildComponent('current-component'); // true
$parentComponent->hasChildComponent('something-else'); // false

// Returns the component name ‘x’ generations ago
$currentComponent->getAncestorComponent(2); // 'ancestor-component'

// Checks if this has a certain parent
$currentComponent->isChildOf('parent'); // true

// Checks if this has a certain ancestor
$currentComponent->isAncestorOf('ancestor-component'); // true
```

Wouldn’t it be great to be able to create CSS classes when working in Blade that help you style nested Blocks? Don’t worry, [we have you covered](/{{route}}/{{version}}/views#creating-css-class-names).

---

<a name="date-casting">
## Date casting
</a>

When using Storyblok’s Date/Time field you’ll probably want to convert it into something more handy to use in PHP. Simply define a `$dates` property on your Block containing an array of field names and we’ll convert them to [Carbon](https://github.com/briannesbitt/carbon) objects. 

```php
protected $dates = ['release_date'];
```

---

<a name="markdown">
## Markdown
</a>

Storyblok includes Markdown fields (with an optional visual editor that’s perfect for clients!) and we make it super easy to convert them to HTML. Just add a `$markdown` property containing an array of field names and, hey presto, we magically create an HTML version thanks to the power of [CommonMark](https://commonmark.thephpleague.com/). We keep your original field untouched should you wish to do anything else with it and create a duplicate suffixed with `_html`.

```php
// creates a new content item called $interesting_story_html
protected $markdown = ['interesting_story'];
```

---

<a name="richtext">
## Richtext
</a>

Need even more power than Markdown? Use the Rich Text fieldtype in Storyblok. To convert it to HTML include a `$richtext` property on your Block. This will created a duplicate field suffixed by `_html` containing the processed content.

```php
// creates a new content item called $i_am_rich_html
protected $richtext = ['i_am_rich'];
```

> {warning} The package doesn’t currently support components inside richtext fields.

---

<a name="adding-paragraphs">
## Wrapping content in paragraphs tags
</a>

You often want to wrap content from textareas in paragraph tags to allow better control of the formatting. This is really simple to do, just add a `$autoParagraphs` property containing an array of the fields to convert. This will add new attributes to your block appended with `_html` and leave the original content untouched.

```php
// creates a new content item called $textarea_content_html
protected $autoParagraphs = ['textarea_content'];
```

---

<a name="accessors">
## Accessors
</a>

Just like with Laravel’s models sometimes you want to manipulate the data each time you use it so to quote Taylor Otwell in the Laravel docs (only we use proper quote marks!) ‘To define an accessor, create a `getFooAttribute` method on your Block where `Foo` is the “studly” cased name of the field you wish to access.’ When calling `$kitten->first_name` the accessor will be used and applying any transformations you specified.

```php
<?php

namespace App;

use Riclep\Storyblok\Block;

class KittenBlock extends Block
{
    /**
     * Get the kitten’s first name.
     *
     * @return string
     */
    public function getFirstNameAttribute()
    {
        return ucfirst($this->content['first_name']);
    }
}
```

### Custom content fields

You’re not limited to only transforming existing fields, you can also create new content fields, although regular methods on your Block may be more favourable in some cases. A basic example to return a Kitten’s full name.

```php
<?php

namespace App;

use Riclep\Storyblok\Block;

class KittenBlock extends Block
{
    /**
     * Get the kitten’s first name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->content['first_name']) . ' ' . ucfirst($this->content['surname']);
    }
}
```

And a more complex example: you have a component in Storyblok that allows the user to enter text and choose a background colour using the [Colorpicker component](https://www.storyblok.com/apps/colorpicker). You want to ensure there is enough contrast between the text and background colours and you want to do this automatically. Here we use the [ColorContrast](https://github.com/davidgorges/color-contrast-php) package to work out if the user selected colour is light or dark and return a different string accordingly which can be used for styling with CSS.

```php
<?php

namespace App\Storyblok;

use ColorContrast\ColorContrast;
use Riclep\Storyblok\Block;

class ServiceBlock extends Block
{
    # creates text_class content attribute containing the contrasting class name
	public function getTextClassAttribute() {
		$contrast = new ColorContrast();
		$complimentary = $contrast->complimentaryTheme($this->content['colour']->color);

		return $complimentary === ColorContrast::LIGHT ? 'light-text' : 'dark-text';
	}
}
```


### Resizing images with Storyblok’s CDN

Or perhaps you want to transform an image using Storyblok’s CDN, although a method might make more sense here so you can pass the desired dimensions in to it.

```php
<?php

namespace App\Storyblok;

use Riclep\Storyblok\Block;

class ServiceBlock extends Block
{
    # $block->image
    # this simply transforms the existing content field called image
    public function getImageAttribute()
    {
        return str_replace('//a.storyblok.com', '//img2.storyblok.com/filters:quality(80)', $this->image);
    }

    # $block->small_image
    # it’s a tiny version
	public function getSmallImageAttribute()
	{
		return str_replace('//a.storyblok.com', '//img2.storyblok.com/50x0/filters:quality(40)', $this->image);
	}
    
    # $block->large_image
    # but this one is large and will eat your mobile data
    public function getLargeImageAttribute()
	{
		return str_replace('//a.storyblok.com', '//img2.storyblok.com/5000x0/filters:quality(100)', $this->image);
	}
}
```

> {info} Storyblok also have a [Cloudinary app](https://www.storyblok.com/apps/cloudinary-native) that provides more powerful image manipulation.

<a name="editable-comment-link">
## Linking to the visual editor
</a>

One of Storyblok’s most powerful features is its visual editor. This lets you click text and images within your page and Storyblok will load the correct content in the editing panel allowing you to make changes quickly. There is no need to manually navigate the nested components that make up your page.

It does this by searching for comments injected into your HTML. To add them simply call the `editableBridge()` method in your Blade views just before the opening tag of the block you wish to make editable.

```html
{!! $story->editableBridge() !!}
<section>
    <h1 class="t-1">{{ $story->title }}</h1>

    <p class="t-2">{{ $story->introduction }}</p>
</section>
```

Don’t worry, these comments are only added when viewing your website within the Storyblok editor, your HTML is left clean and pure the rest of the time.


> {warning} If you are having problems getting this live preview to work check the [trouble shooting page](/{{route}}/{{version}}/troubleshooting#live-preview-not-reloading).


<a name="schema-org-data">
## Schema.org data
</a>

[Schema.org](https://schema.org) is a collaborative, community activity with a mission to create, maintain, and promote schemas for structured data on the Internet, on web pages, in email messages, and beyond. These schemas are designed to be machine readable allowing you to provide structured data for search engines, social networks and bots.

We use the super [Spatie Schema.org](https://github.com/spatie/schema-org) package.

To add Schema.org meta data for you Block use the `Riclep\Storyblok\Traits\SchemaOrg` trait add a `schemaOrg` method that returns a Spatie schema. This will automatically add it to the Page object.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;
use Riclep\Storyblok\Traits\SchemaOrg;
use Spatie\SchemaOrg\Schema;

class Business extends Block
{
	use SchemaOrg;

	protected function schemaOrg() {
		return Schema::localBusiness()
			->name($this->content()->name)
			->email($this->content()->email);
	}
}
```

To output the `<script>` tags call `$story->schemaOrgScript()` in your view. This is best placed in the `<head>`.

> {info} See the [Spatie package](https://github.com/spatie/schema-org) for full docs.