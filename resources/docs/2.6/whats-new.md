# What’s new

---


- [Version 2.5.0](#2-6-0)
- [Version 2.5.0](#2-5-0)
- [Version 2.4.0](#2-4-0)
- [Version 2.3.0](#2-3-0)
- [Version 2.2.0](#2-2-0)
- [Version 2.1.0](#2-1-0)
- [Version 2.0.0](#2-0-0)
- [Version 1.2.0](#1-2-0)
- [Version 1.1.0](#1-1-0)

<a name="2-6-0">
## Version 2.6.0
</a>

- Live preview of changes in the visual editor!
- Removed old ‘live field’ support as it didn’t work well

<a name="2-5-0">
## Version 2.5.0
</a>

- Added support components in [Rich text Fields](/{{route}}/{{version}}/fields) 
- **2.5.16** Added `ls:stub-views` command to scaffold Blade files for each component
]()
<a name="2-4-0">
## Version 2.4.0
</a>

- [Embed media](/{{route}}/{{version}}/embedding-media) such as Twitter and YouTube in Fields


<a name="2-3-0">
## Version 2.3.0
</a>

- Legacy images are converted into [Image](/{{route}}/{{version}}/images) classes.
- [Tables Fields](/{{route}}/{{version}}/fields#table-field) can now have a caption and CSS class specified.
- **2.3.2** Added support for clearing cache via the Storyblok Publish webhook. This means the Editor Bridge Blade view has had the JavaScript publish event removed.


<a name="2-2-0">
## Version 2.2.0
</a>

- Added support for [image transformations](/{{route}}/{{version}}/images) in the visual editor


<a name="2-1-0">
## Version 2.1.0
</a>

- Added support for the [live preview](/{{route}}/{{version}}/linking-the-visual-editor#live-view) in the visual editor

- Table fields are now automatically converted to HTML

<a name="2-0-0">
## Version 2.0.0
</a>

- A complete rewrite of the entire package
- Added new Field classes (previously everything was a Block)
- Automatically detect common field types such as richtext and assets and convert them into the appropiate format.
- Remove the need to manually specify markdown and richtext fields
- Lots of tweaks and bug fixes

<a name="1-2-0">
## Version 1.2.0
</a>

- Blocks now have a `parent()` method which returns the parent Block or Page if you’re on the root Block
- Blocks have a `page()` method returning the Page the block is part of
- Added Schema.org support using [Spatie’s Schema.org package](https://github.com/spatie/schema-org)
- Full Page object is now passed to views


<a name="1-1-0">
## Version 1.1.0
</a>

- Blocks now have a _compontentPath array which includes the current and all parent components. This enables you to work out the context of the current Block.
- New CssClassses trait that can be used to generated css classes for the current Block, the layout it’s in, it’s parent Blocks etc.
- Traits added to Blocks can be auto-initialised


