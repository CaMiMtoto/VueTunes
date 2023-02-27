/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {
            colors: {
                'primary': '#EE732F',
                'primary-dark': '#e75e12',
                'primary-light': '#f8ceb7',
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
