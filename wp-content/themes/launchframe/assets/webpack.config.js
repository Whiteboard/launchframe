const path = require('path');
const commonConfig = require('./webpack.common.config');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
let extractCSS = new ExtractTextPlugin(`../css/application.min.css`);

var output = {
		path: `/${__dirname}/dist/js`,
		publicPath: 'http://www.example.com/build/',
		filename: 'script.min.js'
};

module.exports = Object.assign(commonConfig, {
		output: output,
		module: {
      rules: [
        {
          test: /\.s?css$/,
          exclude: /(node_modules)/,
          use: extractCSS.extract(['css-loader', 'sass-loader'])
        }
      ]
		},
  plugins: commonConfig.plugins.concat(extractCSS)
});
