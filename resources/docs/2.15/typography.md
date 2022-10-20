# Typography

---

- [Applying typography](#applying-typography)
- [Customising the settings](#customising-the-settings)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/riclep/laravel-storyblok-typography.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok-typography)
[![Total Downloads](https://img.shields.io/packagist/dt/riclep/laravel-storyblok-typography.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok-typography)
[![Twitter](https://img.shields.io/twitter/follow/riclep.svg?style=social&label=Follow)](https://twitter.com/intent/follow?screen_name=riclep)

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/M4M2C42W6)

A packaging to use the power of [PHP-Typography](https://github.com/mundschenk-at/php-typography) to make your content sing and look the best it can.

<a name="installation">
## Installation
</a>

Install the package using Composer

```bash
composer require riclep/laravel-storyblok-typography
```

<a name="applying-typography">
## Applying typography
</a>

To use the typographic features your Block must use the `AppliesTypography` trait. This exposes a couple of new properties and methods. Add an `$applyTypography` property to your class with an array of the fields. This will run PHP-Typography over all the chosen fields using some sensible defaults.

```php
<?php

namespace App\Storyblok\Blocks;

use Riclep\Storyblok\Block;
use Riclep\StoryblokTypography\Traits\AppliesTypography;

class TypoCat extends Block
{
    use AppliesTypography;

    // the fields to apply typographic fixes to
	private $applyTypography = ['cats_name', 'biography'];
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
use Riclep\StoryblokTypography\Traits\AppliesTypography;
use PHP_Typography\Settings as TypographySettings;

class TypoKitten extends Block
{
    use AppliesTypography;

	private $applyTypography = ['cats_name', 'biography'];

    // called after fields have been processed but before the trait is initialised
	public function fieldsProcessed() {
        $settings = new TypographySettings();
        $settings->set_classes_to_ignore('.whiskers');
        $settings->set_hyphenation(true);
        $settings->set_smart_quotes(false);

        $this->setTypographySettings($settings);
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