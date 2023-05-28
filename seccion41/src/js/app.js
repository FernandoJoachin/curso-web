document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
})

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu")
    console.log("seleccionando");
    mobileMenu.addEventListener("click", navegacionResponsive);

    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto));
}

function mostrarMetodosContacto(evento){
    const contactoDiv = document.querySelector("#contacto");
    console.log(evento.target.value);
    if(evento.target.value === "teléfono"){
        contactoDiv.innerHTML = `
        <label for="telefono">Teléfono</label>
        <input id="telefono" name="contacto[telefono]" type="tel" placeholder="Tu Teléfono">

        <p>Elija la fecha y la hora para la llamada</p>
        <label for="fecha">Fecha:</label>
        <input id="fecha" name="contacto[fecha]" type="date">
        <label for="hora">Hora:</label>
        <input id="hora" name="contacto[hora]" type="time" min="10:00" max="19:00">
        `;
    }else{
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input id="email" name="contacto[email]" type="email" placeholder="Tu Email" required>
        `;
    }
}

function navegacionResponsive(){
    const navegacion = document.querySelector(".navegacion");
    navegacion.classList.toggle("mostrar");
    //toggle sirve para hacer lo siguiente:
    // if(navegacion.classList.contains("mostrar")){
    //     navegacion.classList.remove("mostrar");
    // }else{
    //     navegacion.classList.add("mostrar");
    // }
}

function darkMode(){
    const preferenciaDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
    if(preferenciaDarkMode.matches){
        document.body.classList.add("dark-mode");
    }else{
        document.body.classList.remove("dark-mode");
    }
    
    preferenciaDarkMode.addEventListener("change", function(){
        if(preferenciaDarkMode.matches){
            document.body.classList.add("dark-mode");
        }else{
            document.body.classList.remove("dark-mode");
        }
    })

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener("click", function(){
        document.body.classList.toggle("dark-mode");
    })
}