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
      name: 'store',
      filename: 'remoteEntry.js',
      // Modules to expose
      exposes: {
        './store': './src/store.ts',
      },
      remotes: {},
      shared: {
        vue: {
          singleton: true,
        },
        pinia: {
          singleton: true,
        },
      },
    }),
  ],
  build:{
    minify:false,
    target: ["esnext"],
    outDir: '../static/dist/store',
    emptyOutDir: true,
    cssCodeSplit: false,
    rollupOptions: {
      output: {
        format: 'esm',
        entryFileNames:    '[name].js',
        chunkFileNames:    'assets/[name].[hash].js',
        assetFileNames:    'assets/[name].[hash].[ext]',
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

