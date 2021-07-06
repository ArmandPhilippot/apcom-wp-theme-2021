/**
 * Gulpfile
 *
 * Use Gulp to build a WordPress theme.
 *
 * Implements:
 * - BrowserSync (with watch task)
 * - Sass compilation, autoprefixer, sourcemaps and minification (style,
 * style-rtl, style-editor, print and vendors styles)
 * - Babel transpilation, concatenation and minification (main scripts and
 * vendors scripts)
 * - Images optimizations (JPG, PNG, GIF, SVG)
 * - Pot file generation
 * - Move fonts from src to assets
 * - Zip folder without development files
 * - Copy `package.json` version to style.css and functions.php
 * - A one-time task to init your theme
 *
 * @author Armand Philippot <contact@armandphilippot.com>
 */

/**
 * Load Gulp configuration and error handler.
 */
const config = require('./gulp/config');
const errorHandler = require('./gulp/error-handler');

/**
 * Load Gulp plugins.
 */
/* CSS */
const { src, dest, watch, series, parallel, lastRun } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const sorting = require('postcss-sorting');
const autoprefixer = require('autoprefixer');
const cleanCSS = require('gulp-clean-css');
const rtl = require('gulp-rtlcss');

/* JS */
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

/* Images */
const imagemin = require('gulp-imagemin');

/* Translation */
const pot = require('gulp-wp-pot');

/* Live reload */
const browserSync = require('browser-sync');
const server = browserSync.create();
const reload = browserSync.reload;

/* Utilities */
const del = require('del');
const filter = require('gulp-filter');
const fs = require('fs');
const lec = require('gulp-line-ending-corrector');
const notify = require('gulp-notify');
const { pipeline } = require('stream');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const zip = require('gulp-zip');

/**
 * Load package.json data.
 */
const packageJson = JSON.parse(fs.readFileSync('./package.json'));
const packageVersion = packageJson.version;

/**
 * Task: `serve`
 *
 * Init BrowserSync for live reloading.
 *
 * @param done
 */
function serve(done) {
	browserSync.init(config.browserSync);
	done();
}

/**
 * Task: `clean`
 *
 * Delete all generated assets.
 *
 * @param done
 */
function clean(done) {
	del.sync(config.clean.paths);
	done();
}

/**
 * Task: `styles`
 *
 * Generate style.css and style.min.css. SCSS to CSS compilation, properties
 * sorting, autoprefixer, minification.
 */
function styles() {
	return pipeline(
		[
			src(config.styles.src.main, { sourcemaps: true }),
			sass(config.styles.sassOptions),
			postcss(
				[sorting(config.styles.postCss.sortingOptions)],
				[autoprefixer()]
			),
			lec(),
			dest(config.styles.dest.main),
			filter('**/*.css'),
			rename({ suffix: '.min' }),
			cleanCSS(),
			lec(),
			dest(config.styles.dest.main, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'Styles task complete',
				message: 'style.css and style.min.css have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `rtlStyles`
 *
 * Generate style-rtl.css and style-rtl.min.css. SCSS to CSS compilation, properties
 * sorting, autoprefixer, minification.
 */
function rtlStyles() {
	return pipeline(
		[
			src(config.styles.src.main, { sourcemaps: true }),
			sass(config.styles.sassOptions),
			postcss(
				[sorting(config.styles.postCss.sortingOptions)],
				[autoprefixer()]
			),
			lec(),
			rename('style-rtl.css'),
			rtl(),
			dest(config.styles.dest.main),
			filter('**/*.css'),
			rename({ suffix: '.min' }),
			cleanCSS(),
			lec(),
			dest(config.styles.dest.main, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'rtlStyles task complete',
				message:
					'style-rtl.css and style-rtl.min.css have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `printStyles`
 *
 * Generate print.css and print.min.css. SCSS to CSS compilation, properties
 * sorting, autoprefixer, minification.
 */
function printStyles() {
	return pipeline(
		[
			src(config.styles.src.print, { sourcemaps: true }),
			sass(config.styles.sassOptions),
			postcss(
				[sorting(config.styles.postCss.sortingOptions)],
				[autoprefixer()]
			),
			lec(),
			dest(config.styles.dest.print),
			filter('**/*.css'),
			rename({ suffix: '.min' }),
			cleanCSS(),
			lec(),
			dest(config.styles.dest.print, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'printStyles task complete',
				message: 'print.css and print.min.css have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `editorStyles`
 *
 * Generate style-editor.css and style-editor.min.css. SCSS to CSS compilation,
 * properties sorting, autoprefixer, minification.
 */
function editorStyles() {
	return pipeline(
		[
			src(config.styles.src.editor, { sourcemaps: true }),
			sass(config.styles.sassOptions),
			postcss(
				[sorting(config.styles.postCss.sortingOptions)],
				[autoprefixer()]
			),
			lec(),
			dest(config.styles.dest.editor),
			filter('**/*.css'),
			rename({ suffix: '.min' }),
			cleanCSS(),
			lec(),
			dest(config.styles.dest.editor, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'editorStyles task complete',
				message:
					'style-editor.css and style-editor.min.css have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `vendorsStyles`
 *
 * Generate vendors.css and vendors.min.css. SCSS to CSS compilation, properties
 * sorting, autoprefixer, minification.
 */
function vendorsStyles() {
	return pipeline(
		[
			src(config.styles.src.vendors, { sourcemaps: true }),
			sass(config.styles.sassOptions),
			postcss(
				[sorting(config.styles.postCss.sortingOptions)],
				[autoprefixer()]
			),
			lec(),
			dest(config.styles.dest.vendors),
			filter('**/*.css'),
			rename({ suffix: '.min' }),
			cleanCSS(),
			lec(),
			dest(config.styles.dest.vendors, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'vendorsStyles task complete',
				message: 'vendors.css and vendors.min.css have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `footerScripts`
 *
 * Generate app.js and app.min.js to place in footer. JS concatenation and minification.
 */
function footerScripts() {
	return pipeline(
		[
			src(config.scripts.src.footer, { sourcemaps: true }),
			babel(),
			concat('app.js'),
			lec(),
			dest(config.scripts.dest.footer),
			rename({ suffix: '.min' }),
			uglify(),
			lec(),
			dest(config.scripts.dest.footer, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'footerScripts task complete',
				message: 'app.js and app.min.js have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `headerScripts`
 *
 * Generate scripts.js and scripts.min.js to place in header. JS concatenation and minification.
 */
function headerScripts() {
	return pipeline(
		[
			src(config.scripts.src.header, { sourcemaps: true }),
			babel(),
			concat('scripts.js'),
			lec(),
			dest(config.scripts.dest.header),
			rename({ suffix: '.min' }),
			uglify(),
			lec(),
			dest(config.scripts.dest.header, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'headerScripts task complete',
				message: 'scripts.js and scripts.min.js have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `vendorsScripts`
 *
 * Generate vendors.js and vendors.min.js. JS concatenation and minification.
 */
function vendorsScripts() {
	return pipeline(
		[
			src(config.scripts.src.vendors, { sourcemaps: true }),
			babel(),
			concat('vendors.js'),
			lec(),
			dest(config.scripts.dest.vendors),
			rename({ suffix: '.min' }),
			uglify(),
			lec(),
			dest(config.scripts.dest.vendors, { sourcemaps: '.' }),
			server.stream(),
			notify({
				title: 'vendorsScripts task complete',
				message: 'vendors.js and vendors.min.js have been compiled.',
				onLast: config.notify.onLastOption,
			}),
		],
		errorHandler
	);
}

/**
 * Task: `images`
 *
 * Compress images (png, jpg, gif, svg).
 *
 * @param done
 */
function images(done) {
	return pipeline(
		[
			src(config.images.src, { since: lastRun(images) }),
			imagemin([
				imagemin.gifsicle(config.images.imageminOptions.gif),
				imagemin.mozjpeg(config.images.imageminOptions.jpg),
				imagemin.optipng(config.images.imageminOptions.png),
				imagemin.svgo(config.images.imageminOptions.svg),
			]),
			dest(config.images.dest),
			notify({
				title: 'Images task complete',
				message: 'Images have been compressed.',
				onLast: config.notify.onLastOption,
			}),
		],
		done
	);
}

/**
 * Task: `compilePotFile`
 *
 * Generate a pot file for translation.
 *
 * @param done
 */
function compilePotFile(done) {
	return pipeline(
		[
			src(config.translation.src),
			pot(config.translation.potOptions),
			dest(config.translation.dest + '/' + config.translation.filename),
			notify({
				title: 'compilePotFile task complete',
				message: 'POT file have been generated.',
			}),
		],
		done
	);
}

/**
 * Task: `moveFonts`
 *
 * Move fonts from src folder to assets folder.
 *
 * @param done
 */
function moveFonts(done) {
	return pipeline(
		[
			src(config.fonts.src),
			dest(config.fonts.dest),
			notify({
				title: 'moveFonts task complete',
				message: 'Fonts have been moved to assets.',
			}),
		],
		done
	);
}

/**
 * Task: `zipTheme`
 *
 * Generate a zip version of the theme without development files.
 *
 * @param done
 */
function zipTheme(done) {
	return pipeline(
		[
			src(config.zip.src),
			zip(config.zip.filename),
			dest(config.zip.dest),
			notify({
				title: 'zipTheme task complete',
				message: 'Theme have been zipped.',
			}),
		],
		done
	);
}

/**
 * Task: `bumpCSS`
 *
 * Copy package.json version in Sass variable and recompile CSS.
 *
 * @param done
 */
function bumpCSS(done) {
	return pipeline(
		[
			src(config.bump.styles.src),
			replace(/theme_version: "(.{5})"/g, function() {
				return 'theme_version: "' + packageVersion + '"';
			}),
			dest(config.bump.styles.dest),
		],
		done
	);
}

/**
 * Task: `bumpPHP`
 *
 * Copy package.json version in functions.php.
 *
 * @param done
 */
function bumpPHP(done) {
	return pipeline(
		[
			src(config.bump.files.src),
			replace(/_VERSION', '(.{5})'/g, function() {
				return "_VERSION', '" + packageVersion + "'";
			}),
			dest(config.bump.files.dest),
		],
		done
	);
}

function initTheme(done) {
	return pipeline(
		[
			src(config.init.src, { base: './' }),
			replace('Firstname Lastname', function() {
				return config.init.authorName;
			}),
			replace('your@email.com', function() {
				return config.init.authorEmail;
			}),
			replace('https://www.yourWebsite.com/', function() {
				return config.init.authorUrl;
			}),
			replace('2020 Company Name', function() {
				return config.init.copyright;
			}),
			replace('Your theme description.', function() {
				return config.init.description;
			}),
			replace('Your-Package-Name', function() {
				return config.init.packageUppercase;
			}),
			replace('your-package-name', function() {
				return config.init.packageLowercase;
			}),
			replace('yourprefix', function() {
				return config.init.prefix;
			}),
			replace('YOURPREFIX', function() {
				return config.init.prefix.toUpperCase();
			}),
			replace('https://github.com/your/repo', function() {
				return config.init.repo;
			}),
			replace('yourTextDomain', function() {
				return config.init.textDomain;
			}),
			replace('your-vendor-name', function() {
				return config.init.vendorName;
			}),
			dest(config.init.dest),
		],
		done
	);
}

/**
 * Task: `watchFiles`
 *
 * Reload tasks when files change.
 *
 * @param done
 */
function watchFiles(done) {
	watch(config.styles.watch.main).on(
		'change',
		series(parallel(styles, rtlStyles, editorStyles), reload)
	);
	watch(config.styles.watch.editor).on(
		'change',
		series(editorStyles, reload)
	);
	watch(config.styles.watch.print).on('change', series(printStyles, reload));
	watch(config.styles.watch.vendors).on(
		'change',
		series(vendorsStyles, reload)
	);
	watch(config.scripts.watch.footer).on(
		'change',
		series(footerScripts, reload)
	);
	watch(config.scripts.watch.header).on(
		'change',
		series(headerScripts, reload)
	);
	watch(config.scripts.watch.vendors).on(
		'change',
		series(vendorsScripts, reload)
	);
	watch(config.images.watch).on('change', series(images, reload));
	watch(config.files.watch).on('change', series(compilePotFile, reload));
	watch(config.fonts.watch).on('change', series(moveFonts, reload));
	done();
}

/**
 * Public tasks
 */
const build = parallel(
	styles,
	rtlStyles,
	printStyles,
	editorStyles,
	vendorsStyles,
	footerScripts,
	headerScripts,
	vendorsScripts,
	images,
	compilePotFile,
	moveFonts
);
exports.build = build;
exports.bump = parallel(bumpCSS, bumpPHP);
exports.default = series(clean, build);
exports.initTheme = parallel(initTheme);
exports.recompileCSS = parallel(styles, rtlStyles);
exports.translate = compilePotFile;
exports.watch = parallel(serve, watchFiles);
exports.zipTheme = series(zipTheme);
