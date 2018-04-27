const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

const extractSass = new ExtractTextPlugin({
    filename: "css/[name].css"
});

module.exports = {

  context: path.join(process.cwd(), 'assets/src'), //the home directory for webpack

  devtool: 'source-map', // enhance debugging by adding meta info for the browser devtools

  entry: {
    app: ['js/app.js', 'scss/application.scss']
  },

  output: {
    path: path.join(process.cwd(), 'assets/dist'),
    filename: 'js/[name].js',
    publicPath: '/',
    sourceMapFilename: '[name].map'
  },

  resolve: {
    extensions: ['.js'],  // extensions that are used
    modules: [path.join(process.cwd(), 'assets/src'), 'node_modules'] // directories where to look for modules
  },

  module: {
    rules: [{
      enforce: "pre", //to check source files, not modified by other loaders (like babel-loader)
      test: /\.js$/,
      exclude: /node_modules/,
      loader: "eslint-loader"
    }, {
      test: /\.js$/,
      exclude: /node_modules/,
      use: {
        loader: 'babel-loader',
        options: {
          presets: ['env']
        }
      }
    },{
        test: /\.scss$/,
        use: extractSass.extract({
            use: [{
                loader: "css-loader",
                options: {
                    sourceMap: true
                }
            }, {
                loader: "sass-loader",
                options: {
                    sourceMap: true
                }
            }],
            // use style-loader in development
            fallback: "style-loader"
        })
    },{
    rules: [{
			test: /\.(gif|png|jpe?g|svg)$/i,
			use: [
				'file-loader',
				{
					loader: 'image-webpack-loader',
					options: {
						mozjpeg: {
							progressive: true,
							quality: 65
						},
						optipng: {
							enabled: false,
						},
						pngquant: {
							quality: '65-90',
							speed: 4
						},
						gifsicle: {
							interlaced: false,
						},
						webp: {
							quality: 75
						}
					}
				},
			],
		}]
    }]
  },
  plugins: [
    new CleanWebpackPlugin(['assets/dist'], {root: process.cwd()}),
    new webpack.optimize.CommonsChunkPlugin({
      name: "vendor"
    }),
    extractSass
  ]
};
