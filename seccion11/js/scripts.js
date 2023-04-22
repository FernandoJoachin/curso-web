//querySelector
const heading = document.querySelector(".header__texto h2"); //0 o 1  Elementos
heading.textContent = "Soy Fernando";

//querySelectorAll
const nav = document.querySelectorAll(".navegacion a");
nav[0].textContent = "Edicion Enlace";
nav[0].href = "https://www.youtube.com/watch?v=mBYSUUnMt9M&t=3949s";
nav[0].classList.add("nuevo-classs");
//nav[0].classList.remove("navegacion__enlace");

//getElementById
const heading2 = document.getElementById("heading");

//Generar un enlace
const nuevoEnlace = document.createElement("A");

//Agregar el href
nuevoEnlace.href = "nuevo-enlace.html";

//Agregar el texto
nuevoEnlace.textContent = "Nuevo Enlace";

//Agregar la clase
nuevoEnlace.classList.add("navegacion__enlace");

//Agregar el documento
const navegacion = document.querySelector(".navegacion");
navegacion.appendChild(nuevoEnlace);

//Eventos
console.log(1);
window.addEventListener("load", () => console.log(2)); //load espera a que el JS y los archivos que dependen del HTML estén listos
//Segunda forma
window.onload = () => console.log(3);

document.addEventListener("DOMContentLoaded", () => console.log(4)); //Solo espera por el HTML, pero no espera CSS o imagenes
console.log(5);
window.onscroll = () => console.log("scrolling...");

//Seleccionar elementos y asociarles un evento
// const btnEnviar = document.querySelector(".boton--primario");
// btnEnviar.addEventListener("click", function(evento){
//     console.log(evento);
//     evento.preventDefault();
//     console.log("enviando formulario");
// })

//Eventos de los Inputs y Textarea
const datos = {
    nombre : "",
    email : "",
    mensaje : ""
}

const nombre = document.querySelector("#nombre");
const email = document.querySelector("#email");
const mensaje = document.querySelector("#mensaje");
const formulario = document.querySelector(".formulario");

nombre.addEventListener("input", leerTexto);
email.addEventListener("input", leerTexto);
mensaje.addEventListener("input", leerTexto);

//El Evento de Submit
formulario.addEventListener("submit", function(evento){
    evento.preventDefault();
    const {nombre,email,mensaje} = datos;
    //Validar formulario
    if(nombre === "" || email === "" || mensaje === ""){
        mostrarAlerta("Todos los campos son obligatorios", true);
        return;
    }

    //Crear la alaerta de enviar correctamente al formulario
    mostrarAlerta("Mensaje enviando correctamente")
})

function leerTexto(evento){
    datos[evento.target.id] = evento.target.value;
}

function mostrarAlerta(mensaje, error = false){
    const alerta = document.createElement("P");
    alerta.textContent = mensaje;

    if(error){
        alerta.classList.add("error");
    }else{
        alerta.classList.add("correcto");
    }
    formulario.appendChild(alerta);
    setTimeout(() => {
        alerta.remove();
    }, 5000);
}