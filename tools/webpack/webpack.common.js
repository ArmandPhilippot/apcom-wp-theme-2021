require( 'dotenv' ).config();

const CopyPlugin = require( 'copy-webpack-plugin' );
const DotenvWebpackPlugin = require( 'dotenv-webpack' );
const ImageMinimizerPlugin = require( 'image-minimizer-webpack-plugin' );
const { extendDefaultPlugins } = require( 'svgo' );
const paths = require( './paths' );
const { recursiveIssuer } = require( './utils' );

module.exports = {
	entry: {
		scriptEditor: {
			import: paths.src.scripts.editor,
			filename: 'js/editor.js',
		},
		scriptFooter: {
			import: paths.src.scripts.footer,
			filename: 'js/footer.js',
		},
		scriptHeader: {
			import: paths.src.scripts.header,
			filename: 'js/header.js',
		},
		style: {
			import: paths.src.styles.style,
			filename: 'webpack/style.js',
		},
		styleEditor: {
			import: paths.src.styles.editor,
			filename: 'webpack/editor-style.js',
		},
		stylePrint: {
			import: paths.src.styles.print,
			filename: 'webpack/print.js',
		},
	},
	output: {
		path: paths.dist,
		clean: true,
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: [ 'babel-loader' ],
			},
			{
				test: /\.(png|jpe?g|gif|svg)$/i,
				type: 'asset/resource',
				generator: {
					filename: 'img/[name][ext]',
				},
			},
			{
				test: /\.(woff|woff2|eot|ttf|otf)$/i,
				type: 'asset/resource',
				generator: {
					filename: ( font ) => {
						const relativePath = font.filename;
						const filteredPath = relativePath.replace( 'src/', '' );
						return filteredPath;
					},
				},
			},
		],
	},
	optimization: {
		runtimeChunk: {
			name: () => `webpack/runtime`,
		},
		splitChunks: {
			cacheGroups: {
				style: {
					name: '../style',
					test: ( module, graphs, entry = 'style' ) =>
						module.constructor.name === 'CssModule' &&
						recursiveIssuer( module, graphs ) === entry,
					chunks: 'all',
					enforce: true,
				},
				styleEditor: {
					name: 'css/editor-style',
					test: ( module, graphs, entry = 'styleEditor' ) =>
						module.constructor.name === 'CssModule' &&
						recursiveIssuer( module, graphs ) === entry,
					chunks: 'all',
					enforce: true,
				},
				stylePrint: {
					name: 'css/print',
					test: ( module, graphs, entry = 'stylePrint' ) =>
						module.constructor.name === 'CssModule' &&
						recursiveIssuer( module, graphs ) === entry,
					chunks: 'all',
					enforce: true,
				},
			},
		},
	},
	plugins: [
		new ImageMinimizerPlugin( {
			minimizerOptions: {
				plugins: [
					[ 'gifsicle', { interlaced: true } ],
					[ 'mozjpeg', { progressive: true, quality: 75 } ],
					[ 'optipng', { optimizationLevel: 5 } ],
					[
						'svgo',
						{
							plugins: extendDefaultPlugins( [
								{
									name: 'removeTitle',
									active: true,
								},
								{
									name: 'removeViewBox',
									active: false,
								},
								{
									name: 'removeXMLNS',
									active: false,
								},
							] ),
						},
					],
				],
			},
		} ),
		new CopyPlugin( {
			patterns: [
				{
					from: paths.src.fonts,
					to: 'fonts',
					noErrorOnMissing: true,
				},
				{ from: paths.src.img, to: 'img', noErrorOnMissing: true },
			],
		} ),
		new DotenvWebpackPlugin(),
	],
};
