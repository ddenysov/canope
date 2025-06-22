import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import { federation } from '@module-federation/vite';

// https://vite.dev/config/
export default defineConfig({
  server: {
    port: 3001,
  },
  plugins: [
    vue(),
    vueDevTools(),
    federation({
      name: 'ui',
      filename: 'remoteEntry.js',
      // Modules to expose
      exposes: {
        './App': './src/App.vue',
      },
    })
  ],
  build:{
    minify:false,
    target: ["chrome89", "edge89", "firefox89", "safari15"]
  }
})

