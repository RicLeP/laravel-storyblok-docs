<?php

// Written by php artisan larecipe:upgrade from your LaRecipe 2 config.
// Content and presentation (versions, theme, navigation) now live next to the
// docs in larecipe.json and navigation.json. The full reference for this file
// is the package's own config/larecipe.php.

return [

    'default' => 'docs',

    'sets' => [
        'docs' => [
            'route' => [
                'prefix' => 'docs',
                'domain' => null,
                'middleware' => ['web'],
            ],
            'source' => [
                'driver' => 'repository',
                'path' => base_path('docs'),
            ],
            'access' => [
                'mode' => 'public',
            ],
        ],
    ],

];
