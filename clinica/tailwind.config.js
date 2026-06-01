import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
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
        },
    },

    plugins: [forms,
        require('daisyui')],                //🌟 Plugin de componentes activado🌟
    // 🌟 CONFIGURACIÓN CORRECTA DE TEMAS 🌟
    daisyui: {
        themes: [
            "light",       // Tema claro base
            "dark"        // Tema oscuro base
        ],
    },
};
