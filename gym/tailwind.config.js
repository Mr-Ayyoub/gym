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

    module:exports = {
        theme: {
            extend: {
                colors: {
                    'bg-white': '#3b82f6',
                    'custom-green': '#10b981',
                    // يمكنك تعريف المزيد من الألوان هنا
                },
            },
        },
    },

    plugins: [forms],
};

// ==================

// javascript
// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';

// /** @type {import('tailwindcss').Config} */
// export default {
//     content: [
//         './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
//         './storage/framework/views/*.php',
//         './resources/views/**/*.blade.php',
//     ],

//     theme: {
//         extend: {
//             fontFamily: {
//                 sans: ['Figtree', ...defaultTheme.fontFamily.sans],
//             },
//             colors: {
//                 'custom-blue': '#3b82f6',
//                 'custom-green': '#10b981',
//                 // يمكنك تعريف المزيد من الألوان هنا
//             },
//         },
//     },

//     plugins: [forms],
// };

