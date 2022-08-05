const defaultTheme = require('tailwindcss/defaultTheme');
const { colors } = require('tailwindcss/defaultTheme');
module.exports = {
    purge: {
        content: [
            './vendor/laravel/jetstream/**/*.blade.php',
            './resources/views/**/*.blade.php',
            './config/theme.php',
            './resources/**/*.{js,vue,blade.php}',
            './Modules/**/Resources/views/*.blade.php',
            './Modules/**/Resources/views/**/*.blade.php',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                teal: {
                    ...colors.teal,
                    '800': '#036672'
                },
                indigo: {
                    100: '#ebf4ff',
                    200: '#c3dafe',
                    ...colors.indigo,
                },
                brand: {
                    DEFAULT: "#6366F1",
                    light: "#818CF8",
                    dark: "#4F46E5",
                    gray: "#4B5563",
                }
            },
            typography: (theme) => ({
                DEFAULT: {
                    css: {
                        a: {
                            color: theme('colors.indigo.600'),
                            textDecoration: 'none',
                            '&:hover': {
                                color: theme('colors.indigo.400'),
                            },
                        },
                    },
                },
            }),
        },
    },
    variants: {
        backgroundColor: ['active', 'hover'],
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        animation: ['responsive', 'motion-safe', 'motion-reduce'],
        extend: {
            opacity: ['responsive', 'disabled'],
            animation: ['motion-safe', 'motion-reduce'],
        }
    },
    plugins: [
        // require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};