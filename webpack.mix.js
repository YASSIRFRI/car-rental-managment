const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue() // Add this line to enable Vue support
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]);

mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.vue$/,
                loader: 'vue-loader'
            }
        ]
    }
});

mix.alias({
    '@': 'resources/js',
});
