# Laravel Storyblok Command Line Interface (CLI)

---

- [Exporting & importing stories](#export-import-stories)
- [Exporting & importing components](#export-import-components)


[![Latest Version on Packagist](https://img.shields.io/packagist/v/riclep/laravel-storyblok-cli.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok-cli)
[![Total Downloads](https://img.shields.io/packagist/dt/riclep/laravel-storyblok-cli.svg?style=flat-square)](https://packagist.org/packages/riclep/laravel-storyblok-cli)
[![Twitter](https://img.shields.io/twitter/follow/riclep.svg?style=social&label=Follow)](https://twitter.com/intent/follow?screen_name=riclep)

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/M4M2C42W6)

Artisan commands for working with the Storyblok API in Laravel.

> {info} Since version 2.15.0 of Laravel Storyblok Artisan commands for working with the API are separate package. Any commands for generating classes for Laravel Storyblok are still part of that package.


## Installation

You can install the package via composer:

```bash
composer require riclep/laravel-storyblok-cli
```

<a name="export-import-stories">
## Exporting and importing stories
</a>

You can save the JSON representation of your story with the export command. The resulting JSON will be placed in your storage folder.

```bash
php artisan ls:export-story slug/of/story
```


To import a Story’s JSON from your storage folder use the import command passing the filename and the slug you want to use. It will be placed in the root of your Space with (Imported) suffixed to the title. You are then free to move and edit it as required.

```bash
php artisan ls:import-story name-of-file.json the-new-slug
```


<a name="export-import-components">
## Exporting and importing components
</a>

### Listing components

You can view a list of all the components in the space with this command.

```bash
php artisan ls:component-list

php artisan ls:component-list --additional-fields=id,created_at
```

### Exporting components

To export the JSON schema of a component use the `export-component` command. You will be asked to select the component to export. All exports are saved as JSON files in your storage folder.

```bash
php artisan ls:export-component
```

If you know the component’s name you can pass it as an argument.

```bash
php artisan ls:export-component name-of-component
```

To export all components pass the `--all` option.

```bash
php artisan ls:export-component --all
```


### Importing components

To import a component’s JSON from your storage folder use the `import-component` command passing the filename and the slug you want to use. You are then free to move and edit it as required.

```bash
php artisan ls:import-component name-of-file.json
```

If you want to import the component with a new name pass the `--as` option.

```bash
php artisan ls:import-component name-of-file.json --as=new-name
```

If you want to import the component into a group pass the `--group` option, leave it blank to choose from a list or pass group ID or UUID.

```bash
php artisan ls:import-component name-of-file.json --group

php artisan ls:import-component name-of-file.json --group=12345

php artisan ls:import-component name-of-file.json --group=8c8b1a9c-2ffa-46e8-9146-50dcc193f11e
```

