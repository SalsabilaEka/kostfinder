import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                cream: '#FAF6EF',
                darkbrown: '#3F3530',
                brown: '#5C4433',
                gold: '#E6C491',
                goldhover: '#DAB27E'
            }
        },
    },

    plugins: [forms],
};
