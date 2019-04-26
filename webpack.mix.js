const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
//ADMIN CSS
mix.styles([
  'resources/assets/plugins/bootstrap/css/bootstrap.min.css',
  'resources/assets/plugins/c3-master/c3.min.css',
  'resources/assets/css/style.css',
  'resources/assets/css/colors/blue.css',
  'resources/assets/plugins/html5-editor/bootstrap-wysihtml5.css',
  'resources/assets/plugins/select2/dist/css/select2.min.css'
], 'public/css/admin.css');
//ADMIN JS
mix.scripts([
  'resources/assets/plugins/jquery/jquery.min.js',
  'resources/assets/plugins/popper/popper.min.js',
  'resources/assets/plugins/bootstrap/js/bootstrap.min.js',
  'resources/assets/js/jquery.slimscroll.js',
  'resources/assets/js/waves.js',
  'resources/assets/js/sidebarmenu.js',
  'resources/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js',
  'resources/assets/plugins/sparkline/jquery.sparkline.min.js',
  'resources/assets/js/custom.min.js',
  'resources/assets/plugins/d3/d3.min.js',
  'resources/assets/plugins/c3-master/c3.min.js',
  'resources/assets/plugins/select2/dist/js/select2.full.min.js',
  'resources/assets/js/jasny-bootstrap.js',
  'resources/assets/plugins/datatables/datatables.min.js',
  'resources/assets/plugins/html5-editor/wysihtml5-0.3.0.js',
  'resources/assets/plugins/html5-editor/bootstrap-wysihtml5.js',
  'resources/assets/js/summernote.js',
  'resources/assets/js/startPlugins.js'
], 'public/js/admin.js');
//ADMIN FILES
mix.copy([
  'resources/assets'
], 'public/assets');

//FRONT CSS
mix.styles([
  'resources/front/libs/bootstrap/dist/css/bootstrap.css',
  'resources/assets/plugins/select2/dist/css/select2.min.css',
  'resources/front/css/style.css'
], 'public/css/front.css');
//FRONT JS
mix.scripts([
  'resources/front/libs/jquery/dist/jquery.min.js',
  'resources/front/libs/bootstrap/dist/js/bootstrap.min.js',
  'resources/front/libs/lazysizes/lazysizes.min.js',
  'resources/assets/plugins/datatables/datatables.min.js',
  'resources/front/js/sipmleSearch.js',
  'resources/assets/plugins/select2/dist/js/select2.full.min.js',
  'resources/front/js/script.js'
], 'public/js/front.js');

//FRONT FILES
mix.copy('resources/front/fonts', 'public/fonts');
mix.copy('resources/front/img', 'public/image');

// Vuejs
mix.js('resources/js/app.js', 'public/js');