# Linked to the visual editor

---

- [Linking to the visual editor](#editable-comment-link)
- [Live view](#live-view)



<a name="editable-comment-link">
## Linking to the visual editor
</a>

One of Storyblok’s most powerful features is its visual editor. This lets you click text and images within your page and Storyblok will load the correct content in the editing panel allowing you to make changes quickly.

First of all include the editor bridge from the package in the footer of your views. Make sure this is outside your VueJS app root. The bridge loads various pieces of JavaScript to link the Storyblok’s visual editor. But don’t worry, this only happens when within the editor, the rest of the time your code is unaffected!

```php
<!doctype html>
<html>
<head>
	<title>@@yield('title')</title>
</head>
<body>
    <div id="app">
    </div>

    @@include('laravel-storyblok::editor-bridge')
</body>
</html>
```


To make elements on your page clickable simply call the `editorLink()` method in your Blade views just before the opening tag of the block you wish to make editable. When within Storyblok each editable element should be outlined and clicking it will open the correct editor panel.

```php
@{!! $story->editorLink() !!}
<section>
    <h1>@{{ $story->title }}</h1>

    <p>@{{ $story->introduction }}</p>
</section>
```

> {warning} See the [troubleshooting guide](/{{route}}/{{version}}/troubleshooting) if you are having problems.


<a name="live-view">
## Live view
</a>

**New in 2.1**

One of Storyblok’s greatest features is its live, as you type, preview of your changes. Doing this has traditionally relied upon using Javascript for your frontend templating but now it’s possible in PHP too!

To use the live view make sure you have set up the bridge above and update your Blade files to use a Block’s `liveField` method, supplying the field to make live. Any serverside mutators you create or the conversion of markdown and richtext fields should be correctly handled.

**This feature is still fairly experimental so test your website carefully and feel free to contribute on GitHub.**

```php
@{{ $story->title }}
@{!! $story->block()->liveField('title') !!}
```

> {info} Live view is currently limited to text content, html attributes such as img src and classes are not yet supported.