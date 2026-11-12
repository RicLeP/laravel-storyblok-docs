---
title: Troubleshooting
description: 'Common issues, debugging advice, and troubleshooting steps for Laravel Storyblok.'
---

# Troubleshooting

## Live preview does not reload in Storyblok editor {#live-preview-not-reloading}

If your live preview does not reload when saving or publishing changes in the Storyblok editor then you may have forgotten to service your website securely. To allow the editor to communicate with the Storyblok library on your website both must be served over https.

## No editable regions shown in editor {#no-regions-in-editor}

The editor functionality depends upon HTML comments in your document to identify the components. By default Vue removes comments from your HTML which breaks the editor integration, to fix this update your Vue app allowing comments.

```javascript
const app = new Vue({
	el: '#app',
	comments: true,
    ...
});
```
