# CSS Class helpers

---

- [Creating CSS class names](#creating-css-class-names)

<a name="creating-css-class-names">
## Creating CSS class names
</a>

A good naming convention to follow when styling your components is to match the CSS class to the component’s name. [Blocks](/{{route}}/{{version}}/blocks) have the CssClasses trait that provides several helpful methods using the [Block’s `$componentPath`.](/{{route}}/{{version}}/blocks#getting-a-blocks-position)

> {info} If you use a different naming scheme override the methods in `Riclep\Storyblok\Traits\CssClasses` with your own.

```php
// Returns the current Block’s css class - kebab case version of the component name
$block->cssClass();

// Returns the current block’s class and it’s parent
$block->cssClassWithParent(); // current-component@parent-component
```

We’re a big fan of the BEM naming methodology and it fits well with Storyblok, but you can use any system or scheme you prefer. (BEM + utilities are the way to go though 😉). The child@parent rule might be a bit controversial but it can be helpful when looping over varied nested components that may be used in several contexts or layouts such as single or multiple columns.

> {warning} Don’t forget to escape the @ symbol in your CSS files .child\@parent { ... }


### Layouts

In Storyblok some of your components might be solely used for sectioning or laying out content. There are several methods to help you work out when your Block is within a layout and you want to supply different CSS rules.

```php
// $componentPath = ['root', 'body', 'layout_columns', 'text', 'title']

$title->cssClassWithLayout(); // title@layout_columns

$title->isLayout(); // false
$layoutColumns->isLayout(); // true

$title->getLayout(); // layout_columns
```

By default we check for component names prefixed with ‘layout_’ when identifying a layout but you can define your own prefix by setting the `$layoutPrefix` on your Blocks (`App\Storyblok\DefaultBlock` is a good place for this). For more control override the existing methods or implement your own!


### Some examples

```php
// when not in a layout add an additional class to centre the content
<div class="scope-cms u-mb-40 @if (!$block->getLayout()) centred @endif">
	{!! $block->text_html !!}
</div>

// add an extra class when inside a layout
<section class="layout_columns">
    <article class="text {{ $block->cssClassWithLayout() }}"> // text@layout_columns
        {{ $block->text }}
    </article>
</section>

```

```css

.text {
    width: 100%;
}

/* Don’t forget to escape the @ symbol - and CSS Grid is probably a far better way to achieve outcome */
.text\@layout_columns {
    width: 50%;
}
```

