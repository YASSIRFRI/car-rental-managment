const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        'resources/js/**/*.vue',
    ],
    darkMode: false,
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                palette: {
                  1: '#4682A9',
                  2: '#749BC2',
                  3: '#91C8E4',
                  4: '#F6F4EB',
                  5: '#164863',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
