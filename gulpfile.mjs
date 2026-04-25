/** * Trailhead Theme Build System */
import gulp from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import postcss from 'gulp-postcss';
import autoprefixer from 'autoprefixer';
import rename from 'gulp-rename';
import browserSync from 'browser-sync';
import esbuild from 'gulp-esbuild';
import fs from 'fs';
import { rimraf } from 'rimraf';

const sass = gulpSass(dartSass);
const server = browserSync.create();
const pkg = JSON.parse(fs.readFileSync('./package.json', 'utf8'));

const isProd = process.argv.includes('build');

const paths = {
  scss: {
    src: 'source/scss/style.scss',
    watch: 'source/scss/**/*.scss',
    dest: 'dist' // Pointing directly to dist
  },
  js: {
    src: 'source/js/app.js',
    watch: 'source/js/**/*.js',
    dest: 'dist' // Pointing directly to dist
  },
  php: '**/*.php',
  dist: 'dist'
};

export const clean = () => rimraf(paths.dist);

/**
 * Styles Task - Consolidated
 */
export function styles() {
  return gulp.src(paths.scss.src, { sourcemaps: !isProd })
    .pipe(sass({
      // includePaths simplified
      includePaths: ['node_modules', 'source/scss'], 
      outputStyle: isProd ? 'compressed' : 'expanded'
    }).on('error', sass.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(rename(`bundle.${pkg.version}.min.css`))
    // Removed the {sourcemaps: '.'} conflict, let gulp handle it via src options
    .pipe(gulp.dest(paths.scss.dest, { sourcemaps: !isProd ? '.' : false }))
    .pipe(server.stream());
}

/**
 * Scripts Task - With CSS Loader for Swiper
 */
export function scripts() {
   return gulp.src(paths.js.src)
     .pipe(esbuild({
       outfile: `bundle.${pkg.version}.min.js`,
       bundle: true,
       minify: isProd,
       sourcemap: true,
       target: 'es2015',
       loader: { '.js': 'js' } // Removed CSS loader
     }))
     .pipe(gulp.dest(paths.js.dest))
     .pipe(server.stream());
 }

export function bumpWP(cb) {
  const stylePath = './style.css';
  if (fs.existsSync(stylePath)) {
    let content = fs.readFileSync(stylePath, 'utf8');
    content = content.replace(/(Version:\s*)(.*)/, `$1${pkg.version}`);
    fs.writeFileSync(stylePath, content);
  }
  cb();
}

export function manifest(cb) {
  if (!fs.existsSync(paths.dist)) { fs.mkdirSync(paths.dist); }
  const data = {
    js: `bundle.${pkg.version}.min.js`,
    css: `bundle.${pkg.version}.min.css` // One name to rule them all
  };
  fs.writeFileSync(`${paths.dist}/manifest.json`, JSON.stringify(data, null, 2));
  cb();
}
export function watch() {
  server.init({
    proxy: "http://trailhead.local",
    notify: false,
    open: false
  });
  gulp.watch(paths.scss.watch, styles);
  gulp.watch(paths.js.watch, scripts);
  gulp.watch(paths.php).on('change', server.reload);
}

export const build = gulp.series(clean, gulp.parallel(styles, scripts), gulp.parallel(bumpWP, manifest));
export default gulp.series(build, watch);
