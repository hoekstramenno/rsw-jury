const mix = require('laravel-mix');

mix.sass('resources/scss/index.scss', 'public/assets/css/admin.css').options({processCssUrls: false});
mix.sass('resources/scss/pdf.scss', 'public/assets/css/pdf.css').options({processCssUrls: false});

mix.js([
    // 'resources/vendor/bootstrap/js/bootstrap.bundle.js',
    // 'resources/vendor/slimscroll/jquery.slimscroll.js',
    'resources/js/app.ts'
    // 'resources/vendor/charts/sparkline/jquery.sparkline.js',
    // 'resources/vendor/charts/morris-bundle/raphael.min.js',
    // 'resources/vendor/charts/morris-bundle/morris.js',
    // 'resources/vendor/charts/c3charts/c3.min.js',
    // 'resources/vendor/charts/c3charts/d3-5.4.0.min.js',
    // 'resources/vendor/charts/c3charts/C3chartjs.js',
    // 'resources/js/dashboard-ecommerce.js'
], 'public/assets/js/app.js');

mix.copy('resources/images', 'public/assets/images');


mix.options({
    postCss: [
        require('postcss-css-variables')()
    ]
});


