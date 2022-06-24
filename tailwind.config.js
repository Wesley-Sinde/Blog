module.exports = {
  darkMode: "class",
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
    "./node_modules/flowbite/**/*.js",
    "./resources/**/*.js",
    "./resources/**/*.vue",

  ],
  theme: {
    extend: {}
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ],

  darkMode: 'class',

   plugins: [
       require('flowbite/plugin')
   ],

    content: [
        "./node_modules/flowbite/**/*.js"
    ]

}
