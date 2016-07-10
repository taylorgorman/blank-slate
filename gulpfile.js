
var gulp = require( 'gulp' );
var plug = require( 'gulp-load-plugins' )();

/*
** Locations
*/
var bases = [
	'themes/blank-slate/'
,	'plugins/blank-slate/resources/'
];
var dir = {
	'base' : 'themes/blank-slate/'
,	'dev'  : 'pre/'
};
var files = {
	'sass' : dir.dev + '**/*.scss'
,	'js'   : dir.dev + '**/*.js'
,	'img'  : '**/*'
};

/*
** gulp
*/
gulp.task( 'default', ['css', 'js', 'img'] );

/*
** gulp deploy
**
** Once this is finished, might want to ditch gulp-load-plugins
** and require docs's and git's plugins inside them
** so they aren't unnecessarily loaded during dev.
**
gulp.task( 'deploy', ['css', 'js', 'img', 'docs', 'git'] );
*/

/*
** gulp watch
*/
gulp.task( 'watch', function( ){

	gulp.watch( dir.dev + 'css/**/*', ['css'] );
	gulp.watch( dir.dev + 'js/**/*', ['js'] );
	gulp.watch( dir.dev + 'img/**/*', ['img'] );

} );

/*
** gulp css
**
** Works for any css/src/ folder in this project, no matter where
** TODO: Do this for every folder in bases.
*/
gulp.task( 'css', function( ){

	return gulp.src( dir.base + 'css/' + files.sass )
	.pipe( plug.count('## .sass files found') )

	// Compile SASS and save
	.pipe( plug.sass({
		outputStyle : 'expanded'
	}) )
	.pipe( plug.autoprefixer() )
	.pipe( plug.lineEndingCorrector() )
	.pipe( plug.count('## .css files saved') )
	.pipe( gulp.dest( dir.base + 'css/' ) )

	// Save minified versions
	.pipe( plug.rename({ suffix: '.min' }) )
	.pipe( plug.cssnano() )
	.pipe( plug.lineEndingCorrector() )
	.pipe( gulp.dest( dir.base + 'css/' ) );

} );

/*
** gulp js
**
** Works for any js/src/ folder in this project, no matter where
** TODO: Do this for every folder in bases.
*/
gulp.task( 'js', function( ){

	return gulp.src( dir.base + 'js/' + files.js )
	.pipe( plug.count('## .js files found') )

	.pipe( plug.concat('scripts.js') )
	.pipe( plug.lineEndingCorrector() )
	.pipe( gulp.dest( dir.base + 'js/' ) )
	.pipe( plug.count('## .js files saved') )

	// Minified versions
	.pipe( plug.rename({ suffix: '.min' }) )
	.pipe( plug.uglify() )
	.pipe( plug.lineEndingCorrector() )
	.pipe( gulp.dest( dir.base + 'js/' ) );

} );

/*
** gulp img
**
** Works for any img/ folder in this project, no matter where
** TODO: Do this for every folder in bases.
*/
gulp.task( 'img', function( ){

	return gulp.src( dir.base + 'img/' + files.img )
	.pipe( plug.cache(plug.imagemin({
		optimizationLevel : 3
	,	progressive       : true
	,	interlaced        : true
	})) )
	.pipe( gulp.dest( dir.base + 'img/' ) )
	.pipe( plug.count('## images saved') );

	// strip junk from svg files
	// add id's or use tags or whatever to svg?
	// autogenerate css file for turning svg's into <i>'s?
	// optimize jpg and png separately?

} );

/*
** gulp docs
*/
gulp.task( 'docs', function( ){

	// docs for the whole project.
	// php functions, other wordpress stuff
	// necessary/useful css selectors.
	// everything js is doing.
	// include sass maps here too?
	// to dos

} );