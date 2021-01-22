# Typography

---

- [Applying typography](#applying-typography)
- [Customising the settings](#customising-the-settings)

A lot of people will probably be using Storyblok for brochureware style websites or rich, stylised content. We want to help make your text look as beautiful as possible - you might not be able to rely on clients or content editors to use proper curly quotes or find variable length content is leaving widows all over our breakpoints! For that reason we built in some handy typographical features to really make your content sing. We do this by piggybacking on top of [PHP-Typography](https://github.com/mundschenk-at/php-typography).

<a name="applying-typography">
## Applying typography
</a>

To use the typographic features your Block must use the `AppliesTypography` trait. This exposes a couple of new properties and methods. Add an `$applyTypography` property to your class with an array of the fields. Now call the `applyTypography()` method - a good place to do this is in the `init()` method that will be called when the Block is newed up. This will run PHP-Typography over all the chosen fields using some sensible defaults.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;
use Riclep\Storyblok\Traits\AppliesTypography;

class TypoCat extends Block
{
    use AppliesTypography;

	private $applyTypography = ['cats_name', 'biography'];

	public function init() {
		$this->applyTypography();
	}
}
```

---

<a name="customising-the-settings">
## Customising the settings
</a>

You don’t have to use our settings, you can supply your own. Create a new `TypographySettings()` instance and apply the settings you want then pass it to the `setTypographySettings()` method on the Block.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;
use Riclep\Storyblok\Traits\AppliesTypography;
use PHP_Typography\Settings as TypographySettings;

class TypoKitten extends Block
{
    use AppliesTypography;

	private $applyTypography = ['cats_name', 'biography'];

	public function init() {
        $settings = new TypographySettings();
        $settings->set_classes_to_ignore('.whiskers');
        $settings->set_hyphenation(true);
        $settings->set_smart_quotes(false);

        $this->setTypographySettings($settings);
		$this->applyTypography();
	}
}
```

PHP-Typography supports a range of enhancements and features including:

- Hyphenation — over 50 languages supported
- Space control, including:
    - widow protection
    - gluing values to units
    - forced internal wrapping of long URLs & email addresses
- Intelligent character replacement, including smart handling of:
    - quote marks (‘single’, “double”)
    - dashes ( – )
    - ellipses (…)
    - trademarks, copyright & service marks (™ ©)
    - math symbols (5×5×5=53)
    - fractions (1⁄16)
    - ordinal suffixes (1st, 2nd)
- CSS hooks for styling:
    - ampersands,
    - uppercase words,
    - numbers,
    - initial quotes & guillemets.


> {info} To discover all the possible options check out the [PHP-Typography package](https://github.com/mundschenk-at/php-typography).