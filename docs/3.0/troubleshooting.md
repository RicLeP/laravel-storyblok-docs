---
title: Troubleshooting
description: 'Common issues, debugging advice, and troubleshooting steps for Laravel Storyblok.'
---

# Troubleshooting

---

## Live preview does not reload in Storyblok editor {#live-preview-not-reloading}

If your live preview does not reload when saving or publishing changes in the Storyblok editor:

1. **HTTPS Requirement:** Both the Storyblok Visual Editor and your application must be served securely over HTTPS. If you are developing locally, use tools like Laravel Herd, Valet, or DDEV with local SSL enabled.
2. **TrimStrings Middleware:** In Laravel 11, 12, and 13, make sure you configured `bootstrap/app.php` to bypass string trimming on the `sbLiveData` payload:
   ```php
   ->withMiddleware(function (Middleware $middleware): void {
       $middleware->trimStrings(except: [
           fn (Request $request) => $request->has('sbLiveData'),
       ]);
   })
   ```
3. **Live Element Container:** Verify that the element matching your `config('storyblok.live_element')` (default `.storyblok-live`) exists in your layout and contains the rendered page content.

---

## No editable regions shown in editor {#no-regions-in-editor}

The editor functionality depends upon HTML comments or attributes injected into your document. Use `{!! $block->editorLink() !!}` to add a comment to identify components. Alternatively use `<section {!! $block->editorLink(true) !!}`> to add an attribute to an element. 

If you are using Vue.js, Vue removes HTML comments by default when mounting. To fix this, enable comments in your Vue app configuration:

```javascript
const app = new Vue({
    el: '#app',
    comments: true,
    // ...
});
```

---

## 404 Errors for existing stories {#404-errors}

If stories exist in Storyblok but return 404 errors in Laravel:

- **Draft vs Published:** By default, Storyblok only returns published content. If you are testing draft content outside the Visual Editor (e.g. on local or staging), ensure `STORYBLOK_DRAFT=true` in your `.env`.
- **Catch-All Route Ordering:** Ensure your Storyblok catch-all route `Route::get('/{slug?}', ...)` is defined at the very end of `routes/web.php` so that specific application routes or asset paths are matched first.
- **Slug Normalization:** When requesting folders or stories directly with `Storyblok::read('slug')`, omit leading or trailing slashes unless explicitly needed.
- **Denylist Configuration:** Check `config/storyblok.php` to ensure the requested slug does not match any regular expressions in the `denylist` array.

---

## Webhook cache clearing {#webhook-cache}

If changes published in Storyblok are not reflected on your site:

- **Webhook URL:** Verify that the webhook URL registered in Storyblok matches your domain exactly (e.g. `https://example.com/api/laravel-storyblok/webhook/publish`). Webhook HTTP clients typically do not follow 301/302 redirects (such as `http://` to `https://` or non-www to www).
- **Webhook Secret:** If you set `STORYBLOK_WEBHOOK_SECRET` in `.env`, verify that the secret matches the value configured in your Storyblok Space settings.

---

## Relations returning only UUIDs {#relations-not-resolving}

Storyblok Multi-Option and Single-Option relationship fields return only Story UUIDs unless requested with relation resolution.

To resolve relations:
1. Pass the relations array to the query: `Storyblok::read($slug, ['component_name.field_name'])`
2. Or set `public array $_resolveRelations = ['field_name'];` on your Block class.
