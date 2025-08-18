/** @type {import('tailwindcss').Config} */
export default {
    content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
    darkMode: 'class',
    theme: {
      screens: {
        'xs': '475px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
        '2xl': '1536px',
      },
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
  