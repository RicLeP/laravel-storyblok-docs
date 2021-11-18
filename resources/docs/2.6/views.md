# Views

---

- [Using includes](#using-includes)
- [The render() method](#the-render-method)
- [Creating CSS class names](#creating-css-class-names)


You can loop over the nested Blocks in your Blade template, optionally using `@@include` to pass the data to child views to keep things manageable and reusable as shown below. This lets you quickly build your pages but does limit some of the dynamic nature of being able to create pages in Storyblok using nested components, see the `render()` method below.

> {info} You can quickly scaffold all your component views by running `artisan ls:stub-views`. Use `artisan ls:stub-views -O` to overwrite your current Blade files.

```php
@extends('storyblok._layout')


@section('content')
	<main>
		<swiper :options="swiperHero">
			@foreach($story->feature_heroes as $featureHero)
				<swiper-slide>
					@include('storyblok.blocks._feature-hero', ['featureHero' => $featureHero])
				</swiper-slide>
			@endforeach
		</swiper>

		<section class="home-introduction u-w-narrowest u-w--centred">
			<h1 class="t-3 fgc-ocean">{{ $story->title }}</h1>

			<div>
				<p class="u-mb-30 t-8">{{ $story->introduction }}</p>

				<div>
					@foreach($story->buttons as $button)
						<a href="{{ url($button->url->cached_url) }}" class="button {{ $button->cssClass() }}">
                            {{ $button->text }}
                        </a>
					@endforeach
				</div>
			</div>
		</section>

		<div class="section-teasers">
			@foreach($story->teasers as $teaser)
				@include('storyblok.blocks._section-teaser', ['teaser' => $teaser])
			@endforeach
		</div>

		<section class="interview-teasers u-w-widest u-w--centred u-w--m-flush u-mt-100 u-mb-100">
			<h4 class="t-6 interview-teasers__title">Real world advice and inspiration</h4>

			@foreach($story->interviews as $interview)
				@include('storyblok.blocks._interview-teaser', ['interview' => $interview])
			@endforeach
		</section>

		<section class="u-w-wide u-w--centred u-mb-180">
			<header class="home-events u-mb-35">
				<h2 class="t-2 fgc-ocean u-mr-10 u-mb-10">Upcoming IoD events</h2>
				<a href="{{ route('events') }}" class="t-4 link-underlined link-ocean">See all events</a>
			</header>

			<event-list :limit="2"></event-list>
		</section>
	</main>
@endsection

```

<a name="using-includes">
## Example using includes
</a>

```php
@extends('layouts._default')

@section('content')
	<main>
		@foreach($story->features as $feature)
			<section>
				<h2>
					{{ $feature->title }}
				</h2>

				@foreach($feature->body as $section)
					@include('storyblok.blocks._' . $section->component(), ['block' => $section])
				@endforeach
			</section>
		@endforeach
		</div>
	</main>
@endsection
```


<a name="the-render-method">
## The `render()` method
</a>

Alternatively a block can render itself by implementing the `Renderable` trait and calling the `render()` method. This will look for a view matching the Blocks name and pass the content to it.

```php
@extends('layouts._default')

@section('content')
	<main>
		@foreach($story->features as $feature)
			<section>
				<h2>
					{{ $feature->title }}
				</h2>

				@foreach($feature->body as $section)
					$section->render()
				@endforeach
			</section>
		@endforeach
		</div>
	</main>
@endsection
```


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

