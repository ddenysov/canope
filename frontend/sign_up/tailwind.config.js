// tailwind.config.js
module.exports = {
  content: [
    "./src/**/*.{js,jsx,ts,tsx,vue,html}",                 // все твои файлы в src
    "./node_modules/@local/ui/**/*.{js,jsx,ts,tsx,vue,html}" // файлы библиотеки @local/ui
  ],
  theme: {
    extend: {
      // здесь можешь добавить свои расширения темы
    },
  },
  plugins: [
    // твои плагины, если нужны
  ],
}
