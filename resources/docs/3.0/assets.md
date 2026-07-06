# Assets

---

- [Custom asset domains](#custom-domains)

Assets are a special type of Field with additional functionality. Where possible to try to detect the type of file upload and return an appropriate Field. `Image` classes are returned when the file has one of the following extensions: ‘.jpg’, ‘.jpeg’, ‘.png’, ‘.gif’, ‘.webp’. See the [Image documentation](/{{route}}/{{version}}/images) for more.


## Checking for a file

To check if a file has been uploaded in Storyblok call `hasFile()` on the Asset.

```php
$myAsset->hasFile();
```

> {info} When using multi-asset fields we only receive a URL from Storyblok the Asset|Image fields are less complete.


<a name="custom-domains">
## Custom asset domains
</a>

Storyblok allows you to serve assets from their platform using a custom domain. You will need to define two configuration values in your `storyblok` config file:

```php
[
    // rest of configuration
    `asset_domain` => 'custom.asset.domain',
    `image_service_domain` => 'custom.imageservice.domain'
]
```

The configuration to customise both domains is needed because:

- Storyblok links a CloudFront distribution directly to the S3 bucket, bypassing the image service.
- Non-image assets cannot pass through the image service, so you cannot pass all asset requests through img2.storyblok.com

> {info} [See Storyblok’s documentation on setting up the custom asset domains](https://www.storyblok.com/docs/custom-assets-domain).

Thank you to [Brent Mullen](https://github.com/brentmullen) for this feature!