# Folders

---

- [Pagination](#pagination)
- [Custom folders](#custom-folders)
- [Including folders within Pages](#folders-with-pages)

Folders are a way to request several Stories at once such as getting the latest news articles or a team of people. It wraps Storyblok’s API for [retrieving multiple stories](https://www.storyblok.com/docs/api/content-delivery#core-resources/stories/retrieve-multiple-stories). The `read()` method will return a collection of Stories matching the specified criteria.

To get a folder of Stories you can use the `DefaultFolder` Class in your controller specifying the slug where they are staved in Storyblok, for example.

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

### Setting the path to request

Call the `slug()` method with the path to the content you wish to request from Storyblok. The argument’s value maps to the `starts_with` property of the API call so be sure to [check the Storyblok documentation](https://www.storyblok.com/docs/api/content-delivery#core-resources/stories/retrieve-multiple-stories).

### Sorting the requested items

The `sort()` method accepts any valid string as specified in the Storyblok documentation such as `content.YOUR_FIELD:asc` or `content.YOUR_FIELD:desc`. [Read their docs for full details](https://www.storyblok.com/docs/api/content-delivery#core-resources/stories/retrieve-multiple-stories).

### Further refinement

If you need more control over your request the `settings()` method accepts an array of parameters allowing you to specify any part of the request.

---

<a name="pagination">
## Pagination
</a>

To paginate your folder use the `perPage()` method being `read()` specifying the number of items per page.

```php
$stories = new Folder();
$stories->perPage(10)->read();
```

> {warning} If you change the `per_page` value in the `$settings` array make sure you match the value in `perPage()`. `perPage() does update `settings` so it’s recommended to only use the method.

Folder’s don’t know what page they are on, you need to tell them by passing the `page` number to their `settings`.

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
		$news->settings([
			'page' => (int)$request->get('page') ?: 1,
		]);

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

Rather than calling multiple methods each time you need to request a folder you can create custom Folder class by extending `\App\Storyblok\DefaultFolder`. Within this class you are free to set any defaults or create methods to fulfill your requirements.

Here is an example that loads Stories from the ‘news’ folder that where published any time before `now()`, ordering them by a `publish_date` datetime field.

```php
<?php

namespace App\Storyblok\Folders;

class News extends \App\Storyblok\Folder
{
	protected $slug = 'news';
	protected $sort = 'content.published_at:desc';

	public function __construct()
	{
		$this->settings([
			'filter_query' => [
				'published_at' => [
					'lt_date' => now()->format('Y-m-d H:i'),
				]
			],
			'per_page' => 20
		]);
	}
}
```

And in your controller you simply need to instantiate your Folder class - no need to call any methods. This handy if you need to reuse a Folder in several locations. Of course you can still override individual settings by calling the above methods if needed.

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