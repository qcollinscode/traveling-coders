/***************************
 * Gulp Module Imports
 **************************/
import browserSync    from   'browser-sync';
import babel          from   'gulp-babel';
import autoprefixer   from   'gulp-autoprefixer';
import concatCSS      from   'gulp-concat-css';
import concatJS       from   'gulp-concat';
import connectPHP     from   'gulp-connect-php';
import eslint         from   'gulp-eslint';
import gulp           from   'gulp';
import httpProxy      from   'http-proxy';
import imagemin       from   'gulp-imagemin';
import install        from   'install';
import minifyCSS      from   'gulp-clean-css';
import minifyJS       from   'gulp-minify';
import npm            from   'npm';
import plumber        from   'gulp-plumber';
import rename         from   'gulp-rename';
import sass           from   'gulp-sass';
import sourcemaps     from   'gulp-sourcemaps';
import watch          from   'gulp-watch';

/***************************
 * Helpers
 **************************/
// class Options {
//     constructor (obj, key) {
//         this.obj = obj
//         this.getOptions(key)
//     }
//     getOptions (key) {

//         /** Return the whole options object if no key name was passed. */
//         return arguments.length <= 0 ? this.obj : this.obj[key];
//     }
// }


/** Options Helper */
const options = {
  init: function(obj) {
    this.obj = obj;
    return this;
  },
  getOptions: function(key) {

      /** Return the options object if no key name was passed. */
    return arguments.length <= 0 ? this.obj : this.obj[key];
  }
}


const returnFiles  = (src, files) => {
    const arr = [],
          len = files.length;
    for(let file in files) {
        let filePath = src + files[file];
        arr.push(filePath);
    }
    return arr;
}

/***************************
 * Options
 **************************/
const
    browserSyncOptions          =   Object.create(options).init({ proxy: 'localhost/traveling-coders/src' }),
    gulpBabel                   =   Object.create(options).init({ presets: 'es2015' }),
    gulpRename                  =   Object.create(options).init({ fileNameCSS: 'main.css', fileNameJS: 'main.js', baseName: 'main', extName: '.js' }),
    gulpImageMinify             =   Object.create(options).init({ progressive: true, optimizationLevel: 5 });

/***************************
* Variables
**************************/
const
    renameFileNameJS            =   gulpRename.getOptions('fileNameJS'),
    mainCssFile                 =   'main.css',
    imageRoot                   =   './src/assets/img/',
    jsRoot                      =   './src/assets/js/',
    cssRoot                     =   './src/assets/css/',
    cssDevRoot                  =   './src/assets/css/dev/',
    allImages                   =   './src/assets/img/dev/*.*',
    allSassFiles                =   './src/assets/css/dev/sass/**/*.scss',
    allJSFiles                  =   './src/assets/js/dev/**/*.js',
    allPHPFiles                 =   './src/**/*.php',
    jsFiles                     =   returnFiles('./src/assets/js/dev/', ['jquery.min.js', 'bootstrap.min.js', 'main.js']),
    cssFiles                    =   returnFiles('./src/assets/css/dev/', ['normalize.min.css', 'bootstrap.min.css', 'font-awesome.min.css', 'mainstyle.css']);

/***************************
* Development
**************************/

// Scripts
gulp.task('js', () => {
    return gulp.src(jsFiles)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(babel(gulpBabel.getOptions()))
        .pipe(concatJS(renameFileNameJS))
        .pipe(minifyJS())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest(jsRoot))
        .pipe(browserSync.stream());
});

// SASS
gulp.task('sass', () => {
    return gulp.src(allSassFiles)
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(cssDevRoot))
});

// CSS
gulp.task('css', ['sass'], () => {
    return gulp.src(cssFiles)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(concatCSS(mainCssFile))
        .pipe(minifyCSS())
        .pipe(gulp.dest(cssRoot))
        .pipe(browserSync.stream());
});

// Images
gulp.task('img', () => {
  return watch(allImages, () => {
    gulp.src(allImages)
      .pipe(plumber())
      .pipe(imagemin(gulpImageMinify.getOptions()))
      .pipe(gulp.dest(imageRoot))
      .pipe(browserSync.stream());
  });
});

// Browser-sync Server
gulp.task('connect', () => {
    browserSync( browserSyncOptions.getOptions() );
});

gulp.task('watch', ['connect'], () => {
    gulp.watch(allPHPFiles).on('change', () => {
        browserSync.reload();
    });
    gulp.watch(allJSFiles, ['js']);
    gulp.watch(allSassFiles, ['css']);
});


/***************************
 * Production
 **************************/

/***************************
 * Default
 **************************/
gulp.task('default', ['js', 'css', 'img', 'watch']);
