# Folders

---

- [Pagination](#pagination)
- [Custom folders](#custom-folders)
- [Including folders within Pages](#folders-with-pages)
- [Advanced Filtering](#advanced-filtering)
- [Relations and Resolving Links](#relations-and-links)
- [Language and Versioning](#language-and-versioning)
- [Caching](#caching)

Folders are a way to request several Stories at once such as getting the latest news articles or a team of people. It wraps Storyblok’s API for [retrieving multiple stories](https://www.storyblok.com/docs/api/content-delivery#core-resources/stories/retrieve-multiple-stories).

The `read()` method will return a collection of Stories matching the specified criteria. After calling `read()`, the `totalStories` property will be populated with the total number of stories matching the query (ignoring pagination).

```php
$folder->read();
echo $folder->totalStories;
```

You can generate Folder classes using the built-in the `ls:folder` Artisan command. The folder name will be used for the class name and also set the folder’s slug but you can update this as required.

```bash

```console
php artisan ls:folder FolderName
```

To get a folder of Stories you can use the `App\Storyblok\Folder` Class in your controller specifying the slug of the folder in Storyblok you wish to read from.


```php
<?php

namespace App\Http\Controllers;

use App\Storyblok\Folder;

class NewsController extends Controller
{
	public function index() {
		$stories = new Folder();
		$stories->slug('news');

		return view('storyblok.pages.news', [
				'stories' => $stories->read()
			]
		);
	}
}
```

You can access many of a Folder’s settings fluently by chaining methods. For example, to get the first five services by their name field you could do the following:

```php
<?php

namespace App\Http\Controllers;

use App\Storyblok\Folder;

class ServiceController extends Controller
{
	public function index() {
		$folder = new Folder();

		return view('storyblok.pages.news', [
				'stories' => $folder->slug('services')->sort('content.name', \Storyblok\Api\Domain\Value\Dto\Direction::Asc)->perPage(5)->read()
			]
		);
	}
}
```

### Setting the path to request

Call the `slug()` method with the path to the content you wish to request from Storyblok. The argument’s value maps to the `starts_with` property of the API call so be sure to [check the Storyblok documentation](https://www.storyblok.com/docs/api/content-delivery#core-resources/stories/retrieve-multiple-stories).

### Sorting the requested items

By default folders are order by their publish date in descending order - so newest items first.

You can change the sort order with the `sort($field, Direction $order)` method, it accepts any valid sort as specified in the Storyblok documentation such as `sort('content.YOUR_FIELD', Direction::Asc)`. [Read their docs for full details](https://www.storyblok.com/docs/api/content-delivery#core-resources/stories/retrieve-multiple-stories).

There are also two helper methods for changing order - `asc($field)` and `desc($field)`.

```php
$folder->asc('content.name');
$folder->desc('first_published_at');
```

### Filtering and refinement

Version 3 introduces strongly typed methods for filtering your requests.

```php
use Storyblok\Api\Domain\Value\QueryParameter\PublishedAtGt;

$folder->publishedAtGt(new PublishedAtGt('2023-01-01 00:00'));
```

Available methods include:
- `publishedAtGt(PublishedAtGt $value)`
- `publishedAtLt(PublishedAtLt $value)`
- `firstPublishedAtGt(FirstPublishedAtGt $value)`
- `firstPublishedAtLt(FirstPublishedAtLt $value)`
- `updatedAtGt(UpdatedAtGt $value)`
- `updatedAtLt(UpdatedAtLt $value)`
- `searchTerm(string $term)`
- `withTags(TagCollection $tags)`
- `startsWith(Slug $slug)`
- `slug(string $slug)` - a wrapper for `startsWith`
- `contentType(string $contentType)`
- `level(StoryLevel $level)` - filters by the depth level of the stories
- `startPage(bool $isStartpage)` - only include the start page of the folder

---

<a name="advanced-filtering">
## Advanced Filtering
</a>

You can further refine your results by excluding specific fields, IDs, or slugs.

```php
use Storyblok\Api\Domain\Value\Field\FieldCollection;
use Storyblok\Api\Domain\Value\IdCollection;
use Storyblok\Api\Domain\Value\Slug\SlugCollection;

$folder->excludeFields(new FieldCollection(['content.long_text']))
    ->excludeIds(new IdCollection([12345, 67890]))
    ->excludeSlugs(new SlugCollection(['news/boring-story']));
```

If you want to request only specific stories by their slugs:

```php
$folder->bySlugs(new SlugCollection(['news/important-story', 'news/another-story']));
```

---

<a name="relations-and-links">
## Relations and Resolving Links
</a>

To resolve relations or links within your stories, use `withRelations()` and `resolveLinks()`.

```php
use Storyblok\Api\Domain\Value\Resolver\RelationCollection;
use Storyblok\Api\Domain\Value\Resolver\ResolveLinks;

$folder->withRelations(new RelationCollection(['author.name']))
    ->resolveLinks(new ResolveLinks('url'));
```

---

<a name="language-and-versioning">
## Language and Versioning
</a>

If you are working with multiple languages or want to request a specific version of your stories:

```php
use Storyblok\Api\Domain\Value\Dto\Version;

$folder->language('de')
    ->version(Version::Draft); // or Version::Published
```

---

<a name="caching">
## Caching
</a>

By default, folder requests are cached. You can customize the cache key by overriding the `$cacheKey` property in your custom Folder class.

```php
class FeaturedNews extends Folder
{
    protected string $cacheKey = 'featured-news-';
}
```

---

<a name="pagination">
## Pagination
</a>

To paginate your folder use the `perPage()` method before `read()` specifying the number of items per page.

```php
$stories = new NewsFolder();
$stories->perPage(10)->read();
```

Folder’s don’t know what page they are on by default, you can tell them by passing the `page` number.

```php
<?php

namespace App\Http\Controllers;

use App\Storyblok\Folders\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
	public function index(Request $request)
	{
		$news = new News();
		$news->page((int)$request->get('page') ?: 1);

		return view('pages.news', [
			'stories' => $news->perPage(10)->read(),
		]);
	}
}
```

The package uses Laravel’s `LengthAwarePaginator` [see the Laravel docs](https://laravel.com/docs/9.x/pagination#displaying-pagination-results) for customisation options. 

To display the standard pagination links in your view do the following:

```blade
{!! $stories->paginate()->links() !!}
```

---

<a name="custom-folders">
## Custom folders
</a>

Rather than calling multiple methods each time you need to request a folder you can create custom Folder class by extending `\Riclep\Storyblok\Folder`. Within this class you should use the `setDefaults()` method to set any defaults.

Here is an example that loads Stories from the ‘news’ folder that where published any time before `now()`, ordering them by a `publish_date` datetime field.

```php
<?php

namespace App\Storyblok\Folders;

use Riclep\Storyblok\Folder;
use Storyblok\Api\Domain\Value\Dto\Direction;
use Storyblok\Api\Domain\Value\QueryParameter\PublishedAtLt;

class News extends Folder
{
	protected function setDefaults(): void
	{
		$this->slug('news')
			->sort('content.published_at', Direction::Desc)
			->publishedAtLt(new PublishedAtLt(now()->format('Y-m-d H:i')))
			->perPage(20);
	}
}
```

And in your controller you simply need to instantiate your Folder class - no need to call any methods. This is handy if you need to reuse a Folder in several locations. Of course you can still override individual settings by calling the above methods if needed.

```php
<?php

namespace App\Http\Controllers;

use App\Storyblok\Folders\News;

class NewsController extends Controller
{
	public function index() {
		$news = new News();

		return view('storyblok.pages.news', [
       			'news' => $news->read()
       		]
       	);
	}
}
```

---

<a name="folders-with-pages">
## Including folders within Pages
</a>

Here’s a more complete controller that loads the root `news` page Story and additional  Stories from the `news` folder, passing them to the Page’s view.

```php
<?php

namespace App\Http\Controllers;

use App\Storyblok\Folders\News;
use Riclep\Storyblok\StoryblokFacade as StoryBlok;

class NewsController extends Controller
{
	public function index() {
		$news = new News();

		return Storyblok::bySlug('/news')->read()->render(
			[
				'news' => $news->read()
			]
		);
	}

	public function show($slug) {
		return Storyblok::bySlug('/news/' . $slug)->read()->render();
	}
}
```

> {info} View Components are another great way load folders into your content blocks.
