var path = require('path');
var commonConfig = require('./webpack.common.config');
var ExtractTextPlugin = require("extract-text-webpack-plugin");
var extractCSS = new ExtractTextPlugin(`../css/application.css`);

var output = {
		path: `/${__dirname}/dist/js`,
		publicPath: 'http://localhost:8080/build/',
		filename: 'script.js'
};

module.exports = Object.assign(commonConfig, {
		output: output,
		devtool: 'source-map',
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
