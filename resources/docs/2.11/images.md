 # Images

---

- [Transforming images](#transforming-images)
- [Picture elements &amp; srcset](#picture-elements)
- [CSS variables](#css-variables)
- [Image meta](#image-meta)

All Storyblok Image fields are automatically converted to Image fields. Legacy image fields and any text fields containing the URL to an image at another domaain are also ‘upgraded’ to Image classes and given stub Block content matching regular images.

<a name="transforming-images">
## Transforming images
</a>

All Storyblok Asset fields with uploaded images are automatically converted into Image Field classes. These can be transformed by calling `transform()` and chaining the various methods.


```php
// $image = Riclep\Storyblok\Fields\Image or any class extending it

// scales and crops the image to the requested dimensions (width, height, [focus]). If the proportions differ from the original image it is cropped
$image->transform()->resize(234, 432);

// scales the image and crops centering on the ‘focal point’ specified on the image in Storyblok
$image->transform()->resize(234, 432, 'focal-point');

// scales the image and crops using Storyblok’s Smart Crop feature for detecting faces
$image->transform()->resize(234, 432, 'smart');


// scales the image to fit inside the dimensions and set the background colour (width, height, [background colour]), 
$image->transform()->fitIn(400, 300, 'ff0000');

// fits the image and adds a transparent background, or fitIn(400, 700, 'transparent'). The file is converted a .png
$image->transform()->fitIn(400, 700);

// converts the image to the supplied format (jpeg, png, webp)
$image->transform()->format('webp');

// convert the image to a jpg with a quality of 30
$image->transform()->format('jpeg', 30);
```

> {info} When converting the file format the URL retains the original file extension. Not all browsers support webp yet!


Transformations can be chained but not all combinations will work well together such as using `fitIn()` with a transparent background and converting a `jpeg` as this format doesn’t support transparency. 

```php
$image->transform()->resize(800, 450)->format('webp');
```

### Using alternate transformers

**Storyblok**

Since version 2.8 it is possible to define a ‘transformer’ to use when transforming images. The default transformer is `Riclep\Storyblok\Support\ImageTransformers\Storyblok` which uses [Storyblok’s new image transformation URLs](https://www.storyblok.com/docs/image-service#migrating-from-the-previous-version-of-the-service). It’s also possible to use the old URL structure with the `Riclep\Storyblok\Support\ImageTransformers\StoryblokLegacy` transformer but it’s highly recommended to update. [View their docs](https://www.storyblok.com/docs/image-service) for more details on resizing, cropping etc.

**Imgix**

The package includes a driver for Imgix’s web proxy allowing you to take advantage of their more powerful transformations, simply change the transformer to `Riclep\Storyblok\Support\ImageTransformers\Imgix`. It is also possible to implement custom transformers by extending the `Riclep\Storyblok\Support\ImageTransformers\BaseTransformer` class.

**Specifying the transformer**

There are two ways to user a transformer - set the default transformer class in your Storyblok configuration file with the `image_transformer` key or pass a transformer class to the `transformer()` method before calling `transform()`.


```php
// resize the image and rotate it 99 degrees - ‘rot’ is a feature of Imgix 
$image->transformer(\Riclep\Storyblok\Support\ImageTransformers\Imgix::class)->transform()->resize(200, 100)->option(['rot' => 99]);
```

> {info} As each transformer can support different services with different capabilities the methods available on each may vary.

### Predefined transformations

Rather than defining your transformations every time you use them they can be added directly to an Image class as follows. Make a class extending `Riclep\Storyblok\Fields\Image` and define a `transformations()` method that sets the `transformations` property. This property should be an array of named arrays with two keys: `src` - a transformation and `media` - a `<picture>` element media string (this can be left empty). Each outer array is the name of the transformation, an example will make it clearer.

Here we define two image sizes, ‘mobile’ and ‘desktop’. The desktop variant includes a media query.

```php
namespace App\Storyblok\Fields;

use Riclep\Storyblok\Fields\Image;

class HeroImage extends Image
{
	protected function transformations() {
		$this->transformations = [
		    'desktop' => [
				'src' => $this->transformer(\Riclep\Storyblok\Support\ImageTransformers\Imgix::class)->transform()->resize(500, 400),
				'media' => '(min-width: 1000px)',
			],
			'mobile' => [
				'src' => $this->transform()->resize(100, 120)->format('webp'),
				'media' => '',
			],
		];
	}
}
```

They can now be accessed using the transformations key and further transformed or returned as an image URL when cast to a string.

```php
$image->transform('mobile');
$image->transform('desktop');
```

> {info} The default `<picture>` and `srcset` templates expect your `transformations` array to list images from smallest to largest and use `min-width` for media queries. If you need different functionality then use a custom Blade view.

<a name="picture-elements">
## Picture elements
</a>

We didn’t use the `media` key in the previous example; that’s because it’s used for creating `<picture>` elements! To create a picture element make sure you define your `transformations` and call the `picture($alt)` method including the alt text you wish to use.

```php
$image->picture('Some alt text');
```

This will create the following picture element with two `<source>` tags. The `<img>` tag will use the original, non-transformed image from Storyblok.

```html
<picture>
    <source srcset="//img2.storyblok.com/100x120/filters:format(webp)/f/87028/960x1280/31a1d8dc75/an-image.jpg" type="image/webp" media="">
    <source srcset="//img2.storyblok.com/500x400/f/87028/960x1280/31a1d8dc75/an-image.jpg" type="image/jpeg" media="(min-width: 1200px)">

    <img src="https://a.storyblok.com/f/87028/960x1280/31a1d8dc75/an-image.jpg" alt="Some alt text">
</picture>
```

> {warning} The order you define the transformations is important and is the order they will appear in your html. Web browsers will use the first `<source>` tag they find that matches the media query. This means a blank media value on your first transformation will always match!

You can set the transformation to use for the `<img>` tag by passing it’s name as the second argument.

```php
$image->picture('A super image', 'mobile');
```

```html
<picture>
    <source srcset="//img2.storyblok.com/500x400/f/87028/960x1280/31a1d8dc75/an-image.jpg" type="image/jpeg" media="(min-width: 1200px)">

    <img src="//img2.storyblok.com/100x120/filters:format(webp)/f/87028/960x1280/31a1d8dc75/an-image.jpg" alt="A super image">
</picture>
```

You can add additional attributes to the `<img>` tag with the third argument with takes a key-value pair of attribute-value.

```php
$image->picture('A super image', 'mobile', ['class' => 'hero mb-10', 'id' => 'hero-image']);
```

If you don’t like the default view used for generating the `<picture>` element then you can supply your own Blade view with the forth argument

```php
$image->picture('A super image', 'mobile', ['class' => 'hero mb-10', 'id' => 'hero-image'], 'blocks.picture');

// the view receives the following data
[
    'alt' => $alt, // A super image
    'attributes' => $attributes, // ['class' => 'hero mb-10', 'id' => 'hero-image']
    'default' => $default, // mobile
    'imgSrc' => $imgSrc, // URL of the default image
    'transformations' => $this->transformations, // array of $image->transformations
];
```

**Since 2.7.3**

As well as picture elements you can also create `<img>` tag `srcset` tags. The usage is identical to that for `<picture>` tags except you call the `srcset()` method.

```php
$image->srcset('A super image');
```

```html
<img srcset="https://img2.storyblok.com/500x400/f/87028/960x1280/31a1d8dc75/bottle.jpg 500w,
             https://img2.storyblok.com/100x120/filters:format(webp)/f/87028/960x1280/31a1d8dc75/bottle.jpg 100w,"
     sizes="(min-width: 1200px) 500px,
            100px,"
     src="https://a.storyblok.com/f/87028/960x1280/31a1d8dc75/bottle.jpg" alt="A super image">
```

> When using `srcset` all transformations must use the same ratio / crop - it can not be used for art direction. This is because the browser will automatically determine the correct image to use. If the browser has already cached a larger image this may still be used even when a smaller version matches.

### Defining picture elements directly in Blade

**Since 2.5.22**

Setting your `transformations` in the Field’s class can limit your flexibility, especially if you want to use that field in several places or pages.

Use the `setTransformations()` method to define your picture element images directly in your view before calling `picture()`. The method takes the same input as you define in the `transformations()` method of the class. Be aware this will replace transformation defined in the class itself.

```php

$field->setTransformations([
    'mobile' => [
        'src' => $field->transform()->resize(200, 200)->format('webp'),
        'media' => '(min-width: 400px)',
    ],
    'desktop' => [
        'src' => $field->transform()->resize(400, 400),
        'media' => '(min-width: 800px)',
    ],
])->picture('The alt text', 'mobile')));

```

> {info} When supplying your own view you could add extra values to the `transformations` array to use on each image size.

Finally, for full control just override the `picture()` method on your custom Image class.

<a name="css-variables">
## CSS variables
</a>

**Since 2.5.19**

Sometimes you might need your transformations to be used for background images. As you can’t create breakpoints using `style` attributes you will have to supply a CSS variable for each transformation. We make this simple like so:

```html
<div style="--desktop: url(....); --mobile: url(....);">

<div class="hero" style="{{ $image->cssVars() }}"></div>
```

Each transformation key is converted to a variable with a value of the transformed URL. Make sure you CSS is set to look for these variables.

```scss
.hero {
  background-image: var(--mobile);
}

@media (min-width: 1000px) {
    .hero {
      background-image: var(--desktop);
    }
}
```


### Focal-point and object-fit

**Since 2.10.5**

The image focal-point in Storyblok is great but sometimes you want to do more than use it for cropping via their CDN. Perhaps you want to use the full original image and object-position for alignment - great for responsive websites! Call `focalPointAlignment()` on your image and the focal-point will be used to make a string compatible with CSS object-position;

```html
// --object-position: 30% 22%;
<img style="--object-position: {{ $block->image->focalPointAlignment() }};" src="{{ $block->image }}" alt class="object-position">

// --object-position: bottom right; - default when no focal-point is set
<img style="--object-position: {{ $block->image->focalPointAlignment('bottom right') }};" src="{{ $block->image }}" alt class="object-position">


// --object-position: left top; - use hard alignment, not %
<img style="--object-position: {{ $block->image->focalPointAlignment('center', true) }};" src="{{ $block->image }}" alt class="object-position">
```


### Getting your CDN URL

Image transformations implement `__toString()` and will be converted into a Storyblok Image Service URL when used in Blade etc.

### Custom transformations

You can make a custom transformation by calling `$image->transform()->createUrl($options)`. The `$options` argument should be a valid URL parameter such as `/fit-in/200x200/filters:fill(CCCCCC)`.

<a name="image-meta">
## Image meta
</a>

Every Image contains meta data that may be useful.

```php
// dimensions in pixels
$image->width();
$image->height();

// returns the mimetype
$image->type();
```