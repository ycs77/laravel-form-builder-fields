const mix = require('laravel-mix');

// Copy TinyMCE files
mix.setPublicPath('public')
   .copy('node_modules/tinymce/tinymce.min.js', 'public/js/tinymce/tinymce.min.js')
   .copyDirectory('node_modules/tinymce/plugins', 'public/js/tinymce/plugins')
   .copyDirectory('node_modules/tinymce/skins', 'public/js/tinymce/skins')
   .copyDirectory('node_modules/tinymce/themes', 'public/js/tinymce/themes')
   .version();
