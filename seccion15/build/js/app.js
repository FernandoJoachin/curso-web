document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    navegacionFija();
    crearGaleria();
    scrollNav();
}

function navegacionFija(){
    const barra = document.querySelector(".header");
    const sobreFestival = document.querySelector(".sobre-festival");
    const body = document.querySelector("body");

    window.addEventListener("scroll", function(){
        if(sobreFestival.getBoundingClientRect().bottom < 0){
            barra.classList.add("fijo");
            body.classList.add("body-scroll");
        }else{
            barra.classList.remove("fijo");
            body.classList.remove("body-scroll");
        }
    })
}

function scrollNav(){
    const enlaces = document.querySelectorAll(".navegacion-principal a");
    //No lo puedo asociar si tengo un addEventListener con un querySelectorAll
    enlaces.forEach(enlace => {
        enlace.addEventListener("click", function(e){
            e.preventDefault();
            const seccionScroll = e.target.attributes.href.value;
            const seccion = document.querySelector(seccionScroll);
            seccion.scrollIntoView({behavior:"smooth"})
        })
    });

}

function crearGaleria(){
    const galeria = document.querySelector(".galeria-img");
    for(let i = 1; i <= 12; i++){
        const img = document.createElement("PICTURE");
        img.innerHTML = `
        <source srcset="build/img/thumb/${i}.webp" type="image/webp">
        <source srcset="build/img/thumb/${i}.avif" type="image/avif">
        <img loading="lazy" width="200" height="300" src="build/img/thumb/${i}.jpg" alt="Imagen Galeria">
        `;
        img.onclick = function (){
            mostrarImagen(i);
        }
        galeria.appendChild(img);

    }
}

function mostrarImagen(index){
    const img = document.createElement("PICTURE");
    img.innerHTML = `
    <source srcset="build/img/grande/${index}.webp" type="image/webp">
    <source srcset="build/img/grande/${index}.avif" type="image/avif">
    <img loading="lazy" width="200" height="300" src="build/img/grande/${index}.jpg" alt="Imagen Galeria">
    `;
    //Crea el overlay con la imagen
    const overlay = document.createElement("DIV");
    overlay.appendChild(img);
    overlay.classList.add("overlay");
    overlay.onclick = function(){
        const body = document.querySelector("body");
        overlay.remove();
        body.classList.remove("fijar-body");
    }
    //Boton para cerrar el modal
    const cerrarModal = document.createElement("P");
    cerrarModal.textContent = "X";
    cerrarModal.classList.add("btn-cerrar");
    cerrarModal.onclick = function(){
        const body = document.querySelector("body");
        overlay.remove();
        body.classList.remove("fijar-body");
    }
    overlay.appendChild(cerrarModal);
    //Añadirlo al HTML
    const body = document.querySelector("body");
    body.appendChild(overlay);
    body.classList.add("fijar-body");
}
