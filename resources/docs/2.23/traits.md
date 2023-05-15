# Traits

---

You can extend the functionality of your [Blocks](/{{route}}/{{version}}/blocks) by adding methods to individual ones or your `DefaultBlock` but this limits their reuse between projects.

Another option is to use Traits and we have added some helpful features to get the most out of them. This is how we implement features like converting Markdown.

> {info} You can also use Traits on `Pages` in exactly the same manner.

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
     * It is run when automatically when this Trait is used on a class.
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

namespace App\Storyblok;

use App\Storyblok\Traits\TruncateStrings;

class SomeComponent extends \App\Storyblok\DefaultBlock
{
    use TruncateStrings;

    protected $toTruncate = ['introduction'];
}
```