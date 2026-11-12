---
title: 'Exception handling'
description: 'How to handle API exceptions and display custom error pages for Storyblok content in Laravel 11, 12, and 13.'
---

# Exception handling

---

When requesting stories or content from Storyblok, pages may occasionally be missing, unpublished, or blocked by a denylist. When this happens, exceptions such as `DenylistedUrlException` or Symfony HTTP client exceptions are thrown. To deliver the best user experience and keep error tracking clean, you should catch these exceptions and return custom error pages (such as a 404 view) while preventing error logging services from reporting routine missing pages.

In **Laravel 11, 12, and 13**, all exception handling configuration is defined in `bootstrap/app.php` using the `withExceptions()` closure.

## Configuring `bootstrap/app.php` {#configuring-bootstrap}

You can configure exception reporting and rendering in `bootstrap/app.php` as shown below:

```php
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Riclep\Storyblok\Exceptions\DenylistedUrlException;
use Symfony\Component\HttpClient\Exception\ClientException;
use Throwable;

return Application::configure(basePath: dirname(__DIR__))
    ...
    ->withExceptions(function (Exceptions $exceptions): void {
        if (app()->isProduction()) {
            $exceptions->render(function (DenylistedUrlException $exception) use ($renderError) {
                // Render 404 for denylisted URLs
            });

            $exceptions->render(function (ClientException $exception) use ($renderError) {
                // Render 404 when Storyblok API client returns 404 client exceptions
            });
        }
    })->create();
```

## Ignoring Expected Errors {#ignoring-expected-errors}

When visitors or web crawlers attempt to access non-existent Storyblok pages or blocked URLs, Storyblok throws a `ClientException` or a `DenylistedUrlException`. Adding these classes to `$exceptions->dontReport([...])` ensures that external error tracking services (such as Sentry, Bugsnag, or Flare) are not inundated with non-critical 404 events, keeping issue logs actionable.

## Development vs Production {#development-vs-production}

Wrapping custom error view renderers inside `if (app()->isProduction()) { ... }` allows local development and staging environments with `APP_DEBUG=true` to display rich interactive error pages (like Laravel Ignition), making debugging API issues and missing components straightforward.

> [!NOTE]
> If you use Sentry for error tracking, you can register `\Sentry\Laravel\Integration::handles($exceptions);` inside the `$exceptions` configuration closure.
