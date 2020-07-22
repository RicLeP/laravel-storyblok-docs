# Requesting Pages

---

- [Passing additional data to views](#passing-additional-data-to-views)
- [Resolving related stories](#resolving-related-stories)

Pages in Storyblok can be requested via their slug or UUID. If using the [catch-all route](/{{route}}/{{version}}/installation#routing) we do the following:

```php
public function show($slug = 'home')
{
	return Storyblok::read($slug)->render();
}
```

If you want to return the `Page` without rendering it just skip the `render()` method and it’ll give you the Page object.

```php
$story = Storyblok::read('the-story-of-pusskin');
```

You can also request stories by UUID:

```php
$story = Storyblok::read('12345678-1234-1234-1234-123456789012');
```

<a name="passing-additional-data-to-views">
## Passing additional data to views
</a>

If you need to pass more data to blade just pass an array of variables to the `render()` method.

```php
<?php
// EpisodeController.php

namespace App\Http\Controllers;

use App\Storyblok\Folders\Episodes;
use Riclep\Storyblok\StoryblokFacade as StoryBlok;

class EpisodeController extends Controller
{
	public function index() {
		$folder = new Episodes();
		$folder->slug('episodes');

		return Storyblok::read('home')->render([
			'episodes' => $folder->read(),
            'some_data' => ['the', 'curiosity', 'of', 'a', 'child']
		]);
	}
}
```

> {warning} Remember to add your routes before the catch-all route if you’re using it or they’ll never be hit.

You don’t have to use the `render()` method, simply passing the Page object to a view will suffice.

```php
<?php
// EpisodeController.php

namespace App\Http\Controllers;

use App\Storyblok\Folders\Episodes;
use Riclep\Storyblok\StoryblokFacade as StoryBlok;

class EpisodeController extends Controller
{
	public function index() {
        return view('some.view', [
            'my_story' => Storyblok::read('home'),
        ]);
	}
}
```


<a name="resolving-related-stories">
## Resolving related stories
</a>

When you link to other stories using single or multi-option fields in Storyblok the JSON response will just return their UUIDs. If you want to include them in your response then you need to [resolve the relationships](https://www.storyblok.com/tp/using-relationship-resolving-to-include-other-content-entries). We make this really simple, just pass an array of relationships matching `component_name.field_name` to the `read()` method.

```php
<?php
// EpisodeController.php

namespace App\Http\Controllers;

use Riclep\Storyblok\StoryblokFacade as StoryBlok;

class EpisodeController extends Controller
{

	public function show($slug)
	{
		return Storyblok::read($slug, ['component_name.field_name', 'hosts.profiles'])->render();
	}

}
```

### Automatically resolving relations

It’s also possible to automatically resolve relations. On any Block class set `$_autoResolveRelations` to `true`. It’s recommended to pass the array of relations to the `read()` method instead of autoresolving them as this minimising the API calls.

```php
<?php

namespace App\Storyblok;

use Riclep\Storyblok\Block as BaseBlock;

class Block extends BaseBlock
{
    public $_autoResolveRelations = true;
}
```

> {warning} It’s not recommended to set all Blocks to automatically resolve their linked stories as doing so could return a lot of deeply linked content or cause loops where Stories reference one another. Use with care!