/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#034d97',
                'primary-dark': '#02366a',
                'primary-light': '#c5ddf5',
                'secondary': '#6B7280',
                'danger': '#EF4444',
                'success': '#327959',
                'warning': '#F59E0B',
                'info': '#3B82F6',
                'light': '#F3F4F6',
                'dark': '#131313',
                'white': '#FFFFFF',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
