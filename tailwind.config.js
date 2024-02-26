/** @type {import('tailwindcss').Config} */
import animations from '@midudev/tailwind-animations'

export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/js/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily:{
        'lexend':['Lexend Variable','sans-serif'],
        'phudu':['Phudu Variable', 'system-ui'],
        'com':['Comfortaa Variable', 'system-ui'],
      },
    },
    listStyleType:{
      disc:'disc',
      square:'square',
    },
    keyframes:{
      ping_sm:{
        '75%, 100%':{ transform: 'scale(2)', opacity: 0}
      }
    },
    animation:{
      'ping_sm': 'ping_sm 1s infinite;'
    }
  },
  plugins: [animations],
}