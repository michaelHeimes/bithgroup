=== Trailhead ===

Contributors: automattic
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

Requires at least: 4.5
Tested up to: 5.4
Requires PHP: 5.6
Stable tag: 1.0.0
License: GNU General Public License v2 or later
License URI: LICENSE

A starter theme called Trailhead.

== Description ==

Description

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload Theme and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= Does this theme support any plugins? =

Trailhead includes support for WooCommerce and for Infinite Scroll in Jetpack.

== Changelog ==

= 1.0 - May 12 2015 =
* Initial release

== Credits ==

* Based on Underscores https://underscores.me/, (C) 2012-2020 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css https://necolas.github.io/normalize.css/, (C) 2012-2018 Nicolas Gallagher and Jonathan Neal, [MIT](https://opensource.org/licenses/MIT)




# Trailhead Theme Build System

This modernized build system is designed for the Trailhead WordPress Theme. It utilizes Foundation 6.9.0, Dart Sass, and ESM/ES6 modules bundled via Esbuild for lightning-fast performance.


---

## Requirements

Node.js: >= 18.0.0
Package Manager: npm or yarn
Gulp CLI: Installed globally (npm install -g gulp-cli)
  
  
  Directory Structure
  
  source/
  ├─ scss/
  │  ├─ style.scss         # Entry point (Imports Foundation + Theme)
  │  ├─ foundation-settings # Your Foundation variable overrides
  │  └─ partials/          # Theme components (header, footer, etc.)
  ├─ js/
  │  └─ app.js             # Theme JS entry point (ESM imports)
  dist/
  ├─ css/                  # Compiled CSS (versioned filenames)
  ├─ js/                   # Bundled JS (versioned filenames)
  └─ manifest.json         # JSON map for WordPress enqueuing

  
  
  # Gulp Tasks - Trailhead Theme Build System
  
  Task Name	Description
  gulp	Default: Runs a fast build and starts BrowserSync + Watch.
  gulp build	Production: Full clean, minification, autoprefixing, and version bumping.
  gulp styles	Compiles SCSS. Fast in dev mode; minified in prod mode.
  gulp scripts	Bundles JS using Esbuild.
  gulp clean	Deletes the dist/ folder using rimraf.
  gulp bumpWP	Updates Version: in root style.css to match package.json.


Task Name	Description
  gulp	Default: Runs a fast build and starts BrowserSync + Watch.
  gulp build	Production: Full clean, minification, autoprefixing, and version bumping.
  gulp styles	Compiles SCSS. Fast in dev mode; minified in prod mode.
  gulp scripts	Bundles JS using Esbuild.
  gulp clean	Deletes the dist/ folder using rimraf.
  gulp bumpWP	Updates Version: in root style.css to match package.json.
  
  
  🚀 Speed Optimization
  Development Mode: gulp triggers isProd = false. This disables CSS minification and Autoprefixer to keep save times low.
  Production Mode: gulp build triggers isProd = true. This enables full minification and compatibility prefixing for the live site.