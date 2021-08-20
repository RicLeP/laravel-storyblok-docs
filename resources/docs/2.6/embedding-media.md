# Embedding Media

---

We take advantage of the fantastic [Embed package by Óscar Otero](https://github.com/oscarotero/Embed/tree/v3.x) to embed nearly anything in your website - YouTube videos, Tweets, Google Maps etc. The trait implements a `__toString()` method returning the embed code.

To make a [Field](/{{route}}/{{version}}/fields) embeddable simply add the `EmbedsMedia trait`. Your field’s `content` will need to return a URL.

```php
<?php

namespace App\Storyblok\Fields;

use Riclep\Storyblok\Traits\EmbedsMedia;

class Embed extends \Riclep\Storyblok\Field
{
	use EmbedsMedia;
}
```

> {info} We currently use version 3 of Embed due to it’s wider PHP version support.

Each ‘embedding’ can have a custom view defined for it matching the provider’s name in lowercase. For YouTube create a Blade in `resources/views/storyblok/embeds` called `youtube.blade.php`. The complete Embed object is passed to the view, [see their docs for the available properties](https://github.com/oscarotero/Embed/tree/v3.x) you can use.

The Trait adds a few additional methods to the field:

```php
<?php

// returns the embedded HTML using the custom view if created - this is the same as the default __toString() method
$field->html();

// returns raw embed code from Embed
$field->rawEmbed();

// returns the Embed object
$field->embed();

```

If you want to define custom logic to find the Blade view implement a `embedView()` method on your field returning the path to the file. It’s best to check it exists and returning the base package views if not. You may also wish to check the providerName.

```php
protected function embedView() {
    if (view()->exists('embeds.video') && strtolower($this->_embed->providerName) === 'youtube') {
        return 'embeds.video';
    }

    return $this->baseEmbedView();
}
```

> {info} The package does not include any CSS for styling the embedded media. Some provides may include this in their embed code, or the package templates may include common styling hooks you can use.