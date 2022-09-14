# Artisan Commands

---

- [Importing and exporting stories](#import-export)




The package comes with several helpful Artisan commands for creating blocks and managing stories.


<a name="import-export">
## Importing and exporting stories
</a>

**Since 2.12.6**

You can save the JSON representation of your story with the export command. The resulting JSON will be placed in your storage folder.

```
php artisan ls:export slug/of/story
```


To import a Story’s JSON from your storage folder use the import command passing the filename and the slug you want to use. It will be placed in the root of your Space with (Imported) suffixed to the title. You are then free to move and edit it as required.

```
php artisan ls:import name-of-file.json the-slug
```