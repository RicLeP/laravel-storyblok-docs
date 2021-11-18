# Views

---

- [Using includes](#using-includes)
- [The rended() method](#the-render-method)


You can loop over the nested Blocks in your Blade template, optionally using `@@include` to pass the data to child views to keep things manageable and reusable as shown below. This lets you quickly build your pages but does limit some of the dynamic nature of being able to create pages in Storyblok using any components you want but sometimes this control can be a good thing.


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
					@include('storyblok.blocks._' . $section->component(), ['content' => $section])
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