# Blocks

---

- [Artisan commands](#artisan-commands)
- [Determining the view](#determining-the-view)
- [Accessing Fields](#accessing-fields)
- [Accessors](#accessors)
- [Getting a Block’s position](#getting-a-blocks-position)
- [Checking a Block contains specific items](#checking-block-content)
- [Casting Fields](#casting-fields)
- [Linking to the visual editor](#editable-comment-link)
- [Meta and Schema.org data](#schema-org-data)


Every Storyblok component making up your page is transformed into a Block class. The class they become is determined by the component’s name - if you create a matching class that will be used, for example a component called `cat-images` transforms into `App\Storyblok\Blocks\CatImages` if available. If the class can’t be found then the default `App\Storyblok\Block` is used. Blocks should extend `Riclep\Storyblok\Block` or `App\Storyblok\Block` if you want to add some defaults.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;

class CatImages extends Block
{

}
```


Blocks borrow some concepts from Laravel’s Eloquent models to make using them feel familiar such as creating accessors or casting variables to dates, but we don’t stop there, we also have a bunch of helpful features for Storyblok content. 

---

<a name="artisan-commands">
## Artisan commands
</a>

You can generate Block classes using the built-in the Artisan command. The Block’s name should match the name used in Storyblok but converted to StudlyCase so my-component becomes MyComponent. This will create a new class in App\Storyblok\Blocks. The component’s fields are read from Storyblok and the PHPDoc block updated to include them to allow IDE completion of the magic getters.

```console
php artisan ls:block MyComponent
```

Will become something like:

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block as BaseBlock;

/**
 * @property-read string title
 * @property-read string text
 * @property-read string buttons
 * @property-read string image
 * @property-read string overview
 */
class MyComponent extends BaseBlock
{
    //
}
```

> {warning} Ensure you have set your Space ID and OAUTH Token in the .env file.

You can also generate Blade and SCSS files readily configured with the Block’s name by passing a `-s` or `-b` argument to the command.

```console
php artisan ls:block MyComponent -b
```

Creates `resources/views/storyblok/components/my-component.blade.php`

```php
<?php
/** @var \App\Storyblok\Blocks\MyComponent $content */
// dd($content);
?>

<div class="my-component">
	
</div>
```

```console
php artisan ls:block MyComponent -s
```

Creates `resources/sass/blocks/_my-component.scss` and updates the app.scss file.

```scss
.my-component {

}
```

### Custom generator stubs

You can customise any of the stubs used for creating files by making a `/resources/stubs/storyblok` folder containing the following files. You only need to create those you wish to customise.

* `/resources/stubs/storyblok/block.stub` - Block class template
* `/resources/stubs/storyblok/block.blade.stub` - Block Blade template
* `/resources/stubs/storyblok/block.scss.stub` - Block SCSS template

Each stub contains ‘Dummy’ references that get replaced during generation so it’s recommended you copy and adpt the files from [GitHub](https://github.com/RicLeP/laravel-storyblok/tree/master/src/Console/stubs).

---

<a name="determining-the-view">
## Determining the view
</a>

When calling `render()` on a `Block` it’s `views()` method will be called. The default behaviour is to check the `Page` the `Block` is part of then it’s ancestor Blocks to build an array of possible views. The first view that exists will be used. For example if you have a `Page` with a content type of `podcast` first it’ll check for a matching view in `storyblok.pages.podcast` then fall back to the more generic blocks. Here’s an example of the views that would be checked for a `Block` with a nested component path of `podcast/episodes/episode`.

```php
<?php

// taking the following component path. ‘page’ is a generic root item
// the actual content type is ‘podcast’
$componentPath = ['page', 'podcast', 'episodes', 'episode'];

// it becomes
[
    "storyblok.pages.podcast.blocks.episodes.episode",
    "storyblok.pages.podcast.blocks.episode",
    "storyblok.blocks.episodes.episode",
    "storyblok.blocks.podcast.episode",
    "storyblok.blocks.episode",
]
```

> {info}  It’s recommended to create the most generic views first such as `storyblok.blocks.episode` in our example above as this will capture all instances of that Block and add more specific views as and when needed.

---

<a name="accessing-fields">
## Accessing fields
</a>

Blocks store their fields in a Laravel Collection on the `$_fields` property. You can access them directly on the Block’s object. See the [fields documentation](/{{route}}/{{version}}/fields) for more information on how to access them and their transformations.

```php

```php
echo $someBlock->someField;
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
        return ucfirst($this->_fields['first_name']);
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
        return ucfirst($this->_fields['first_name']) . ' ' . ucfirst($this->_fields['surname']);
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
		$complimentary = $contrast->complimentaryTheme($this->_fields['colour']->color);

		return $complimentary === ColorContrast::LIGHT ? 'light-text' : 'dark-text';
	}
}
```

---

<a name="getting-a-blocks-position">
## Getting a Block’s position
</a>

Sometimes it’s useful to know the parent and ancestors of the current Block. Every Block has a `_componentPath` property which is an array of the names of every Storyblok component passed through to reach the current point. There are several methods to help you work with this information.

```php
// Returns the current component’s name
$currentComponent->component(); // 'current-component'

// Returns the current path 
$currentComponent->_componentPath; // ['root-component', 'ancestor-component', 'parent-component', 'current-component']

// Returns the component name ‘x’ generations ago
$currentComponent->ancestorComponentName(2); // 'ancestor-component'

// Checks if this has a certain parent
$currentComponent->isChildOf('parent-component'); // true

// Checks if this has a certain ancestor
$currentComponent->isAncestorOf('ancestor-component'); // true
```

Wouldn’t it be great to be able to create CSS classes when working in Blade that help you style nested Blocks? Don’t worry, [we have you covered](/{{route}}/{{version}}/views#creating-css-class-names).


---

<a name="checking-block-content">
## Checking a Block contains specific items
</a>

If you want to see if a Block contains a specific field use the `has()` method.

```php
$block->has('field'); // true / false
```

**Since 2.12.5**

If you have field that can take ‘blocks’ created in Storyblok it can be useful to check if a certain type of component has been added. You can do this with the `hasChildBlock()` method. First pass the name of the field that holds the blocks then pass the component type to check for.

```php
$block->hasChildBlock('blocks_field', 'component'); // true / false
```

---

<a name="casting-fields">
## Casting Fields
</a>

You can cast a Block’s field to any Field class you want with the `$_casts` property. This is an array mapping a field name to a Class. The field’s data is passed to the Classes constructor. For more details see the [Fields documentation](/{{route}}/{{version}}/fields).

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Fields\DateTime;
use Riclep\Storyblok\Block;
use App\Storyblok\Fields\HeroImage;

class Custom extends Block
{
	protected array $_casts = [
		'datetime' => DateTime::class,
		'image' => HeroImage::class,
	];
}
```

> {warning} When casting fields to custom Classes make sure you extend an existing Field type such as `Riclep\Storyblok\Field` or `Riclep\Storyblok\Fields\Image`  and implement the `__toString()` method.

> {info} $casts was renamed to $_casts in version 2.2.1 to advoid field name classes

---


### Default values

If you want to set a default value for a field you can use the `$_defaults` property. This is an array mapping a field name to a default value. The default value will be used if the field is not set in Storyblok.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Fields\DateTime;
use Riclep\Storyblok\Block;
use App\Storyblok\Fields\HeroImage;

class Custom extends Block
{
	protected array $_defaults = [
		'field_2' => 'default value',
	];
}

```

---

<a name="editable-comment-link">
## Linking to the visual editor
</a>

One of Storyblok’s most powerful features is its visual editor. This lets you click text and images within your page and Storyblok will load the correct content in the editing panel allowing you to make changes quickly.

It does this by searching for comments injected into your HTML. To add them simply call the `editorLink()` method in your Blade views just before the opening tag of the block you wish to make editable.

```html
{!! $story->editorLink() !!}
<section>
    <h1>{{ $story->title }}</h1>

    <p>{{ $story->introduction }}</p>
</section>
```

Don’t worry, these comments are only added when viewing your website within the Storyblok editor, your HTML is left clean and pure the rest of the time.


> {warning} If you are having problems getting this live preview to work check the [trouble shooting page](/{{route}}/{{version}}/troubleshooting#live-preview-not-reloading).


<a name="schema-org-data">
## Meta and Schema.org data
</a>

### Block meta

Blocks can have useful meta data attached to them. This can be useful for either SEO or storing data about your Block. When resolving a relationship the relationship Block has a meta array containing the publish date, full slug and name of the Block from Storyblok.

You can add items to the meta with the `$block->addMeta(['key' => 'some value']);`, it takes a key => value array, the value can be any PHP structure. Existing keys are not overwritten. You can replace an existing item with `$block->replaceMeta('key', 'value');`

To access meta content use the following:

```php
$block->meta(); // returns full meta array
$block->meta('full_slug'); // returns just this items
$block->meta('missing_item', 'default value'); // returns the default if the item is missing
```

### Schema.org

[Schema.org](https://schema.org) is a collaborative, community activity with a mission to create, maintain, and promote schemas for structured data on the Internet, on web pages, in email messages, and beyond. These schemas are designed to be machine readable allowing you to provide structured data for search engines, social networks and bots.

We use the super [Spatie Schema.org](https://github.com/spatie/schema-org) package.

To use Schema.org add the `Riclep\Storyblok\Traits\SchemaOrg` trait to the Block and implement a `schemaOrg()` method returning a Spatie Schema.org object. This schema will be automatically added to any Pages this Block is added to.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;
use Spatie\SchemaOrg\Schema;
use Riclep\Storyblok\Traits\SchemaOrg;

class Business extends Block
{
	use SchemaOrg;

	protected function schemaOrg() {
		return Schema::localBusiness()
			->name($this->_fields->name)
			->email($this->_fields->email);
	}
}
```

To output the `<script>` tags call `$story->schemaOrgScript()` on your page in the `<head>` tag.

> {info} See the [Spatie package](https://github.com/spatie/schema-org) for full docs.