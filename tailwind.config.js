/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./public/js/**/*.js",
  ],
  theme: {
    extend: {},
    listStyleType:{
      disc:'disc',
      square:'square',
    }
  },
  plugins: [],
}