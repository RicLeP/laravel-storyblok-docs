# Upgrading

---

## 1.0.0 -> 1.1.0

Create a new `DefaultAsset` class in `App\Storyblok` as follows:

### Asset field types

```php
<?php

namespace App\Storyblok;

use Riclep\Storyblok\Asset;
use Riclep\Storyblok\Traits\CssClasses;

class DefaultAsset extends Asset
{
	use CssClasses;
}
```

### Renamed $meta on Blocks

If you are accessing the $meta property on Blocks or in views then update to use $_meta.