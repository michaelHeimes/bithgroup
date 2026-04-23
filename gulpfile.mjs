/**
 * Trailhead Theme Build System
 */
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

// Flag to check if we are running 'build' or 'default/watch'
const isProd = process.argv.includes('build');

const paths = {
  scss: { src: 'source/scss/style.scss', watch: 'source/scss/**/*.scss', dest: 'dist/css/' },
  js: { src: 'source/js/app.js', watch: 'source/js/**/*.js', dest: 'dist/js/' },
  php: '**/*.php',
  dist: 'dist'
};

export const clean = () => rimraf(paths.dist);

/**
 * Optimized Styles Task
 */
export function styles() {
  return gulp.src(paths.scss.src, { sourcemaps: !isProd })
    .pipe(sass({
      includePaths: [
        'node_modules', 
        'node_modules/foundation-sites/scss',
        'node_modules/motion-ui'
      ],
      // 'expanded' is much faster for development than 'compressed'
      outputStyle: isProd ? 'compressed' : 'expanded' 
    }).on('error', sass.logError))
    .pipe(postcss([autoprefixer()]))
    .pipe(rename(`bundle.${pkg.version}.min.css`))
    .pipe(gulp.dest(paths.scss.dest, { sourcemaps: '.' }))
    .pipe(server.stream());
}

export function scripts() {
  return gulp.src(paths.js.src)
    .pipe(esbuild({
      outfile: `bundle.${pkg.version}.min.js`,
      bundle: true,
      minify: isProd, // Only minify JS in production
      sourcemap: true,
      target: 'es2015',
      loader: { '.js': 'js' },
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
    css: `bundle.${pkg.version}.min.css`
  };
  fs.writeFileSync(`${paths.dist}/manifest.json`, JSON.stringify(data, null, 2));
  cb();
}

export function watch() {
  server.init({ proxy: "http://trailhead.local", notify: false, open: false });
  gulp.watch(paths.scss.watch, styles);
  gulp.watch(paths.js.watch, scripts);
  gulp.watch(paths.php).on('change', server.reload);
}

export const build = gulp.series(clean, gulp.parallel(styles, scripts), gulp.parallel(bumpWP, manifest));
export default gulp.series(build, watch);
