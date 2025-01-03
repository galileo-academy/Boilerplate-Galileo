/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'selector',
  content: ["./*.{php,html,js}","./templates/**/*.{php,html,js}"],
  theme: {
    screens: {
      'sm': '640px',
      'md': '767px',
      'lg': '1024px',
      'xl': '1440px',
    },
    colors: {
      'transparent': 'transparent',
      'black': '#000',
      'white': '#fff',
      'red': '#ff0000',
      'gray': {
        100: '#f7f7f7',
        200: '#f0f0f0',
        300: '#e0e0e0',
        400: '#d0d0d0',
        500: '#c0c0c0',
        600: '#b0b0b0',
        700: '#a0a0a0',
        800: '#909090',
        900: '#808080',
      },
    },
    fontFamily: {
      'primary': ['Poppins', 'sans-serif'],
      'secondary': ['Open Sans', 'serif'],
      'custom': ['Silkscreen', 'sans-serif']
    },
    extend: {
      fontFamily: ['hover', 'focus'],
    },
  },
  plugins: [],
}

