# What’s new

---


- [Version 1.1.0](#1-2-0)
- [Version 1.1.0](#1-1-0)

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


