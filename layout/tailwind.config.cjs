/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {
      gridTemplateRows: {
        '[auto,auto,1fr]': 'auto auto 1fr',
        
      },
      display: ["group-hover"],
    }
    },
    plugins: [
      require('@tailwindcss/aspect-ratio'),
      // require('@tailwindcss/forms'),
      require('flowbite/plugin'),
      require("daisyui"),
    ],
  }
