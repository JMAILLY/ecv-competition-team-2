"use strict";
var gulp = require("gulp"),
  sass = require("gulp-sass"),
  globImporter = require("sass-glob-importer"),
  uglify = require("gulp-uglify"),
  concat = require("gulp-concat"),
  plumber = require("gulp-plumber");

//style paths
var paths = {
  sass: [
    "assets/scss/**/*.scss",
    "assets/scss/**/*._scss",
    "assets/scss/*.scss",
  ],
  js: "assets/js/**/*.js",
};

gulp.task("sass", function () {
  return gulp
    .src([
      "assets/scss/**/*.scss",
      "assets/scss/**/*._scss",
      "assets/scss/*.scss",
    ])
    .pipe(sass({ importer: globImporter() }).on("error", sass.logError))
    .pipe(gulp.dest("dist/css"));
});

gulp.task("scripts", function () {
  return gulp
    .src(["assets/js/vendors/*.js", "assets/js/main.js"])
    .pipe(plumber())
    .pipe(uglify())
    .pipe(concat("main.min.js"))
    .pipe(plumber.stop())
    .pipe(gulp.dest("dist/js"));
});

gulp.task("watch", function () {
  gulp.watch(paths.sass, gulp.series("sass"));
  gulp.watch(paths.js, gulp.series("scripts"));
});

// watching scss/html files
gulp.task("default", gulp.series("sass", "scripts", "watch"));

// gulp.task("sass", function () {
//   gulp
//     .src(sassFiles)
//     .pipe(sass().on("error", sass.logError))
//     .pipe(gulp.dest(cssDest));
// });

// gulp.task("watch", function () {
//   gulp.watch(sassFiles, gulp.series("sass"));
// });

// // watching scss/html files
// gulp.task("default", gulp.series("sass", "watch"));
