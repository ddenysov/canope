const { ModuleFederationPlugin } = require("webpack").container;
const HtmlWebpackPlugin = require('html-webpack-plugin')
const { VueLoaderPlugin } = require('vue-loader')
const path = require("path");

module.exports = {
  entry: "./src/main.js",
  mode: "development",
  devServer: {
    port: 3001,
    historyApiFallback: true,
  },
  devtool: 'source-map',
  output: {
    path: path.resolve(__dirname, '..', 'static', 'dist', 'host'),
    publicPath: "auto",
    clean: true,
    filename: '[name].[contenthash].js', // добавляем хеш
    chunkFilename: '[name].[contenthash].js', // для динамически загружаемых чанков
  },
  resolve: {
    extensions: [".vue", ".js", ".json"],
  },
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: "vue-loader",
      },
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader']
      },
    ],
  },
  plugins: [
    new ModuleFederationPlugin({
      name: "host",
      remotes: {
        'ui' : "ui@http://localhost:8100/ui/remoteEntry.js",
        'sign_up' : "sign_up@http://localhost:8100/sign_up/remoteEntry.js"
        //'sign_up' : "sign_up@http://localhost:3000/remoteEntry.js"
      },
      shared: {
        vue: {
          singleton: true,
          eager: true,
        },
      },
    }),

    new HtmlWebpackPlugin({
      templateContent: `
        <!DOCTYPE html>
        <html lang="en">
          <head>
          <meta charset="UTF-8"><title>Vue 3</title></head>
          <body><div id="app"></div></body>
        </html>
      `
    }),
    new VueLoaderPlugin()
  ],
};
