# Laravel Storyblok Forms

---

- [Installation](#installation)
- [Building forms](#building-forms)

<a name="installation">
## Installation
</a>

Install using Composer

`composer require riclep/laravel-storyblok-forms`

Publish the package assets selecting Laravel Storyblok Forms - this will copy stub views for each form component

`php artisan vendor:publish`

Install the Storyblok Components - this will create the required components and component groups in Storyblok. Ensure you have your management key and space ID set up in the `.env`, see [Laravel Storyblok installation docs](https://github.com/RicLeP/laravel-storyblok) installation for details.

`php artisan lsf:install`

<a name="building-forms">
## Building forms
</a>

Each form should be created as a new page in Storyblok using the Form (lsf-form) content type created in the installation step.

Once created attach a form to a page using a Single Option field with a source Stories.

In the `Block` containing your form remember to resolve the relation as you would do for any Laravel Storyblok relationship.

```php
namespace App\Storyblok;

use Riclep\Storyblok\Block;

class SomeBlock extends Block
{
	public $_resolveRelations = ['form']; // the field holding your form
}
```

To render a form do the following in your Blade view. This will use the stubbed fields installed earlier. Feel free to customise them as required.

```blade
{{ $story->form->render() }}
```

By default the form will post to the same URL as the form’s page in Storyblok. Add a `post` route in your `web.php` file. You can customise the form’s action by editing `lsf-form.blade.php`.

```php
Route::post('/forms/my-form', [FormController::class, 'store']);
```

Create your controller to handle the form submission.

Pass the `$request` to a `Riclep\StoryblokForms\FormResponse` instance. To validate using your rules added in Storyblok call `validate()`, this will either pass and continue or fail and redirect the user back with errors and old input like regular Laravel validation. To access the user’s input call `response()`, this gives you a nested array containing the full user input for all fields. Checkboxes and radio buttons contain any array of every option and a `selected` boolean of their status making it super easy to build emails or store in the database!

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Riclep\StoryblokForms\FormResponse;

class FormController extends Controller
{
    public function store(Request $request) {
		$formResponse = new FormResponse($request);
	    $formResponse->validate();
	    $response = $formResponse->response();
	}
}
```