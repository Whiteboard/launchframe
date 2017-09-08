var ProvidePlugin = require('webpack').ProvidePlugin;
var path = require('path');
var autoprefixer = require('autoprefixer');
let CleanWebpackPlugin = require('clean-webpack-plugin');
let pathsToClean = [
	'dist'
]
let cleanOptions = {
	root: __dirname,
	verbose:  true,
	dry:      false
}
let clean = 

module.exports = {
		entry: [
				`${__dirname}/src/js/script.js`,
				`${__dirname}/src/scss/application.scss`,
		],
		module: {
				loaders: [{
						test: /\.js$/,
						exclude: /(node_modules)/,
						loader: 'babel'
				}, {
						test: /\.html$/,
						loader: 'file?name=[name].[ext]'
				}, {
						test: /\.(jpe?g|png|gif)$/,
						exclude: /(node_modules)/,
						loader: 'url-loader?limit=10000'
				}, {
						test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
						loader: "url-loader?limit=10000&minetype=application/font-woff"
				}, {
						test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
						loader: "file-loader"
				}]
		},
		plugins: [
        new CleanWebpackPlugin(pathsToClean, cleanOptions),
				new ProvidePlugin({
						$: 'jquery',
						jQuery: 'jquery',
						"window.jQuery": 'jquery',
						"windows.jQuery": 'jquery',
				})
		],
};
