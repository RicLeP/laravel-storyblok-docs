---
title: Traits
description: 'Extending Block and Page functionality with reusable traits in Laravel Storyblok.'
---

# Traits

---

You can extend the functionality of your [Blocks](blocks.md) by adding methods to individual ones or your `DefaultBlock` but this limits their reuse between projects.

Another option is to use Traits and we have added some helpful features to get the most out of them. This is how we implement features like converting Markdown.

> [!NOTE]
> You can also use Traits on `Pages` in exactly the same manner.

## Running methods when initialised 

Maybe you need a method that truncates selected strings when a Block is created. You add this to a trait and want the method to be run automatically. This can be done by adding a method called `initTraitName` to your trait as follows.

```php
namespace App\Storyblok\Traits;

use Illuminate\Support\Str;

trait TruncateStrings
{
	protected array $toTruncate = [];

	/**
     * A fairly pointless method to truncate selected content to 10 words.
     * It is run automatically when this Trait is used on a class.
     */
    public function initTruncateStrings() {
		if (!empty($this->toTruncate)) {
			foreach ($this->toTruncate as $field) {
					$this->content[$field] = Str::words($this->content[$field], 10);
			}
		}
	}
}
```

```php
<?php

namespace App\Storyblok\Blocks;

use App\Storyblok\Traits\TruncateStrings;
use Riclep\Storyblok\Block;

class SomeComponent extends Block
{
    use TruncateStrings;

    protected array $toTruncate = ['introduction'];
}
```
