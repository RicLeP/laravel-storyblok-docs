# Pages

---

- [Requestng the page](#requesting)
- [Rending pages](#rendering)
- [Page title](#page-title)
- [Meta description](#meta-description)
- [Schema.org data](#schema-org-data)
- [Open Graph and SEO](#seo)

# TODO passing data to views - routing

Only Storyblok components that can ‘[act as a content type](https://www.storyblok.com/docs/Guides/root-blocks)’ may be used as Pages and are transformed into a matching Page class. They are similar to [blocks](/{{route}}/{{version}}/blocks) but have some special features of their own.

All pages will use the `DefaultPage` class by default but you can specify your own types by simply making a class called ‘ComponentName’ within ‘app/Storyblok/Pages’ that extends `Riclep\Storyblok\Page`. For example a component called ‘kittens’ would become `App\Storyblok\Pages\Kittens`.

```php
<?php

namespace App\Storyblok\Pages;

use Riclep\Storyblok\Page;

class Kittens extends Page
{

}
```

> {info} If you want to define defaults for all your Page classes then add them to `App\Storyblok\DefaultPage\` class and extend this instead of `Riclep\Storyblok\Page`.

<a name="rendering">
## Rendering pages
</a>

Every page implements a `render()` method that returns a view with the following data passed to it:


| Variable           | Content                                               |
| :-                 | :-                                                    |
| `story`            | Story object                                          |

> {warning} In prior versions more individual variables were passed but now we just send the entire Page.

You are free to choose how you wish to display this data. You may want to create one single Blade file and loop over the nested objects. Alternatively you might pass some of the content to @includes. Each Block is also self-renderable - calling it’s render() method will pass it’s contents to a matching view.

> {info} If you’d like to customise how which Blade view to choose is determined then override the `views()` method on your Page class returning an array of paths suitable for Laravel’s `view()->first([$this->views()], ...)` method.


<a name="page-title">
## Page title
</a>

Every page should have a `<title>` tag, to make populating that easy the `Page` class comes with a `title()` method. By default, if you have the Storyblok SEO app installed, it will use the SEO title, failing that it uses the name you gave when creating the page. If you want more control just override the method.


<a name="meta-description">
## Meta description
</a>

If the Storyblok SEO app is installed this will return the description inputted there, if not installed it uses the value specified in the `storyblok.php` config file. Of course you can replace this method with your own logic.


> {info} If you’re taking the time and care to optimise for search engines don’t forget to also use semantic HTML tags. You’ve got a [whole host of tags](https://developer.mozilla.org/en-US/docs/Web/HTML/Element) to choose from. They’ll not only improve SEO performance but will but make the site more accessible and your HTML easier to read.



<a name="schema-org-data">
## Schema.org data
</a>

[Schema.org](https://schema.org) is a collaborative, community activity with a mission to create, maintain, and promote schemas for structured data on the Internet, on web pages, in email messages, and beyond. These schemas are designed to be machine readable allowing you to provide structured data for search engines, social networks and bots.

We use the super [Spatie Schema.org](https://github.com/spatie/schema-org) package.

To add Schema.org meta data for you Page use the `Riclep\Storyblok\Traits\SchemaOrg` trait add a `schemaOrg` method that returns a Spatie schema.

```php
<?php

namespace App\Storyblok\Pages;

use Riclep\Storyblok\Page;
use Riclep\Storyblok\Traits\SchemaOrg;
use Spatie\SchemaOrg\Schema;

class Specific extends Page
{
	use SchemaOrg;

	protected function schemaOrg() {
		return Schema::localBusiness()
			->name('None of your business')
			->email('ric@sirric.co.uk')
			->contactPoint(Schema::contactPoint()->areaServed('Worldwide'));
	}
}
```

To output the `<script>` tags call `$story->schemaOrgScript()` in your view, it includes the schemas for every Block on the page. This is best placed in the `<head>`.

> {info} See the [Spatie package](https://github.com/spatie/schema-org) for full docs.


<a name="seo">
## Open Graph and Search Engine Optimisation
</a>

Storyblok comes with a [handy plugin](https://www.storyblok.com/apps/seo) for managing your SEO and [Open Graph](https://ogp.me/) meta data which we support out of the box. If you’re not using it, don’t worry, nothing will break.

By default Storyblok includes the SEO data within the page component’s content properties. We yank it out of there and put it in a `seo` property of the `Page` class separating the page’s meta and regular content, this is then passed to the view and can be used as so:

```html
<!doctype html>
<html lang="en">
<head>
    ...
    <meta property="og:title" content="@{{ $seo['og_title'] }}">
    <meta property="og:image" content="@{{ $seo['og_image'] }}">
    ...
</head>
<body>
    ...
</body>
</html>
```

You can define the field you want to use for the title and description.

```php
<?php

namespace App\Storyblok\Pages;

use Riclep\Storyblok\Page;

class Specific extends Page
{
	protected $titleField = 'use_for_title';

	protected $descriptionField = 'use_for_description';
}
```

### //TODO - using title and description




