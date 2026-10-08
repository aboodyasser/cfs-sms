import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            // Semantic brand colors — aliases onto Tailwind's built-in
            // sky/fuchsia/amber scales (which happen to exactly match
            // the landing page palette). Use these names (primary/
            // secondary/tertiary) across the admin panel instead of
            // sky/fuchsia/amber directly, so the whole system's
            // identity can be re-themed later by editing this file
            // alone, without touching every Blade view.
            colors: {
                primary: colors.sky,
                secondary: colors.fuchsia,
                tertiary: colors.amber,
            },
        },
    },

    plugins: [forms],
};
