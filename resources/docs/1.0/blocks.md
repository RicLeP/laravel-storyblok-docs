# Blocks

---

- [Date casting](#date-casting)
- [Markdown](#markdown)
- [HTML-o-rise](#html-o-rise)
- [Accessors](#accessors)


Blocks are the key err.. building block of your pages. Every Storyblok component is transformed into a Block class. The class they become is determined based on the component’s name - if you have a matching Block class that will be used, for example a component called `cat-images` transforms into `CatImagesBlock` if available. Blocks should extend `Riclep\Storyblok\Block`.

```php
<?php

namespace App\Storyblok;

use Riclep\Storyblok\Block;

class CatImagesBlock extends Block
{

}
```

Blocks borrow some concepts from Laravel’s Eloquent models to make using the data feel familiar such as creating accessors or casting variables to dates, but we don’t stop there, we also have a bunch of helpful features for Storyblok content - automatically transform markdown fields, apply typographical fixes and flourishes or return rendered HTML - we want to make building websites a enjoyable. 

---

<a name="date-casting">
## Date casting
</a>

When using Storyblok’s Date/Time field you’ll probably want to convert it into something more handy to use in PHP. Simply define a `$dates` property in your Block containing an array of field names and we’ll convert them to [Carbon](https://github.com/briannesbitt/carbon) objects. 

```php
protected $dates = ['release_date'];
```

// TODO supply date format

---

<a name="markdown">
## Markdown
</a>

Storyblok includes Markdown fields (with an optional visual editor that’s perfect for clients!) and we make it super easy to convert them to HTML. Just add a `$markdown` property containing an array of field names and hey presto we magically create an HTML version thanks to the power of [CommonMark](https://commonmark.thephpleague.com/). We keep your original field untouched should you wish to do anything else with it and create a second one suffixed with `_html`.

```php
# creates a new content item called $interesting_story_html
protected $markdown = ['interesting_story'];
```

---

<a name="html-o-rise">
## HTML-o-rise
</a>

// TODO converts textareas to HTML paragraphs

---

<a name="accessors">
## Accessors
</a>

Just like with Laravel’s models sometimes you want to manipulate the data each time you use it so to quote Taylor Otwell (only we use proper quote marks!) ‘To define an accessor, create a `getFooAttribute` method on your Block where `Foo` is the “studly” cased name of the field you wish to access.’ When calling `$kitten->first_name` the accessor will be used and apply any transformations you require.

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

You’re not limited to only transforming existing fields, you can also create new content fields, although regular methods may be more favourable in many cases.

Take this example: you have a component in Storyblok that allows the user to enter text and choose a background colour using the [Colorpicker component](https://www.storyblok.com/apps/colorpicker). You want to ensure there is enough colour contrast between the text and background and you want to do this automatically by applying different CSS classes. Here we use [ColorContrast](https://github.com/davidgorges/color-contrast-php) to work out if hte user selected colour is light or dark and return a differrent class accordingly.

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

> {info} Storyblok also have a [Cloudinary app](https://www.storyblok.com/apps/cloudinary-native) that provides more powerful asset management and manipulation. 