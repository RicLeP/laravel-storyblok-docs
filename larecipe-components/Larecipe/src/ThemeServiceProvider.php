<?php

namespace Riclep\Larecipe;

use BinaryTorch\LaRecipe\LaRecipe;
use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        LaRecipe::style('laravel-storyblok', __DIR__.'/../resources/css/theme.css');
		LaRecipe::style('larecipe', 'https://cdn.jsdelivr.net/npm/@docsearch/css@alpha');
	    LaRecipe::script('laravel-storyblok', 'https://cdn.jsdelivr.net/npm/@docsearch/js@alpha');
	    LaRecipe::script('larecipe', asset('js/algolia.js?v=2'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
