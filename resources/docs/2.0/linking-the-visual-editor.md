# Linked to the visual editor

---

- [Linking to the visual editor](#editable-comment-link)



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

> {warning} See the [troubleshooting guide](/{{route}}/{{version}}/troubleshooting) if you are having problems.