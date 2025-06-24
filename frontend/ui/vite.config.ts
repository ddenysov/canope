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
        './install': './src/install.ts',
      },
      shared: {
        vue: {
          singleton: true,
        },
      },
    }),
    copy({
      targets: [
        { src: 'dist/**/*', dest: '../static/dist/ui' }
      ],
      hook: 'writeBundle',
      copyOnce: true,
    }),
    del({
      targets: ['../static/dist/ui/*'],
      hook: 'buildStart',
      force: true,
    }),
  ],
  build:{
    minify:false,
    target: ["chrome89", "edge89", "firefox89", "safari15"]
  },
  define: { __VUE_PROD_DEVTOOLS__: true }
})

