import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import { federation } from '@module-federation/vite';

// https://vite.dev/config/
export default defineConfig({
  server: {
    port: 3000,
  },
  plugins: [
    vue(),
    vueDevTools(),
    federation({
      name: 'host',
      manifest: true,

      remotes: {
        ui: {
          type: "module",
          name: "ui",
          entry: "http://localhost:3001/remoteEntry.js",
        },
      },
      exposes: {},
      shared: {
        vue: {
          singleton: true,
        },
      },
    }),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
})
