# Pages

---

- [Requestng the page](#requesting)
- [Rending pages](#rendering)
- [Page meta](#page-meta)
- [Schema.org data](#schema-org-data)

Everything starts with a Page, it contains all the Blocks making up the content and also useful meta information. In Storyblok every page is based on a component that can ‘[act as a Content Type](https://www.storyblok.com/docs/Guides/root-blocks)’. Each Content Type can have it’s own corresponding class on your website. Every Page also contains a root Block, you can access via `$page->block()`, which contains the Content Type’s data like any other Block.

All pages will use the `App\Storyblok\Page` class by default but you can specify your own by simply making a class matching the component’s within `app/Storyblok/Pages` that extends `Riclep\Storyblok\Page`. For example a component called ‘kittens’ would become `App\Storyblok\Pages\Kittens`.

```php
<?php

namespace App\Storyblok\Pages;

use Riclep\Storyblok\Page;

class Kittens extends Page
{

}
```

> {info} If you want to define defaults for all your Page classes then add them to `App\Storyblok\Page\` class and extend this instead of `Riclep\Storyblok\Page`.

To request multiple pages, such as a list of news articles, look at [`Folders`](/{{route}}/{{version}}/folders).


<a name="rendering">
## Rendering pages
</a>

Every page implements a `render()` method that returns a view with the `$story` object passed to it. You are free to choose how you wish to display this data. You may want to create one single Blade file and loop over the nested Blocks and Fields. Alternatively you might want to loop over Blocks and pass their content into include files. Each Block is also self-renderable - calling it’s render() method will pass it’s contents into a view matching it’s name.

> {info} If you’d like to customise how which Blade view to choose is determined then override the `views()` method on your Page class returning an array of paths suitable for Laravel’s `view()->first()` method.


<a name="page-meta">
## Page meta
</a>

The Page object contains useful meta content about the page. This could have been read from the Storyblok response data, added via a Block or could be Schema.org meta content. When first processed a Page’s meta will contain it’s name, full_slug and any tags added in Storyblok.

```php
$page->meta(); // returns full meta array
$page->meta('full_slug'); // returns just this items
$page->meta('missing_item', 'default value'); // returns the default if the item is missing
```

<a name="schema-org-data">
## Schema.org data
</a>

[Schema.org](https://schema.org) is a collaborative, community activity with a mission to create, maintain, and promote schemas for structured data on the Internet, on web pages, in email messages, and beyond. These schemas are designed to be machine readable allowing you to provide structured data for search engines, social networks, bots and more. We use the super [Spatie Schema.org](https://github.com/spatie/schema-org) package to help you convert your Storyblok data into something friendly for Schema.org.

To use Schema.org add the `Riclep\Storyblok\Traits\SchemaOrg` trait to the Page and implement a `schemaOrg()` method on your Page returning a Spatie Schema.org object. Schemas can also be defined in Blocks and will be included on any Page using that Block.

```php
<?php

namespace App\Storyblok\Pages;

use Riclep\Storyblok\Page;
use Spatie\SchemaOrg\Schema;
use Riclep\Storyblok\Traits\SchemaOrg;

class WithSchemaOrg extends Page
{
	use SchemaOrg;

	protected function schemaOrg() {
		return Schema::localBusiness()
			->name('On the page')
			->email('ric@sirric.co.uk')
			->contactPoint(Schema::contactPoint()->areaServed('Worldwide'));
	}
}
```

To output the `<script>` tags call `$story->schemaOrgScript()` in your view. This is best done in the `<head>` of the page.

> {info} See the [Spatie package](https://github.com/spatie/schema-org) for full docs.
