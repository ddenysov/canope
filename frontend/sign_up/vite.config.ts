import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import { federation } from '@module-federation/vite';
import cssInjectedByJsPlugin from 'vite-plugin-css-injected-by-js'
import tailwindcss from '@tailwindcss/vite'


// https://vite.dev/config/
export default defineConfig({
  base: './',
  server: {
    port: 3002,
    cors: true,
    headers: { 'Access-Control-Allow-Origin': '*' }
  },
  plugins: [
    vue(),
    vueDevTools(),
    tailwindcss(),
    federation({
      name: 'sign_up',
      filename: 'remoteEntry.js',
      // Modules to expose
      remotes: {
        ui: {
          type: "module",
          name: "ui",
          entry: "http://localhost:8100/ui/remoteEntry.js",
        },
      },
      exposes: {
        './SignUp': './src/SignUp.vue',
      },
      shared: {
        vue: {
          singleton: true,
        },
        tailwindcss: {
          singleton: true,
        },
        pinia: {
          singleton: true,
        },
      },
    }),
    cssInjectedByJsPlugin({
      // опционально: фильтр по нужным чанкам
      jsAssetsFilterFunction: (chunk) => chunk.fileName === 'remoteEntry.js'
    })
  ],
  build:{
    minify:false,
    target: ["esnext"],
    outDir: '../static/dist/sign_up',
    emptyOutDir: true,
    rollupOptions: {
      output: {
        format: 'esm',
      },
    },
  },
  define: { __VUE_PROD_DEVTOOLS__: true }
})

