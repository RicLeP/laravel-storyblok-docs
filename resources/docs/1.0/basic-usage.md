# Basic usage

---

- [TODO](#todo)


Once [installed](/{{route}}/{{version}}/installation) you can start working with Storyblok in your Laravel application just by creating the appropriate Blade views.

The package will consume Storyblok’s JSON responses and automatically convert them to nested PHP objects. The type of object created can be set just by matching it’s filename to that od the Storyblok component. This is covered in more detail in the [blocks documentation](/{{route}}/{{version}}/blocks).

Create the following folder `resources/views/storyblok/pages`, this is the default location where you will store all of your Blade views but you are free to use any structure you want. You can read more about how the package selects which view is loaded and how to define your own rules in the [views documentation](/{{route}}/{{version}}/views).

> {info} You can change the default view path in the `storyblok.php` configuration file

---

## Determining the view to use

The `DefaultPage` looks for views matching the current URL structure, when no matching file is found it walks down the path until it finds a file that does. Take the following example:

```php
// Available views
resources/views/storyblok/pages/about.blade.php
resources/views/storyblok/pages/about/the-team.blade.php
resources/views/storyblok/pages/news.blade.php
resources/views/storyblok/pages/about/default.blade.php

```

### Result

| URL    | View |
|   :-   |  :-  |
| example.com/about          | resources/views/storyblok/pages/about.blade.php          |
| example.com/about/the-team | resources/views/storyblok/pages/about/the-team.blade.php |
| example.com/about/history  | resources/views/storyblok/pages/about.blade.php          |
| example.com/about/news     | resources/views/storyblok/pages/news.blade.php          |
| example.com/contact/       | resources/views/storyblok/pages/default.blade.php        |

- As no `history.blade.php` file exists the first matching file will be `about.blade.php` - it uses the URL’s path.
- The `about/news` URL doesn’t have a matching file in the `about` folder but there is a `news.blade.php` file in the root so this will be loaded.
- When no views are found `default.blade.php` is loaded.

---

## Available Data

The `DefaultPage` passes four variables to the view, the most important of which is `story` - this contains nested `DefaultBlock`s matching the JSON structure returned by the Storyblok API.

```php
[
	'title' => $this->title(),
	'meta_description' => $this->metaDescription(),
	'story' => $this->content(),
	'seo' => $this->seo,
];
```

Accessing the data is as simple as walking down the nested objects - each exposes the available fields from Storyblok as properties. Take the following response from Storyblok (simplified for brevity).

```json
{
	"story": {
		"name": "Home",
		...
		"content": {
			"hero": [
				{
					"_uid": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
					"headline": "This package allows you to easily use Storyblok with Laravel.",
					"component": "hero"
				}
			],
			"intro": [
				{
					"_uid": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
					"text": "Use the power of Storyblok with the elegance of Laravel.",
					"button": [
						{
							"url": {
								"id": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
								"url": "",
								"linktype": "story",
								"fieldtype": "multilink",
								"cached_url": "more/"
							},
							"_uid": "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
							"label": "Find out more",
							"component": "link_button"
						}
					],
					"component": "text_with_button"
				}
			],
			"component": "homepage"
		},
		...
	}
}
```

It will be convered into the following structure:

```php
use App\Storyblok\DefaultBlock;
use Illuminate\Support\Collection;

DefaultBlock {
    #component: "homepage"
    #content: Collection {
        #items: {
            "hero" => DefaultBlock {
                #component: hero
                #content: Collection {
                    0 => DefaultBlock {
                        #_uid: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                        #component: "hero",
                        #content: Collection {
                            #items: {
                                "headline" => "This package allows you to easily use Storyblok with Laravel."
                            }
                        }
                    }
                }
            },
            "intro" => DefaultBlock {
                #component: intro
                #content: Collection {
                    0 => DefaultBlock {
                        #_uid: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                        #component: "text_with_button",
                        #content: Collection {
                            #items: {
                                "text" => "Use the power of Storyblok with the elegance of Laravel.",
                                "button" => DefaultBlock {
                                    #_uid: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                                    #component: "button",
                                    #content: Collection {
                                        #items: {
                                            0 => DefaultBlock {
                                                #_uid: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                                                #component: "link_button",
                                                #content: Collection {
                                                    #items: {
                                                        "url" => DefaultBlock {
                                                            #_uid: "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx",
                                                            #component: "url",
                                                            #content: Collection {
                                                                #items: {
                                                                    "id" => "2f05310d-c69b-4cf9-b7cc-732649b90fae",
                                                                    "url" => false,
                                                                    "linktype" => "story",
                                                                    "fieldtype" => "multilink",
                                                                    "cached_url" => "services/"
                                                                }
                                                            }
                                                        },
                                                        "label" => "Find out more"
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
```

To use this in your Blade views simply do the following.

```html
<main>
    <header class="video-hero">
        <h1>@{{ $story->hero[0]->headline }}</h1>
    </header>

    <section>
        <p>@{{ $story->intro[0]->text }}</p>

        <a href="@{{ $story->intro[0]->button[0]->url->cached_url }}">
        	@{{ $story->intro[0]->button[0]->label }}
        </a>
    </section>
</main>

```

Of course each Storyblok component doesn’t have to be a `DefaultBlock`, it can have it’s own type Block that is free to manipulate the data as you feel fit. The package also contains several built in features that will be familiar to anyone who’s used Eloquent such as date casting and mutators.