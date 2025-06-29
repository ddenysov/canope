import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import { federation } from '@module-federation/vite';

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
        './install': './src/install.ts',
      },
      remotes: {},
      shared: {
        vue: {
          singleton: true,
        },
      },
    }),
  ],
  build:{
    minify:false,
    target: ["esnext"],
    outDir: '../static/dist/ui',
    emptyOutDir: true,
    rollupOptions: {
      output: {
        format: 'esm',
      },
    },
  },
  define: { __VUE_PROD_DEVTOOLS__: true },
  resolve: {
    alias: {
      '@': fileURLToPath(new URL('./src', import.meta.url))
    },
  },
})

