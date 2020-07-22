# Images

---

Storyblok comes with it’s own [image transformation service](https://www.storyblok.com/docs/image-service). Currently we don’t have any special support for this (it is a planned feature) but you can easily implement a simple solution such as the following:

```php
<?php

namespace App\Storyblok;

use Riclep\Storyblok\Block;

class DefaultBlock extends Block
{
    /**
     * @param $image the url of the image to transform
     * @param $param the transformation to apply
     * @return string
     */
	protected function transfromImage($image, $param) {
		$imageService = '//img2.storyblok.com/';
		$resource = str_replace('//a.storyblok.com', '', $image);
		return $imageService . $param . $resource;
	}
}
```

Now within your Blocks you can make methods that call the image service:

```php
<?php

namespace App\Storyblok\Blocks;

use App\Storyblok\DefaultBlock;

class Hero extends DefaultBlock
{
    // call as a method - $block->mobileImage()
	public function mobileImage() {
		return $this->transfromImage($this->image, '800x0');
	}

    // or as an accessor - $block->small_hero
	public function getSmallHeroAttribute() {
		return $this->transfromImage($this->image, '200x0/filters:quality(10)');
	}
}
```

Full details of the image transformation service are on the [Storyblok website](https://www.storyblok.com/docs/image-service).