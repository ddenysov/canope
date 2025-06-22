const path = require('path')
const HtmlWebpackPlugin = require('html-webpack-plugin')
const {VueLoaderPlugin} = require('vue-loader')
const {ModuleFederationPlugin} = require("webpack").container;

module.exports = {
  entry: './src/main.js',
  output: {
    path: path.resolve(__dirname, '..', 'static', 'dist', 'sign_up'),
    clean: true,
    filename: '[name].[contenthash].js', // добавляем хеш
    chunkFilename: '[name].[contenthash].js', // для динамически загружаемых чанков
  },
  resolve: {
    extensions: ['.js', '.vue']
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      },
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader']
      },
    ]
  },
  plugins: [
    new HtmlWebpackPlugin({
      excludeChunks: ['sign_up'],
      templateContent: `
        <!DOCTYPE html>
        <html lang="en">
          <head>
          <meta charset="UTF-8"><title>Vue 3</title>
          </head>
          <body><div id="app"></div></body>
        </html>
      `
    }),
    new VueLoaderPlugin(),
    new ModuleFederationPlugin({
      name: "sign_up",
      filename: "remoteEntry.js",
      remotes: {
        'ui': "ui@http://localhost:8100/ui/remoteEntry.js",
      },
      exposes: {
        "./App": "./src/App.vue",
      },
      shared: {
        vue: {
          singleton: true,
          eager: true,
        },
      },
    }),
  ],
  devServer: {
    static: {
      directory: path.resolve(__dirname, 'dist')
    },
    port: 3000,
    open: true,
    hot: true
  },
  mode: 'development',
  devtool: 'source-map'
}
