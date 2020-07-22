# Fields

---

- [Built-in Fields](#built-in-fields)
- [Custom Fields](#custom-fields)

Fields are classes that the Block’s fields are turned into. There are lots of built-in types and where possible they are automatically cast but it is possible to create your own.


<a name="built-in-fields">
## Built-in Fields
</a>

Listed below is how we transform each of the built in fieldtypes. The Field classes are all under the `Riclep\Storyblok\Fields` namespace.

| Storyblok Fieldtype      | Cast Class   | Comments                                                                  |
|--------------------------|--------------|---------------------------------------------------------------------------|
| text                     | None           | Is not cast. Original string returned. Can be manually cast to `Textarea` |
| textarea                 | None           | Is not cast. Original string returned. Can be manually cast to `Textarea` |
| richtext                 | `RichText`     | Automatically converts content to HTML when field is called               |
| markdown                 | `Markdown`     | Automatically converts content to HTML when field is called               |
| number                   | None           | Is not cast. Original value returned                                      |
| datetime                 | None           | Is not cast. Original value returned. Can be manually cast to `Datetime`  |
| boolean                  | None           | Is not cast. Original value returned                                      |
| multi-options            | None           | Is not cast. Original value returned                                      |
| multi-options (stories)  | [`Block`]      | If [relations are resolve](/{{route}}/{{version}}/requesting-pages#resolving-related-stories) the correct Block type is cast |
| single option (stories)  | None           | Is not cast. Original value returned                                      |
| single options (stories) | [`Block`]      | If [relations are resolve](/{{route}}/{{version}}/requesting-pages#resolving-related-stories) the correct Block type is cast |
| asset                    | `Asset`\|`Image` | Checks the file extension and casts to the appropiate class             |
| multi-asset              | `MultiAsset`   | Contains a Collection of Asset and/or Image Fields                        |
| link (story)             | `StoryLink`    |                                                                           |
| link (url)               | `UrlLink`      | `toString()` prints the URL                                               |
| link (email)             | `EmailLink`    | `toString()` prints the email address                                     |
| link (asset)             | `AssetLink`    | `toString()` prints the URL                                               |
| blocks                   | [`Block`]      | Array of child Blocks, cast to their correct type                         |
| table                    | `Table`        | Currently does nothing - transformations to come                          |


<a name="custom-fields">
## Custom Fields
</a>

Custom Fields can be used in several ways and must extend either an existing field or the `Riclep\Storyblok\Field` abstract class. If extending the abstract class be sure to implement the `toString()` method to allow this field to be easly used in Blade templates. A Field’s constructor takes the content from Storyblok and a reference to the Block it is part of. Fields are free to edit their contents any way you see fit.

The built-in Fields analyse the content from Storyblok when determining if they should be cast or not. With custom fields, like Pages and Blocks, they use a naming convention when determining if they should be used. Custom Fields are stored in the `App\Storyblok\Fields` namespace.

> {info} The order in which classes are checked for is: **Block Casts > BlockNameFieldName > FieldName > Built-in**.

### Universal Fields

A Class matching the Studly case version of field’s name from Storyblok is checked for. If you have a field called ‘episode_title’ it will match a class called `EpisodeTitle`.

> {warning} Be careful with universal Fields as they will match any Storyblok field matching their name regardless of content type and location.

### Block specific Fields

A Class matching the Studly case version of the Block’s name then field’s name from Storyblok is checked for. So if we have a Block called ‘podcast’ with a field called ‘episode_title’ it will match a class called PodcastEpisodeTitle.

### Manually casting Fields

If you need more precise control you can manually cast a Block’s Fields using the Block’s `$cast` property. Below we cast `release_date` to the built-in `Datetime` Field and `image` to a custom `HeroImage` Field.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Fields\DateTime;
use Riclep\Storyblok\Block;
use App\Storyblok\Fields\HeroImage;

class Postcast extends Block
{
	protected $casts = [
		'release_date' => DateTime::class,
		'image' => HeroImage::class,
	];
}
```

> {info} If you are making a custom Field for one of the built-in types it’s best to extend the built-in class to take advantage of any existing functionality such as converting rich-text content or ArrayAccess and Interator functionality on MultiAsset fields. 