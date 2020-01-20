# Requesting Pages

---

Pages in Storyblok can be requested via their slug or UUID. If using the [catch-all route](/{{route}}/{{version}}/installation#routing) we do the following which returns a view:

```php
public function show($slug = 'home')
{
	return Storyblok::bySlug($slug)->read()->render();
}
```

If you want to return the `Page` without rendering it just skip the `render()` method and it’ll give you the page object:

```php
Storyblok::bySlug('the-story-of-pusskin')->read();
```

Or by UUID:

```php             
Storyblok::byUuid('12345678-1234-1234-1234-123456789012')->read();
```