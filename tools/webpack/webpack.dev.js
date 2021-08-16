const paths = require( './paths' );

require( 'dotenv' ).config();

const protocol = process.env.WP_THEME_PROTOCOL;
const host = process.env.WP_THEME_HOST;
const port = process.env.WP_THEME_PORT;
const contentFolder = process.env.WP_THEME_CONTENT_FOLDER;
const themeFolder = process.env.WP_THEME_FOLDER;
const siteURL = protocol + '://' + host;
const isHotReload = process.env.WP_THEME_HOT_RELOAD === 'true';
const isHttps = protocol === 'https';
const publicPath =
	siteURL +
	':' +
	port +
	'/' +
	contentFolder +
	'/themes/' +
	themeFolder +
	'/assets/';

module.exports = {
	mode: 'development',
	module: {
		rules: [
			{
				test: /\.(sa|sc|c)ss$/i,
				use: [
					'style-loader',
					{
						loader: 'css-loader',
						options: {
							importLoaders: 2,
							sourceMap: true,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							postcssOptions: {
								plugins: [ 'autoprefixer' ],
							},
							sourceMap: true,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							implementation: require( 'sass' ),
							sassOptions: {
								indentWidth: 2,
								outputStyle: 'expanded',
								includePaths: paths.sassPaths,
							},
							sourceMap: true,
						},
					},
				],
			},
		],
	},
	devtool: 'inline-source-map',
	target: 'web',
	devServer: {
		host,
		port,
		publicPath,
		before( app, server ) {
			server._watch( paths.files );
		},
		hot: isHotReload,
		liveReload: ! isHotReload,
		https: ! isHttps
			? false
			: {
				key: process.env.WP_THEME_HTTPS_KEY,
				cert: process.env.WP_THEME_HTTPS_CERT,
			},
		proxy: {
			'/': {
				target: siteURL,
				secure: false,
				changeOrigin: true,
				autoRewrite: true,
			},
		},
		headers: {
			'Access-Control-Allow-Origin': '*',
			'Access-Control-Allow-Methods':
				'GET, POST, PUT, DELETE, PATCH, OPTIONS',
			'Access-Control-Allow-Headers':
				'X-Requested-With, content-type, Authorization',
		},
		overlay: {
			warnings: true,
			errors: true,
		},
		open: process.env.WP_THEME_OPEN,
		writeToDisk: true,
	},
	watchOptions: {
		poll: true,
	},
};
