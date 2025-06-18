// vue.config.js
const { defineConfig } = require('@vue/cli-service');
const path = require('path');

module.exports = defineConfig({
  /**
   * ──────────────────────────────────────────────────────────
   * Базовые настройки сборки
   * ──────────────────────────────────────────────────────────
   */

  // ➜ URL, с которого отдаются бандлы в браузере.
  //    Для single-spa-локалки ставим /static/, чтобы Nginx раздавал файлы из одной папки.
  //publicPath: '/static/',

  // ➜ Готовые файлы будут лежать здесь. Для монорепо с одним Nginx — общий /dist.
  outputDir: path.resolve(__dirname, 'static/dist'),

  // ➜ Выключаем хэши в именах файлов: так проще обновлять import-map и дебажить.
  filenameHashing: false,

  // ──────────────────────────────────────────────────────────
  // Кастомизация Webpack одной «маской»
  // ──────────────────────────────────────────────────────────
  configureWebpack: {
    // То, что попадёт напрямую в webpack.config.js
    output: {
      /**
       * library / libraryTarget нужны, если это микрофронтенд под single-spa.
       * SystemJS работает c форматом 'system'.
       */
      library: 'mf-catalog',     // поменяй на имя своего MF
      libraryTarget: 'system',   // или 'umd', если не используешь SystemJS
      filename: '[name]-sign-up.js',
    },

    /**
     * externals пригодятся, чтобы не тянуть второй экземпляр Vue,
     * если root-config уже грузит Vue как глобальную зависимость.
     */
    externals: {
      //vue: 'Vue',
    },
  },

  // ──────────────────────────────────────────────────────────
  // Тонкая настройка через chainWebpack (webpack-chain API)
  // ──────────────────────────────────────────────────────────
  chainWebpack: (config) => {
    // Пример: вырезать preload/prefetch, если они мешают dev-дебагу
    config.plugins.delete('preload');
    config.plugins.delete('prefetch');

    // Пример: alias на src/, если нужен
    config.resolve.alias.set('@', path.resolve(__dirname, 'src'));
  },

  /**
   * ──────────────────────────────────────────────────────────
   * Настройка dev-сервера.
   * Локально он не нужен, если бандлы раздаёт Nginx,
   * но CLI всё равно пытается поднять его при `vue-cli-service serve`.
   * Можно отключить HMR, открыть нужный порт или вообще не пользоваться serve-режимом.
   * ──────────────────────────────────────────────────────────
   */
  devServer: {
    // Если всё равно запускаешь `npm run serve`, то пусть слушает «фоновый» порт
    port: 8081,
    // В single-spa зачастую HMR не нужен: false → жёсткий перезагруз
    hot: false,
  },

  /**
   * Дополнительные опции CLI
   */
  transpileDependencies: true, // как у тебя было
});
