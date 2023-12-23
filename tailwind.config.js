/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/**/*.{js,blade.php}",
    "./app/View/Components/**/**/*.php",
    "./app/Livewire/**/**/*.php",

    // Add mary
    "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    extend: {},
  },
    daisyui: {
        themes: ["dracula", "winter"]
    },
  plugins: [require("daisyui")],
}

