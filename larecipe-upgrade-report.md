# LaRecipe upgrade report

Written by `php artisan larecipe:upgrade` on 2026-11-12. These changes were applied. Review the diff before you commit it.

## Summary

| | |
| --- | --- |
| Versions | 3.0, 2.0, 1.0 |
| Docs folder | `resources/docs/` moves to `docs/` |
| Pages converted | 64 |
| Files written | 69 |
| Files removed | 67 |
| Left for you | 204 |
| Validation | 5 errors, 177 warnings |

## 1. Composer and code

Run these, in order:

```bash
composer remove binarytorch/larecipe
```

- The namespace is now `LaRecipe\` (it was `BinaryTorch\LaRecipe\`).
- The `viewLarecipe` gate now receives the page and the set key: `fn ($user, $page = null, $set = null)`, where `$page` has `ref->path`, `ref->version`, `title` and `private`.
- Publish the new config only if you want the full reference: `php artisan vendor:publish --tag=larecipe-config` (this upgrade already wrote a working `config/larecipe.php`).

## 2. Left for you

The `larecipe-upgrade-v2` skill reads `larecipe-upgrade-report.json` and works through this list with you.

- [ ] `docs/3.0/assets.md:23`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/basic-usage.md:25`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/basic-usage.md:37`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/basic-usage.md:57`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/basic-usage.md:99`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:38`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:115`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:142`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:156`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:232`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:260`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:280`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:335`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/blocks.md:358`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/cli.md:30`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/cli.md:48`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/css-classes.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/css-classes.md:28`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/embedding-media.md:85`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/embedding-media.md:96`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:21`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:50`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:104`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:174`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:270`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:291`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:297`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/fields.md:323`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:122`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:146`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:162`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:177`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:192`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:237`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/folders.md:290`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/images.md:26`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/images.md:143`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/images.md:246`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/images.md:302`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/installation.md:12`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/installation.md:24`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/installation.md:112`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/installation.md:152`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/laravel-storyblok-forms.md:23`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/laravel-storyblok-forms.md:45`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/linking-the-visual-editor.md:12`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/linking-the-visual-editor.md:58`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/overview.md:5`: Raw HTML is shown as text in v3: - Hello, if you find any problems let me know - <a href="mailto:ric@uandus.co.uk?subject=Laravel Storyblok">ric@uandus.co.uk</a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/overview.md:46`: Raw HTML is shown as text in v3: If you discover any security related issues, please email <a href="mailto:ric@uandus.co.uk?subject=Laravel Storyblok">ric@uandus.co.uk</a> instead of using the issue tracker. Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/pages.md:34`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/pages.md:44`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/pages.md:53`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/pages.md:65`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/pages.md:99`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/requesting-pages.md:34`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/requesting-pages.md:87`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/requesting-pages.md:179`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/troubleshooting.md:10`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/troubleshooting.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/typography.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/typography.md:28`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/typography.md:53`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/views.md:72`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/views.md:98`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:36`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:43`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:53`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:61`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:78`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:86`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:93`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:99`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:111`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:120`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:131`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:140`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:148`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:155`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:163`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:172`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:179`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:187`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:194`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:203`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:210`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:218`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:228`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/3.0/whats-new.md:238`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/assets.md:23`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/basic-usage.md:25`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/basic-usage.md:37`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/basic-usage.md:57`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/basic-usage.md:99`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:38`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:115`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:142`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:156`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:232`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:260`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:280`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:335`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/blocks.md:358`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/cli.md:30`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/cli.md:48`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/css-classes.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/css-classes.md:28`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/embedding-media.md:85`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/embedding-media.md:96`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:21`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:50`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:104`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:174`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:270`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:291`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:297`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/fields.md:323`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/folders.md:84`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/folders.md:133`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/folders.md:192`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/images.md:26`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/images.md:143`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/images.md:246`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/images.md:302`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/installation.md:12`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/installation.md:24`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/installation.md:112`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/installation.md:152`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/laravel-storyblok-forms.md:23`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/laravel-storyblok-forms.md:45`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/linking-the-visual-editor.md:12`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/linking-the-visual-editor.md:58`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/overview.md:5`: Raw HTML is shown as text in v3: - Hello, if you find any problems let me know - <a href="mailto:ric@uandus.co.uk?subject=Laravel Storyblok">ric@uandus.co.uk</a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/overview.md:44`: Raw HTML is shown as text in v3: If you discover any security related issues, please email <a href="mailto:ric@uandus.co.uk?subject=Laravel Storyblok">ric@uandus.co.uk</a> instead of using the issue tracker. Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/pages.md:34`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/pages.md:44`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/pages.md:53`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/pages.md:65`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/pages.md:99`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/requesting-pages.md:34`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/requesting-pages.md:87`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/requesting-pages.md:179`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/troubleshooting.md:10`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/troubleshooting.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/typography.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/typography.md:28`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/typography.md:53`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/views.md:72`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/views.md:98`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:36`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:43`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:53`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:61`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:78`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:86`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:93`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:99`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:111`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:120`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:131`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:140`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:148`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:155`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:163`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:172`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:179`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:187`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:194`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:203`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:210`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:218`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:228`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/2.0/whats-new.md:238`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/basic-usage.md:22`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/basic-usage.md:51`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/basic-usage.md:204`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:31`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:45`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:57`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:70`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:85`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:98`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/blocks.md:211`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/folders.md:49`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/folders.md:105`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/installation.md:12`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/installation.md:24`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/installation.md:48`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/installation.md:60`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/overview.md:5`: Raw HTML is shown as text in v3: - Hello, if you find any problems let me know - <a href="mailto:ric@sirric.co.uk?subject=Laravel Storyblok">ric@sirric.co.uk</a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/overview.md:46`: Raw HTML is shown as text in v3: If you discover any security related issues, please email <a href="mailto:ric@sirric.co.uk?subject=Laravel Storyblok">ric@sirric.co.uk</a> instead of using the issue tracker. Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/pages.md:32`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/pages.md:51`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/pages.md:58`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/pages.md:68`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/troubleshooting.md:10`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/troubleshooting.md:18`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/typography.md:12`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/typography.md:40`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/views.md:71`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `docs/1.0/views.md:97`: Raw HTML is shown as text in v3: </a> Use Markdown or a component instead, leave it as text, or set html_input to allow for this repository set in config/larecipe.php.
- [ ] `resources/views/vendor/larecipe/partials/404.blade.php`: Published v2 views are not used by v3. Replace it with a slot override (NotFound, Logo, Header, Sidebar) or LaRecipe::head(), then delete the folder.
- [ ] `resources/views/vendor/larecipe/partials/logo.blade.php`: Published v2 views are not used by v3. Replace it with a slot override (NotFound, Logo, Header, Sidebar) or LaRecipe::head(), then delete the folder.
- [ ] `resources/views/vendor/larecipe/partials/nav.blade.php`: Published v2 views are not used by v3. Replace it with a slot override (NotFound, Logo, Header, Sidebar) or LaRecipe::head(), then delete the folder.
- [ ] `resources/views/vendor/larecipe/partials/sidebar.blade.php`: Published v2 views are not used by v3. Replace it with a slot override (NotFound, Logo, Header, Sidebar) or LaRecipe::head(), then delete the folder.

## 3. Files

| Change | File | Why |
| --- | --- | --- |
| write | `docs/3.0/assets.md` | converted to v3 Markdown |
| write | `docs/3.0/basic-usage.md` | converted to v3 Markdown |
| write | `docs/3.0/blocks.md` | converted to v3 Markdown |
| write | `docs/3.0/cli.md` | converted to v3 Markdown |
| write | `docs/3.0/configuration.md` | converted to v3 Markdown |
| write | `docs/3.0/css-classes.md` | converted to v3 Markdown |
| write | `docs/3.0/data-structure.md` | converted to v3 Markdown |
| write | `docs/3.0/embedding-media.md` | converted to v3 Markdown |
| write | `docs/3.0/exception-handling.md` | converted to v3 Markdown |
| write | `docs/3.0/fields.md` | converted to v3 Markdown |
| write | `docs/3.0/folders.md` | converted to v3 Markdown |
| write | `docs/3.0/images.md` | converted to v3 Markdown |
| write | `docs/3.0/installation.md` | converted to v3 Markdown |
| write | `docs/3.0/laravel-storyblok-forms.md` | converted to v3 Markdown |
| write | `docs/3.0/linking-the-visual-editor.md` | converted to v3 Markdown |
| write | `docs/3.0/overview.md` | converted to v3 Markdown |
| write | `docs/3.0/pages.md` | converted to v3 Markdown |
| write | `docs/3.0/requesting-pages.md` | converted to v3 Markdown |
| write | `docs/3.0/templates.md` | converted to v3 Markdown |
| write | `docs/3.0/traits.md` | converted to v3 Markdown |
| write | `docs/3.0/troubleshooting.md` | converted to v3 Markdown |
| write | `docs/3.0/typography.md` | converted to v3 Markdown |
| write | `docs/3.0/upgrading.md` | converted to v3 Markdown |
| write | `docs/3.0/views.md` | converted to v3 Markdown |
| write | `docs/3.0/whats-new.md` | converted to v3 Markdown |
| write | `docs/3.0/navigation.json` | the v2 sidebar as navigation.json |
| delete | `resources/docs/3.0/index.md` | the sidebar now lives in navigation.json |
| write | `docs/2.0/assets.md` | converted to v3 Markdown |
| write | `docs/2.0/basic-usage.md` | converted to v3 Markdown |
| write | `docs/2.0/blocks.md` | converted to v3 Markdown |
| write | `docs/2.0/cli.md` | converted to v3 Markdown |
| write | `docs/2.0/configuration.md` | converted to v3 Markdown |
| write | `docs/2.0/css-classes.md` | converted to v3 Markdown |
| write | `docs/2.0/data-structure.md` | converted to v3 Markdown |
| write | `docs/2.0/embedding-media.md` | converted to v3 Markdown |
| write | `docs/2.0/exception-handling.md` | converted to v3 Markdown |
| write | `docs/2.0/fields.md` | converted to v3 Markdown |
| write | `docs/2.0/folders.md` | converted to v3 Markdown |
| write | `docs/2.0/images.md` | converted to v3 Markdown |
| write | `docs/2.0/installation.md` | converted to v3 Markdown |
| write | `docs/2.0/laravel-storyblok-forms.md` | converted to v3 Markdown |
| write | `docs/2.0/linking-the-visual-editor.md` | converted to v3 Markdown |
| write | `docs/2.0/overview.md` | converted to v3 Markdown |
| write | `docs/2.0/pages.md` | converted to v3 Markdown |
| write | `docs/2.0/requesting-pages.md` | converted to v3 Markdown |
| write | `docs/2.0/templates.md` | converted to v3 Markdown |
| write | `docs/2.0/traits.md` | converted to v3 Markdown |
| write | `docs/2.0/troubleshooting.md` | converted to v3 Markdown |
| write | `docs/2.0/typography.md` | converted to v3 Markdown |
| write | `docs/2.0/upgrading.md` | converted to v3 Markdown |
| write | `docs/2.0/views.md` | converted to v3 Markdown |
| write | `docs/2.0/whats-new.md` | converted to v3 Markdown |
| write | `docs/2.0/navigation.json` | the v2 sidebar as navigation.json |
| delete | `resources/docs/2.0/index.md` | the sidebar now lives in navigation.json |
| write | `docs/1.0/basic-usage.md` | converted to v3 Markdown |
| write | `docs/1.0/blocks.md` | converted to v3 Markdown |
| write | `docs/1.0/configuration.md` | converted to v3 Markdown |
| write | `docs/1.0/exception-handling.md` | converted to v3 Markdown |
| write | `docs/1.0/folders.md` | converted to v3 Markdown |
| write | `docs/1.0/images.md` | converted to v3 Markdown |
| write | `docs/1.0/installation.md` | converted to v3 Markdown |
| write | `docs/1.0/overview.md` | converted to v3 Markdown |
| write | `docs/1.0/pages.md` | converted to v3 Markdown |
| write | `docs/1.0/requesting-pages.md` | converted to v3 Markdown |
| write | `docs/1.0/templates.md` | converted to v3 Markdown |
| write | `docs/1.0/troubleshooting.md` | converted to v3 Markdown |
| write | `docs/1.0/typography.md` | converted to v3 Markdown |
| write | `docs/1.0/views.md` | converted to v3 Markdown |
| write | `docs/1.0/navigation.json` | the v2 sidebar as navigation.json |
| delete | `resources/docs/1.0/index.md` | the sidebar now lives in navigation.json |
| delete | `resources/docs/3.0/assets.md` | moved to docs/ |
| delete | `resources/docs/3.0/basic-usage.md` | moved to docs/ |
| delete | `resources/docs/3.0/blocks.md` | moved to docs/ |
| delete | `resources/docs/3.0/cli.md` | moved to docs/ |
| delete | `resources/docs/3.0/configuration.md` | moved to docs/ |
| delete | `resources/docs/3.0/css-classes.md` | moved to docs/ |
| delete | `resources/docs/3.0/data-structure.md` | moved to docs/ |
| delete | `resources/docs/3.0/embedding-media.md` | moved to docs/ |
| delete | `resources/docs/3.0/exception-handling.md` | moved to docs/ |
| delete | `resources/docs/3.0/fields.md` | moved to docs/ |
| delete | `resources/docs/3.0/folders.md` | moved to docs/ |
| delete | `resources/docs/3.0/images.md` | moved to docs/ |
| delete | `resources/docs/3.0/installation.md` | moved to docs/ |
| delete | `resources/docs/3.0/laravel-storyblok-forms.md` | moved to docs/ |
| delete | `resources/docs/3.0/linking-the-visual-editor.md` | moved to docs/ |
| delete | `resources/docs/3.0/overview.md` | moved to docs/ |
| delete | `resources/docs/3.0/pages.md` | moved to docs/ |
| delete | `resources/docs/3.0/requesting-pages.md` | moved to docs/ |
| delete | `resources/docs/3.0/templates.md` | moved to docs/ |
| delete | `resources/docs/3.0/traits.md` | moved to docs/ |
| delete | `resources/docs/3.0/troubleshooting.md` | moved to docs/ |
| delete | `resources/docs/3.0/typography.md` | moved to docs/ |
| delete | `resources/docs/3.0/upgrading.md` | moved to docs/ |
| delete | `resources/docs/3.0/views.md` | moved to docs/ |
| delete | `resources/docs/3.0/whats-new.md` | moved to docs/ |
| delete | `resources/docs/2.0/assets.md` | moved to docs/ |
| delete | `resources/docs/2.0/basic-usage.md` | moved to docs/ |
| delete | `resources/docs/2.0/blocks.md` | moved to docs/ |
| delete | `resources/docs/2.0/cli.md` | moved to docs/ |
| delete | `resources/docs/2.0/configuration.md` | moved to docs/ |
| delete | `resources/docs/2.0/css-classes.md` | moved to docs/ |
| delete | `resources/docs/2.0/data-structure.md` | moved to docs/ |
| delete | `resources/docs/2.0/embedding-media.md` | moved to docs/ |
| delete | `resources/docs/2.0/exception-handling.md` | moved to docs/ |
| delete | `resources/docs/2.0/fields.md` | moved to docs/ |
| delete | `resources/docs/2.0/folders.md` | moved to docs/ |
| delete | `resources/docs/2.0/images.md` | moved to docs/ |
| delete | `resources/docs/2.0/installation.md` | moved to docs/ |
| delete | `resources/docs/2.0/laravel-storyblok-forms.md` | moved to docs/ |
| delete | `resources/docs/2.0/linking-the-visual-editor.md` | moved to docs/ |
| delete | `resources/docs/2.0/overview.md` | moved to docs/ |
| delete | `resources/docs/2.0/pages.md` | moved to docs/ |
| delete | `resources/docs/2.0/requesting-pages.md` | moved to docs/ |
| delete | `resources/docs/2.0/templates.md` | moved to docs/ |
| delete | `resources/docs/2.0/traits.md` | moved to docs/ |
| delete | `resources/docs/2.0/troubleshooting.md` | moved to docs/ |
| delete | `resources/docs/2.0/typography.md` | moved to docs/ |
| delete | `resources/docs/2.0/upgrading.md` | moved to docs/ |
| delete | `resources/docs/2.0/views.md` | moved to docs/ |
| delete | `resources/docs/2.0/whats-new.md` | moved to docs/ |
| delete | `resources/docs/1.0/basic-usage.md` | moved to docs/ |
| delete | `resources/docs/1.0/blocks.md` | moved to docs/ |
| delete | `resources/docs/1.0/configuration.md` | moved to docs/ |
| delete | `resources/docs/1.0/exception-handling.md` | moved to docs/ |
| delete | `resources/docs/1.0/folders.md` | moved to docs/ |
| delete | `resources/docs/1.0/images.md` | moved to docs/ |
| delete | `resources/docs/1.0/installation.md` | moved to docs/ |
| delete | `resources/docs/1.0/overview.md` | moved to docs/ |
| delete | `resources/docs/1.0/pages.md` | moved to docs/ |
| delete | `resources/docs/1.0/requesting-pages.md` | moved to docs/ |
| delete | `resources/docs/1.0/templates.md` | moved to docs/ |
| delete | `resources/docs/1.0/troubleshooting.md` | moved to docs/ |
| delete | `resources/docs/1.0/typography.md` | moved to docs/ |
| delete | `resources/docs/1.0/views.md` | moved to docs/ |
| write | `docs/larecipe.json` | the set manifest |
| write | `config/larecipe.php` | the LaRecipe 3 config (the v2 file is kept as config/larecipe.v2.php.bak) |

## 4. What changed

- `config/larecipe.php`: The docs keep their route prefix (/docs) and middleware (web).
- `config/larecipe.php`: Access mode is "public".
- `docs/larecipe.json`: Versions (3.0, 2.0, 1.0), the landing page, the favicon, the primary color (as theme.accent) and the description moved to larecipe.json.
- `docs/larecipe.json`: Google Analytics (settings.ga_id) is now a GA4 integration in larecipe.json.
- `docs/3.0/assets.md`: 2 alerts became GitHub alerts, 1 anchor became a heading id, 1 link became a relative .md link.
- `docs/3.0/assets.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/basic-usage.md`: 2 alerts became GitHub alerts, 4 anchors became heading ids, 4 links became relative .md links.
- `docs/3.0/basic-usage.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/blocks.md`: 6 alerts became GitHub alerts, 9 anchors became heading ids, 4 links became relative .md links.
- `docs/3.0/blocks.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/cli.md`: 1 alert became a GitHub alert, 2 anchors became heading ids.
- `docs/3.0/cli.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/configuration.md`: 1 link became a relative .md link.
- `docs/3.0/css-classes.md`: 2 alerts became GitHub alerts, 2 anchors became heading ids, 2 links became relative .md links.
- `docs/3.0/css-classes.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/embedding-media.md`: 1 alert became a GitHub alert, 2 anchors became heading ids, 1 link became a relative .md link.
- `docs/3.0/embedding-media.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/fields.md`: 6 alerts became GitHub alerts, 8 anchors became heading ids, 5 links became relative .md links.
- `docs/3.0/fields.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/folders.md`: 1 alert became a GitHub alert, 7 anchors became heading ids.
- `docs/3.0/folders.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/images.md`: 6 alerts became GitHub alerts, 4 anchors became heading ids, 1 link became a relative .md link.
- `docs/3.0/installation.md`: 5 alerts became GitHub alerts, 4 anchors became heading ids, 2 links became relative .md links.
- `docs/3.0/installation.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/laravel-storyblok-forms.md`: 2 alerts became GitHub alerts, 2 anchors became heading ids.
- `docs/3.0/laravel-storyblok-forms.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/linking-the-visual-editor.md`: 3 alerts became GitHub alerts, 2 anchors became heading ids, 1 link became a relative .md link.
- `docs/3.0/linking-the-visual-editor.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/overview.md`: 8 links became relative .md links.
- `docs/3.0/pages.md`: 3 alerts became GitHub alerts, 5 anchors became heading ids, 1 link became a relative .md link.
- `docs/3.0/pages.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/requesting-pages.md`: 3 alerts became GitHub alerts, 3 anchors became heading ids, 2 links became relative .md links.
- `docs/3.0/requesting-pages.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/traits.md`: 1 alert became a GitHub alert, 1 link became a relative .md link.
- `docs/3.0/troubleshooting.md`: 2 anchors became heading ids.
- `docs/3.0/troubleshooting.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/typography.md`: 1 alert became a GitHub alert, 3 anchors became heading ids.
- `docs/3.0/typography.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/upgrading.md`: 4 links became relative .md links.
- `docs/3.0/views.md`: 1 alert became a GitHub alert, 2 anchors became heading ids.
- `docs/3.0/views.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/3.0/whats-new.md`: 24 anchors became heading ids, 9 links became relative .md links.
- `docs/3.0/whats-new.md:6`: Removed the hand-written table of contents. v3 builds one from the headings.
- `resources/docs/3.0/index.md`: The sidebar became navigation.json (22 entries).
- `docs/2.0/assets.md`: 2 alerts became GitHub alerts, 1 anchor became a heading id, 1 link became a relative .md link.
- `docs/2.0/assets.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/basic-usage.md`: 2 alerts became GitHub alerts, 4 anchors became heading ids, 4 links became relative .md links.
- `docs/2.0/basic-usage.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/blocks.md`: 6 alerts became GitHub alerts, 9 anchors became heading ids, 4 links became relative .md links.
- `docs/2.0/blocks.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/cli.md`: 1 alert became a GitHub alert, 2 anchors became heading ids.
- `docs/2.0/cli.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/configuration.md`: 1 link became a relative .md link.
- `docs/2.0/css-classes.md`: 2 alerts became GitHub alerts, 2 anchors became heading ids, 2 links became relative .md links.
- `docs/2.0/css-classes.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/embedding-media.md`: 1 alert became a GitHub alert, 2 anchors became heading ids, 1 link became a relative .md link.
- `docs/2.0/embedding-media.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/fields.md`: 6 alerts became GitHub alerts, 8 anchors became heading ids, 5 links became relative .md links.
- `docs/2.0/fields.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/folders.md`: 3 alerts became GitHub alerts, 3 anchors became heading ids.
- `docs/2.0/folders.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/images.md`: 6 alerts became GitHub alerts, 4 anchors became heading ids, 1 link became a relative .md link.
- `docs/2.0/installation.md`: 5 alerts became GitHub alerts, 4 anchors became heading ids, 2 links became relative .md links.
- `docs/2.0/installation.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/laravel-storyblok-forms.md`: 2 alerts became GitHub alerts, 2 anchors became heading ids.
- `docs/2.0/laravel-storyblok-forms.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/linking-the-visual-editor.md`: 3 alerts became GitHub alerts, 2 anchors became heading ids, 1 link became a relative .md link.
- `docs/2.0/linking-the-visual-editor.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/overview.md`: 8 links became relative .md links.
- `docs/2.0/pages.md`: 3 alerts became GitHub alerts, 5 anchors became heading ids, 1 link became a relative .md link.
- `docs/2.0/pages.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/requesting-pages.md`: 3 alerts became GitHub alerts, 3 anchors became heading ids, 2 links became relative .md links.
- `docs/2.0/requesting-pages.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/traits.md`: 1 alert became a GitHub alert, 1 link became a relative .md link.
- `docs/2.0/troubleshooting.md`: 2 anchors became heading ids.
- `docs/2.0/troubleshooting.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/typography.md`: 1 alert became a GitHub alert, 3 anchors became heading ids.
- `docs/2.0/typography.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/upgrading.md`: 4 links became relative .md links.
- `docs/2.0/views.md`: 1 alert became a GitHub alert, 2 anchors became heading ids.
- `docs/2.0/views.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/2.0/whats-new.md`: 24 anchors became heading ids, 9 links became relative .md links.
- `docs/2.0/whats-new.md:6`: Removed the hand-written table of contents. v3 builds one from the headings.
- `resources/docs/2.0/index.md`: The sidebar became navigation.json (22 entries).
- `docs/1.0/basic-usage.md`: 2 alerts became GitHub alerts, 3 anchors became heading ids, 3 links became relative .md links.
- `docs/1.0/basic-usage.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/blocks.md`: 3 alerts became GitHub alerts, 7 anchors became heading ids, 1 link became a relative .md link.
- `docs/1.0/blocks.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/configuration.md`: 1 link became a relative .md link.
- `docs/1.0/folders.md`: 2 anchors became heading ids.
- `docs/1.0/folders.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/installation.md`: 3 alerts became GitHub alerts, 4 anchors became heading ids, 1 link became a relative .md link.
- `docs/1.0/installation.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/overview.md`: 4 links became relative .md links.
- `docs/1.0/pages.md`: 3 alerts became GitHub alerts, 4 anchors became heading ids, 1 link became a relative .md link.
- `docs/1.0/pages.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/requesting-pages.md`: 1 link became a relative .md link.
- `docs/1.0/troubleshooting.md`: 2 anchors became heading ids.
- `docs/1.0/troubleshooting.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/typography.md`: 1 alert became a GitHub alert, 2 anchors became heading ids.
- `docs/1.0/typography.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `docs/1.0/views.md`: 2 anchors became heading ids.
- `docs/1.0/views.md:5`: Removed the hand-written table of contents. v3 builds one from the headings.
- `resources/docs/1.0/index.md`: The sidebar became navigation.json (12 entries).
- `docs`: The docs move from resources/docs/ to docs/.

## 5. Dropped on purpose

- `config/larecipe.php`: cache: rendered pages are always cached by content hash in v3. Run php artisan larecipe:optimize on deploy (it runs with php artisan optimize).
- `config/larecipe.php`: search.engines.algolia: Algolia DocSearch is gone. Search is built in and works offline. Remove the Algolia keys from your .env.
- `config/larecipe.php`: ui.code_theme: code blocks follow the page theme, light and dark.
- `config/larecipe.php`: ui.colors.secondary: v3 themes have one accent color. Fine-tune colors in a theme.css listed under assets.css in larecipe.json.
- `config/larecipe.php`: ui.fa_v4_shims: Font Awesome is gone; v3 uses one icon set (Lucide).
- `config/larecipe.php`: ui.theme_order: there are no stacked theme packages in v3.
- `config/larecipe.php`: ui.show_side_bar: the sidebar is part of every page. Set layout: wide or layout: full in a page's frontmatter for more room.
- `config/larecipe.php`: seo.author, seo.keywords, seo.og: pages describe themselves through frontmatter (title, description), canonical URLs and JSON-LD. Give every page a description in its frontmatter.
- `config/larecipe.php`: blade-parser: v3 does not pre-process HTML with regular expressions.

## 6. Validation

64 pages checked: 5 errors, 177 warnings.

| Level | Rule | Page | Message |
| --- | --- | --- | --- |
| warning | `frontmatter.description.missing` | `3.0/assets.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/assets.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/basic-usage.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/basic-usage.md` | Link to installation.md: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/basic-usage.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/basic-usage.md` | Link to views.md: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/basic-usage.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/blocks.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/blocks.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/blocks.md` | Link to views.md#creating-css-class-names: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/blocks.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/blocks.md` | Link to troubleshooting.md#live-preview-not-reloading: there is no page at "troubleshooting". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/cli.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/configuration.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/configuration.md` | Link to installation.md#configuration: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/css-classes.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/css-classes.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/css-classes.md` | Link to blocks.md#getting-a-blocks-position: there is no page at "blocks". Fix the link, or write the page it points to. |
| error | `page.empty` | `3.0/data-structure.md` | The page has no content. Write the page body, or delete the page. |
| warning | `frontmatter.description.missing` | `3.0/data-structure.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/embedding-media.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/embedding-media.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/exception-handling.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/fields.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/fields.md` | Link to requesting-pages.md#resolving-related-stories: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/fields.md` | Link to requesting-pages.md#resolving-related-stories: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/fields.md` | Link to views.md#the-render-method: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/fields.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/fields.md` | Link to embedding-media.md: there is no page at "embedding-media". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/folders.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/images.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/images.md` | Link to assets.md: there is no page at "assets". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/installation.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/installation.md` | Link to linking-the-visual-editor.md: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/installation.md` | Link to linking-the-visual-editor.md: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/laravel-storyblok-forms.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/linking-the-visual-editor.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/linking-the-visual-editor.md` | Link to troubleshooting.md: there is no page at "troubleshooting". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/overview.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/overview.md` | Link to pages.md: there is no page at "pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to assets.md: there is no page at "assets". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to linking-the-visual-editor.md#live-preview: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/overview.md` | Link to LICENSE.md: there is no page at "LICENSE". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/pages.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/pages.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/requesting-pages.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/requesting-pages.md` | Link to installation.md#routing: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/requesting-pages.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/templates.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/traits.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/traits.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/troubleshooting.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/typography.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/upgrading.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/upgrading.md` | Link to typography.md: there is no page at "typography". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/upgrading.md` | Link to css-classes.md: there is no page at "css-classes". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/upgrading.md` | Link to linking-the-visual-editor.md#live-preview: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/upgrading.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `3.0/views.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `3.0/whats-new.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to requesting-pages.md#resolving-related-stories: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to requesting-pages.md#resolving-inverse-relationships: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to cli.md: there is no page at "cli". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to embedding-media.md: there is no page at "embedding-media". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to fields.md#table-field: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `3.0/whats-new.md` | Link to linking-the-visual-editor.md#live-view: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/assets.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/assets.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/basic-usage.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/basic-usage.md` | Link to installation.md: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/basic-usage.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/basic-usage.md` | Link to views.md: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/basic-usage.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/blocks.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/blocks.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/blocks.md` | Link to views.md#creating-css-class-names: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/blocks.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/blocks.md` | Link to troubleshooting.md#live-preview-not-reloading: there is no page at "troubleshooting". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/cli.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/configuration.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/configuration.md` | Link to installation.md#configuration: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/css-classes.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/css-classes.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/css-classes.md` | Link to blocks.md#getting-a-blocks-position: there is no page at "blocks". Fix the link, or write the page it points to. |
| error | `page.empty` | `2.0/data-structure.md` | The page has no content. Write the page body, or delete the page. |
| warning | `frontmatter.description.missing` | `2.0/data-structure.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/embedding-media.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/embedding-media.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/exception-handling.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/fields.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/fields.md` | Link to requesting-pages.md#resolving-related-stories: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/fields.md` | Link to requesting-pages.md#resolving-related-stories: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/fields.md` | Link to views.md#the-render-method: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/fields.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/fields.md` | Link to embedding-media.md: there is no page at "embedding-media". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/folders.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/images.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/images.md` | Link to assets.md: there is no page at "assets". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/installation.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/installation.md` | Link to linking-the-visual-editor.md: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/installation.md` | Link to linking-the-visual-editor.md: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/laravel-storyblok-forms.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/linking-the-visual-editor.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/linking-the-visual-editor.md` | Link to troubleshooting.md: there is no page at "troubleshooting". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/overview.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/overview.md` | Link to pages.md: there is no page at "pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to assets.md: there is no page at "assets". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to linking-the-visual-editor.md#live-preview: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/overview.md` | Link to LICENSE.md: there is no page at "LICENSE". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/pages.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/pages.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/requesting-pages.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/requesting-pages.md` | Link to installation.md#routing: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/requesting-pages.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/templates.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/traits.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/traits.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/troubleshooting.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/typography.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/upgrading.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/upgrading.md` | Link to typography.md: there is no page at "typography". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/upgrading.md` | Link to css-classes.md: there is no page at "css-classes". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/upgrading.md` | Link to linking-the-visual-editor.md#live-preview: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/upgrading.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `2.0/views.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `2.0/whats-new.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to requesting-pages.md#resolving-related-stories: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to requesting-pages.md#resolving-inverse-relationships: there is no page at "requesting-pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to cli.md: there is no page at "cli". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to fields.md: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to embedding-media.md: there is no page at "embedding-media". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to fields.md#table-field: there is no page at "fields". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to images.md: there is no page at "images". Fix the link, or write the page it points to. |
| warning | `links.broken` | `2.0/whats-new.md` | Link to linking-the-visual-editor.md#live-view: there is no page at "linking-the-visual-editor". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/basic-usage.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/basic-usage.md` | Link to installation.md: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `links.broken` | `1.0/basic-usage.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `1.0/basic-usage.md` | Link to views.md: there is no page at "views". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/blocks.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/blocks.md` | Link to troubleshooting.md#live-preview-not-reloading: there is no page at "troubleshooting". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/configuration.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/configuration.md` | Link to installation.md#configuration: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/exception-handling.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `1.0/folders.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `1.0/images.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `1.0/installation.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/installation.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/overview.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/overview.md` | Link to pages.md: there is no page at "pages". Fix the link, or write the page it points to. |
| warning | `links.broken` | `1.0/overview.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `1.0/overview.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `links.broken` | `1.0/overview.md` | Link to folders.md: there is no page at "folders". Fix the link, or write the page it points to. |
| warning | `links.broken` | `1.0/overview.md` | Link to LICENSE.md: there is no page at "LICENSE". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/pages.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/pages.md` | Link to blocks.md: there is no page at "blocks". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/requesting-pages.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.broken` | `1.0/requesting-pages.md` | Link to installation.md#routing: there is no page at "installation". Fix the link, or write the page it points to. |
| warning | `frontmatter.description.missing` | `1.0/templates.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `1.0/troubleshooting.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `1.0/typography.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `frontmatter.description.missing` | `1.0/views.md` | Pages without a description get weaker llms.txt entries and search snippets. Add a one-sentence description to the frontmatter. |
| warning | `links.anchor` | `3.0/blocks.md` | Link to views.md#creating-css-class-names: no heading with the id #creating-css-class-names on views. |
| error | `links.broken` | `3.0/overview.md` | Link to LICENSE.md: there is no page LICENSE in version 3.0. |
| warning | `links.anchor` | `3.0/whats-new.md` | Link to linking-the-visual-editor.md#live-view: no heading with the id #live-view on linking-the-visual-editor. |
| warning | `links.anchor` | `2.0/blocks.md` | Link to views.md#creating-css-class-names: no heading with the id #creating-css-class-names on views. |
| error | `links.broken` | `2.0/overview.md` | Link to LICENSE.md: there is no page LICENSE in version 2.0. |
| warning | `links.anchor` | `2.0/whats-new.md` | Link to linking-the-visual-editor.md#live-view: no heading with the id #live-view on linking-the-visual-editor. |
| error | `links.broken` | `1.0/overview.md` | Link to LICENSE.md: there is no page LICENSE in version 1.0. |
