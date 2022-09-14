# Upgrading

---

## 2.3.1 -> 2.3.2

Set up the publishing webhook as specified in the installation instructions. Removed the JavaScript published event from the Editor Bridge Blade view.


## 2.2.0 -> 2.3.0

Legacy image fields are now converted to [Image](/{{route}}/{{version}}/images) classes.


## 2.1.0 -> 2.2.0

The `$casts` property on Blocks has been renamed to `$_casts` to reduce the likelihood of clashing with field names.

