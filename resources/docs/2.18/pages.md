# Pages

---

- [Requestng the page](#requesting)
- [Rending pages](#rendering)
- [Page meta](#page-meta)
- [Schema.org data](#schema-org-data)
- [Shared and global content](#global-content)

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

<a name="global-content">
## Shared and global content
</a>

There are times when you want to have content that is available on multiple or every page. This could be a footer, header or navigation. There are different ways to achieve this.

### Shared content with view components

If you want to be able to choose when and where you use shared content then Laravel’s View Components are perfect for this task. Within the component’s class request the Story you want to use and it’ll be passed to the view. You may with to add the shared content to it’s own folder in Storyblok to keep things organised.

```php
<?php

namespace App\View\Components;

use Exception;
use Illuminate\View\Component;
use Riclep\Storyblok\StoryblokFacade as StoryBlok;

class Header extends Component
{
	public $json;


    public function __construct()
    {
		$headerMenu = Storyblok::read('/shared/header-menu');
    }

    public function render()
    {
        return view('components.header');
    }
}
```

### Global content

If you want to make content globally available to all pages and views it’s possible to share it within a Service Provider using the `View` facade’s `share` method. How you choose to structure and name your global content is up to you.

Whilst it may be tempting to share lot’s of content this way it can lead to cluttered views and a lot of unnecessary data being passed to the view. It’s best to use this sparingly.

```php
<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Riclep\Storyblok\StoryblokFacade as StoryBlok;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('shared-key', Storyblok::read('/shared/global-data'));
    }
}
```