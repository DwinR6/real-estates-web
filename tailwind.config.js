import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                dancing: ["'Dancing Script'", 'cursive'],
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideInRight: {
                    '0%': { transform: 'translateX(100%)' },
                    '100%': { transform: 'translateX(0)' },
                },
                bounceIn: {
                    '0%, 20%, 40%, 60%, 80%, 100%': {
                        transform: 'translateY(0)',
                    },
                    '50%': {
                        transform: 'translateY(-10px)',
                    },
                },
                scaleIn: {
                    '0%': { transform: 'scale(1)' },
                    '100%': { transform: 'scale(1.1)' },
                },
                scaleOut: {
                    '0%': { transform: 'scale(1.1)' },
                    '100%': { transform: 'scale(1)' },
                },
                // Agregar más keyframes aquí
            },
            animation: {
                fadeIn: 'fadeIn 1s ease-in-out',
                slideInRight: 'slideInRight 0.5s ease-in-out',
                bounceIn: 'bounceIn 1s ease-in-out',
                scaleIn: 'scaleIn 0.5s forwards',
                scaleOut: 'scaleOut 0.5s forwards',
                // Agrega más animaciones aquí
            },

            colors:
            {
                'ctmred': '#991c27',
                'ctmblue': '#142040',
                'ctmskyblue': '#3F618C',
                'ctmdanger': '#F20505',
                'ctmwhite': '#F2F2F2',

            }
        },
    },

    plugins: [forms, typography],
};
