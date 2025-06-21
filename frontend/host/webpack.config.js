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
  output: {
    publicPath: "auto",
    clean: true,
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
    /**
    new ModuleFederationPlugin({
      name: "host",
      remotes: {
        remote: "remote@http://localhost:3001/remoteEntry.js", // 👈 подключаем удалённый remote
      },
      shared: {
        vue: {
          singleton: true,
          requiredVersion: "^3.0.0",
        },
      },
    }),
    */
    new HtmlWebpackPlugin({
      templateContent: `
        <!DOCTYPE html>
        <html lang="en">
          <head><meta charset="UTF-8"><title>Vue 3</title></head>
          <body><div id="app"></div></body>
        </html>
      `
    }),
    new VueLoaderPlugin()
  ],
};
