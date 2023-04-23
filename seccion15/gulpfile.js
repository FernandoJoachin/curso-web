const {src, dest, watch, parallel} = require("gulp");

//CSS
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");

//IMG
const imagemin = require("gulp-imagemin");
const cache = require("gulp-cache");
const webp = require("gulp-webp");
const avif = require("gulp-avif");

function css(done){
    // "**/*" De forma recursiva va detectando en todas las carpetas que tenga esa extension
    src("src/scss/**/*.scss") //Identificar el archivo SASS
    .pipe(plumber())
    .pipe(sass()) //Compilarlo
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

function dev(done){
    watch("src/scss/**/*.scss", css);
    done();
}
exports.css = css;
exports.aligerarImagen = aligerarImagen
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.dev = parallel(aligerarImagen, versionWebp, versionAvif, dev);