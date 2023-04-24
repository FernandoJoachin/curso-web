const {src, dest, watch, parallel} = require("gulp");

//CSS
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");

//IMG
const imagemin = require("gulp-imagemin");
const cache = require("gulp-cache");
const webp = require("gulp-webp");
const avif = require("gulp-avif");

//Javascript
const terser = require("gulp-terser-js");

function css(done){
    // "**/*" De forma recursiva va detectando en todas las carpetas que tenga esa extension
    src("src/scss/**/*.scss") //Identificar el archivo SASS
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(sass()) //Compilarlo
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write("."))
    .pipe(dest("build/css")) //Almacenarlo en el disco duro
    done(); //Callback que avisa a gulp cuando llegamos al final
}

function aligerarImagen(done){
    const opciones = {
        optimizationLevel: 3
    }

    src("src/img/**/*.{jpg,png}")
        .pipe(cache(imagemin(opciones)))
        .pipe(dest("build/img"))

    done();    
}

function versionWebp(done){
    const opciones = {
        quality: 50
    }

    src("src/img/**/*.{jpg,png}")
        .pipe(webp())
        .pipe(dest("build/img"))

    done();    
}

function versionAvif(done){
    const opciones = {
        quality: 50
    }

    src("src/img/**/*.{jpg,png}")
        .pipe(avif())
        .pipe(dest("build/img"))

    done();    
}

function javascript(done){
    src("src/js/**/*.js")
        //Unificar y mejorar el javascript 
        //.pipe(sourcemaps.init())
        //.pipe(terser())
        //.pipe(sourcemaps.write("."))
        .pipe(dest("build/js"))

    done();
}

function dev(done){
    watch("src/scss/**/*.scss", css);
    watch("src/js/**/*.js", javascript);
    done();
}
exports.css = css;
exports.javascript = javascript;
exports.aligerarImagen = aligerarImagen
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.dev = parallel(aligerarImagen, versionWebp, versionAvif, javascript, dev);