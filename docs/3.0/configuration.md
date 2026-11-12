---
title: Configuration
description: 'Overview of configuration options and settings available for Laravel Storyblok.'
---

# Configuration

---

Publishing the configuration file copies `config/storyblok.php` to your application:

```bash
php artisan vendor:publish --tag=storyblok
```

Below is a detailed reference of all available configuration options and their corresponding environment variables.

## API & Authentication {#api-authentication}

### `api_preview_key`
The Storyblok Preview API key used to communicate with the Storyblok Content Delivery API. Allows access to draft content and is used within the visual editor.

- **Environment variable:** `STORYBLOK_PREVIEW_API_KEY`
- **Default:** `''`

### `api_public_key`
The Storyblok Public API key used for published content in production.

- **Environment variable:** `STORYBLOK_PUBLIC_API_KEY`
- **Default:** `''`

### `api_region`
The Storyblok API region if your space is hosted in the US, EU, or China. Can be `null` (default EU), `'us'`, or `'cn'`.

- **Default:** `null`

### `delivery_api_base_url`
Base URL for the Content Delivery API.

- **Default:** `'api.storyblok.com'`

### `management_api_base_url`
Base URL for the Management API used by CLI and generator commands.

- **Default:** `'mapi.storyblok.com'`

### `use_ssl`
Specifies whether all API calls should use SSL (HTTPS).

- **Default:** `true`

### `draft`
Whether to request draft content outside of the visual editor (useful in local and staging environments).

- **Environment variable:** `STORYBLOK_DRAFT`
- **Default:** `false`

### `space_id` & `oauth_token`
Your Storyblok Space ID and personal OAuth token, used for Artisan generator commands and CLI tools.

- **Environment variables:** `STORYBLOK_SPACE_ID`, `STORYBLOK_OAUTH_TOKEN`
- **Default:** `null`

---

## Caching {#caching}

### `cache`
Enables or disables caching of API responses.

- **Environment variable:** `STORYBLOK_CACHE`
- **Default:** `true`

### `cache_duration`
The cache duration in minutes when using Laravel's cache.

- **Environment variable:** `STORYBLOK_DURATION`
- **Default:** `60`

### `sb_cache_driver` & `sb_cache_lifetime`
Custom cache driver and lifetime (in seconds) used by the official Storyblok API client.

- **Environment variables:** `STORYBLOK_SB_CACHE_DRIVER`, `STORYBLOK_SB_CACHE_LIFETIME`
- **Default:** `'file'`, `3600`

---

## Namespaces & Views {#namespaces-views}

### `component_class_namespace`
An array of PHP namespaces where the package searches for Block and Page classes matching Storyblok component names.

```php
'component_class_namespace' => [
    'App\Storyblok\\',
],
```

### `view_path`
The base Blade view path prefix used when resolving Block and Page views.

- **Default:** `'storyblok.'` (e.g. `resources/views/storyblok/pages/`)

---

## Webhooks & Assets {#webhooks-assets}

### `webhook_secret`
Secret token verified when handling Storyblok publish/unpublish webhooks.

- **Environment variable:** `STORYBLOK_WEBHOOK_SECRET`
- **Default:** `null`

### `asset_domain` & `image_service_domain`
Custom domains if you use Storyblok custom asset domains.

- **Environment variables:** `STORYBLOK_ASSET_DOMAIN`, `STORYBLOK_IMAGE_SERVICE_DOMAIN`
- **Default:** `'a.storyblok.com'`

### `image_transformer`
Class used to transform images. Defaults to the official Storyblok image service transformer.

- **Default:** `\Riclep\Storyblok\Support\ImageTransformers\Storyblok::class`

### `image_extensions`
List of file extensions automatically cast to `Image` fields instead of generic `Asset` fields.

- **Default:** `['.jpg', '.jpeg', '.png', '.gif', '.webp', '.jfif', '.heic', '.avif']`

---

## Visual Editor & Live Preview {#visual-editor-live-preview}

### `live_preview`
Enables live preview of content changes in the visual editor without full page reloads.

- **Default:** `true`

### `live_element`
CSS selector of the container element replaced during live editing.

- **Default:** `'.storyblok-live'`

### `resolve_links`
Global setting for link resolution in rich text fields.

- **Default:** `false`

---

## Routing & Denylist {#routing-denylist}

### `denylist`
An array of exact URL strings or regular expressions (wrapped in `/.../`) that should not be handled by Storyblok's catch-all controller.

```php
'denylist' => [
    '/^\.well-known\/.*$/',
    '/^admin\/.*$/',
    '/\.(php|sql|exe)$/',
],
```
