import defaultTheme from 'tailwindcss/defaultTheme';
import daisyui from 'daisyui';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                barlow: ['Barlow', 'sans-serif'],
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [daisyui],
    daisyui: {
        themes: [
            {
                gradTracerTheme: {
                    ...require("daisyui/src/theming/themes")["light"],
                    "primary": "#680000",
                    // "primary-focus": "#89220f",
                    "primary-content": "#ffffff",
                }
            }
        ],
    },
    theme: {
        container: {
            center: true,
            padding: '2rem',
            screens: {
                '2xl': '1400px'
            }
        },
        fontFamily: {
            'barlow': ['Barlow', 'sans-serif']
        },
        extend: {
            // Custom Screen Size (Prismara)
            screens: {
                xs: '300px',
                tab: '1366px',
                laptop_L: '1440px',
                full: '1900px'
            },

            gridTemplateColumns: {
                '13': 'repeat(13, minmax(0, 1fr))',
                '14': 'repeat(14, minmax(0, 1fr))'
            },
            gridColumn: {
                'span-13': 'span 13 / span 13',
                'span-14': 'span 14 / span 14'
            },

            colors: {
                // Custom Colors
                gold: '#ffd700',
                azure: 'rgb(13,58,156)',
                semiMaroon: 'rgb(202, 59, 59)',

                muted: {
                    DEFAULT: 'hsl(var(--muted) / <alpha-value>)',
                    foreground: 'hsl(var(--muted-foreground) / <alpha-value>)'
                },
                // accent: {
                //     DEFAULT: 'hsl(var(--accent) / <alpha-value>)',
                //     foreground: 'hsl(var(--accent-foreground) / <alpha-value>)'
                // },
                // popover: {
                //     DEFAULT: 'hsl(var(--popover) / <alpha-value>)',
                //     foreground: 'hsl(var(--popover-foreground) / <alpha-value>)'
                // },
                // card: {
                //     DEFAULT: 'hsl(var(--card) / <alpha-value>)',
                //     foreground: 'hsl(var(--card-foreground) / <alpha-value>)'
                // }
            },
        }
    }
};
