# Linked to the visual editor

---

- [Linking to the visual editor](#editable-comment-link)
- [Live preview](#live-preview)



<a name="editable-comment-link">
## Linking to the visual editor
</a>

One of Storyblok’s most powerful features is its visual editor. This lets you click text and images within your page and Storyblok will load the correct content in the editing panel allowing you to make changes quickly.

First of all include the editor bridge from the package in the footer of your views. Make sure this is outside your VueJS app root. The bridge loads various pieces of JavaScript to link the Storyblok’s visual editor. But don’t worry, this only happens when within the editor, the rest of the time your code is unaffected!

```php
<!doctype html>
<html>
<head>
	<title>@yield('title')</title>
</head>
<body>
    <div id="app">
    </div>

    @include('laravel-storyblok::editor-bridge')
</body>
</html>
```


To make elements on your page clickable simply call the `editorLink()` method in your Blade views just before the opening tag of the block you wish to make editable. When within Storyblok each editable element should be outlined and clicking it will open the correct editor panel.

```php
{!! $story->editorLink() !!}
<section>
    <h1>{{ $story->title }}</h1>

    <p>{{ $story->introduction }}</p>
</section>
```

> {warning} See the [troubleshooting guide](/{{route}}/{{version}}/troubleshooting) if you are having problems.


<a name="live-preview">
## Live preview
</a>

Storyblok has an amazing live preview feature where you can see your changes as you make them. This is supported in the package by sending the data to your server for rendering and updating the document in the editor asynchronously.

To enable live preview set `live_preview` to `true` and specify the wrapper `live_element` in the Storyblok configuration file. The wrapper element must be inside your VueJS app tag and it’s best to use an element that doesn’t do anything else. Everything held inside the element will be replaced when updating content in Storyblok.

```php
<!doctype html>
<html>
<head>
	<title>@yield('title')</title>
</head>
<body>
    <div id="app">
        <div class="storyblok-live">
			@yield('content')
		</div>
    </div>

    @include('laravel-storyblok::editor-bridge')
</body>
</html>
```

You’ll need to create a route to process the requests from the Storyblok bridge. It `POST`s the payload from Storyblok to the current URL and returns a new HTML stub of the changes.

```php
Route::post('/{slug?}', '\Riclep\Storyblok\Http\Controllers\LiveContentController@show')->where('slug', '(.*)')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])->middleware([\Riclep\Storyblok\Http\Middleware\StoryblokEditor::class]);
```

> {info} Ensure this route is at the end of your `web.php` file so it doesn’t replace other routes in your application.

As it needs to make a round trip to your server for each change it will be effected by latency but most modern hosting is fast enough for a good experience. You can disable this feature by setting `live_preview` to `false`.

> {warning} This is still an experimental feature and may not work in 100% of circumstances.