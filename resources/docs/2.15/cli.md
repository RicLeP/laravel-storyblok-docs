# Command Line Interface (CLI)

---

- [Exporting & importing stories](#export-import-stories)
- [Exporting & importing components](#export-import-components)


Artisan commands for working with the Storyblok API in Laravel.

> {info} Since version 2.15.0 of Laravel Storyblok Artisan commands for working with the API are separate package. Any commands for generating classes for Laravel Storyblok are still part of that package.


## Installation

You can install the package via composer:

```
composer require riclep/laravel-storyblok-cli
```

<a name="export-import-stories">
## Exporting and importing stories
</a>

You can save the JSON representation of your story with the export command. The resulting JSON will be placed in your storage folder.

```
php artisan ls:export-story slug/of/story
```


To import a Story’s JSON from your storage folder use the import command passing the filename and the slug you want to use. It will be placed in the root of your Space with (Imported) suffixed to the title. You are then free to move and edit it as required.

```
php artisan ls:import-story name-of-file.json the-new-slug
```


<a name="export-import-components">
## Exporting and importing components
</a>

### Listing components

You can view a list of all the components in the space with this command.

```
php artisan ls:component-list

php artisan ls:component-list --additional-fields=id,created_at
```

### Exporting components

To export the JSON schema of a component use the `export-component` command. You will be asked to select the component to export. All exports are saved as JSON files in your storage folder.

```
php artisan ls:export-component
```

If you know the component’s name you can pass it as an argument.

```
php artisan ls:export-component name-of-component
```

To export all components pass the `--all` option.

```
php artisan ls:export-component --all
```


### Importing components

To import a component’s JSON from your storage folder use the `import-component` command passing the filename and the slug you want to use. You are then free to move and edit it as required.

```
php artisan ls:import-component name-of-file.json
```

If you want to import the component with a new name pass the `--as` option.

```
php artisan ls:import-component name-of-file.json --as=new-name
```

