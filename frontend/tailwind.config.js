/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    darkMode: 'class',
    theme: {
      extend: {
        colors: {
          primary: '#0097b2'
        },
        fontFamily: {
          sans: ['Inter', 'ui-sans-serif', 'system-ui', 'system-ui']
        }
      }
    },
    plugins: []
  }
  