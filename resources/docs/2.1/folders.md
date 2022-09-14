# Folders

---

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

<a name="custom-folders">
## Custom folders
</a>

Rather than calling multiple methods each time you need to request a folder you can create custom Folder class by extending `\App\Storyblok\DefaultFolder`. Within this class you are free to set any defaults or create methods to fulfill your requirements.

Here is an example that loads Stories from the ‘news’ folder that where published any time before `now()`, ordering them by a `published_at` datetime field.

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