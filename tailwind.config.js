/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {

      colors: {
        darkGreen: "#157298",
        lightGreen: "#01A49D",
      },
    },
  },
  plugins: [],
}

