/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}"
  ],
  theme: {
    extend: {
      colors: {
        'vert': '#84a98c',
        'gris_input': '#eee',
        'gris_text': '#666',
        'stat_border': '#ededed'
      },
      fontFamily: {
        'Poppins': ['Poppins'],
      },
    },
  },
  plugins: [],
}

