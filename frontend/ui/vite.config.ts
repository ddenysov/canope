import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import { federation } from '@module-federation/vite';
import cssInject from 'vite-plugin-css-injected-by-js'
import autoprefixer from 'autoprefixer'
import tailwindcss from '@tailwindcss/vite'

// https://vite.dev/config/
export default defineConfig({
  base: './',
  css: {
    postcss: {
      plugins: [
        autoprefixer(),
      ]
    }
  },
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
    tailwindcss(),
    cssInject(),
  ],
  build:{
    minify:false,
    target: ["esnext"],
    outDir: '../static/dist/ui',
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

