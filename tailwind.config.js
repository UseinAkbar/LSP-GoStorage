/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            'nunito': ['Nunito', 'sans-serif'],
            'raleway': ['Raleway', 'sans-serif'],
        },
        colors:{
            'primary-pink': '#E7AB9B',
            'primary-green': '#98A798',
            'primary-bg': '#E4EFE7',
        }
    },
  },
  plugins: [],
}
