import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import { federation } from '@module-federation/vite';
import copy from 'rollup-plugin-copy';
import del from 'rollup-plugin-delete'

// https://vite.dev/config/
export default defineConfig({
  base: './',
  server: {
    port: 3000,
    cors: true,
    headers: { 'Access-Control-Allow-Origin': '*' }
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
          entry: "http://localhost:8100/ui/remoteEntry.js",
        },
        navbar: {
          type: "module",
          name: "navbar",
          entry: "http://localhost:8100/navbar/remoteEntry.js",
        },
        sign_up: {
          type: "module",
          name: "sign_up",
          entry: "http://localhost:8100/sign_up/remoteEntry.js",
         },
      },
      exposes: {},
      shared: {
        vue: {
          singleton: true,
        },
        'vue-router': { singleton: true },
      },
    }),
    copy({
      targets: [
        { src: 'dist/**/*', dest: '../static/dist/host' }
      ],
      hook: 'writeBundle',
      copyOnce: true,
    }),
    del({
      targets: ['../static/dist/host/*'],
      hook: 'buildStart',
      force: true,
    }),
  ],
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
  build: {
    target: 'esnext',
  },
})
