# Requesting Pages

---

- [Passing additional data to views](#passing-additional-data-to-views)
- [Resolving related stories](#resolving-related-stories)
- [Resolving inverse relationship](#resolving-inverse-relationships)

Pages in Storyblok can be requested via their slug or UUID. If using the [catch-all route](/{{route}}/{{version}}/installation#routing) we do the following:

```php
// use Riclep\Storyblok\StoryblokFacade as StoryBlok;

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

### Resolving relations via a Block

If you’re not using a custom controller you can specify which relations you wish to resolve using the `$_resolveRelations` property on your Block. Simply create an array of the Storyblok field names containing the relations you wish to resolve. They will be requested and converted into Blocks for you.

By default the relationship’s component name will be used to determine which Class to use. If you want to use a different class you can specify it in the array.

```php
<?php

namespace App\Storyblok\Blocks;

use App\Storyblok\Block;

class Postcast extends Block
{
    public $_resolveRelations = [
       'hosts',
       'guests' => App\Storyblok\Blocks\Guest::class,
    ];
}
```

> {info} Using this mention of resolving relations will require additional API calls but the data will be cached after being requested.


### Unpublished relations

**Since 2.7.4**

If you link to an unpublished Story in one of your Multi-Option relations they are filtered out of the Collection of related Pages. If you need to know if a relation was removed from a Block set it’s `$_filterRelations` property to false. This wil return all valid relations as normal and `null` for failed relations. You can now handle this as required in your code.

For Single-Option relations `null` will be returned if the relation could not be resolved.

```php
<?php

namespace App\Storyblok\Blocks;

use App\Storyblok\Block;

class Home extends Block
{
    public $_filterRelations = false;
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

> {danger} It’s not recommended to set all Blocks to automatically resolve their linked stories as doing so could return a lot of deeply linked content or cause loops where Stories reference one another. Use with care!


<a name="resolving-inverse-relationships">
## Resolving inverse relationships
</a>

In Storyblok when you add a Single-Option or Multi-Option Stories relationship field to a component that relationship is one direction. For example a Podcast may have a Hosts relationship defined on it, but if we have loaded a Host how do we get the Podcasts they are a part of - how do we load the inverse relationship? We don’t want to add a relationship field to Hosts as then we need to manage it in both directions.

You can load an inverse relation using `inverseRelation('foreign_relation_field')` on a Block.

The first argument is the name of the relationship field on the foreign component, for example `hosts` on the Podcast component.

The second argument is the field type, `'multi'` (default) or `'single'`.

You can specify the component types to return using the third argument which should be an comma delimited list of component names.

Finally the last argument allows you to send additional parameters to the API call, for example `['per_page' => 10]`. See the [Storyblok API docs](https://www.storyblok.com/docs/api/content-delivery/v2) for more information.

```php
// $story is a Host component
// podcast has a Multi-Option relationship field called hosts
@foreach($story->block()->inverseRelation('hosts', 'multi')['stories'] as $podcast)
	{{ $podcast['name'] }}
@endforeach

// requesting the inverse of a Single-Option relation
$block->inverseRelation('foreign_relationship_field', 'single');

// requesting related stories of only specific component types
$block->inverseRelation('foreign_relationship_field', 'multi', 'component1,component2');

// requesting related stories of any type which start with the specificed slug
$block->inverseRelation('foreign_relationship_field', 'multi', null, ['starts_with' => 'some_slug/']);
```