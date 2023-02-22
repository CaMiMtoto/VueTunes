/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#0A66C2',
                'primary-dark': '#034d97',
                'primary-light': '#f1faff',
                'secondary': '#6B7280',
                'danger': '#EF4444',
                'success': '#327959',
                'warning': '#F59E0B',
                'info': '#3B82F6',
                'light': '#F3F4F6',
                'dark': '#1F2937',
                'white': '#FFFFFF',
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
