const {src, dest, watch} = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const plumber = require("gulp-plumber");

function css(done){
    // "**/*" De forma recursiva va detectando en todas las carpetas que tenga esa extension
    src("src/scss/**/*.scss") //Identificar el archivo SASS
    .pipe(plumber())
    .pipe(sass()) //Compilarlo
    .pipe(dest("build/css")) //Almacenarlo en el disco duro
    done(); //Callback que avisa a gulp cuando llegamos al final
}

function dev(done){
    watch("src/scss/**/*.scss", css);
    done();
}
exports.css = css;
exports.dev = dev;