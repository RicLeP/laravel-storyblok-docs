# Exception handling

---

There will be times when the Pages you request from Storyblok are not available. When this happens a `Storyblok\ApiException` is returned but you’ll probably want to show your visitors a 404 error page. This is easily done by editing the `render()` method found in the `app\Exceptions\Handler.php` class.

Here is a simple example that covers most use cases, first we check if debug mode is enabled - if it is we return the raw exception developers love. Next we check if a Storyblok exception is thrown and that the status code is 404 returning the 404 view. Finally, we return a generic error page that displays the error code and message setting the status code to 500 to ensure the browser renders it to the visitor.

```php
public function render($request, Exception $exception)
    {
		if (config('app.debug')) {
			return parent::render($request, $exception);
		}

		if ($exception instanceof Storyblok\ApiException && $exception->getCode() === 404) {
			return response()->view('errors.404', [], $exception->getCode());
		}

        return response()->view('errors.generic', [
        	'code' => $exception->getCode(),
        	'message' => $exception->getMessage(),
		], 500);
    }
```