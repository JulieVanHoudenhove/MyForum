/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/app.js",
    "./templates/base.html.twig",
    "./templates/nav.html.twig",
    "./templates/home/index.html.twig",
    "./templates/post/index.html.twig",
    "./templates/post/new.html.twig",
    "./templates/home/show.html.twig",
    "./templates/registration/register.html.twig",
    "./templates/security/login.html.twig",
    "./templates/user/show.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        'vert': '#84a98c',
        'gris_input': '#eee',
        'gris_text': '#666'
      },
      fontFamily: {
        'Poppins': ['Poppins'],
      },
    },
  },
  plugins: [],
}

