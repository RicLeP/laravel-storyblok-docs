# Assets

---

Assets are a special type of Field with additional functionality. Where possible to try to detect the type of file upload and return an appropriate Field. `Image` classes are returned when the file has one of the following extensions: ‘.jpg’, ‘.jpeg’, ‘.png’, ‘.gif’, ‘.webp’. See the [Image documentation](/{{route}}/{{version}}/images) for more.


## Checking for a file

To check if a file has been uploaded in Storyblok call `hasFile()` on the Asset.

```php
$myAsset->hasFile();
```

> {info} When using multi-asset fields we only receive a URL from Storyblok the Asset|Image fields are less complete.
