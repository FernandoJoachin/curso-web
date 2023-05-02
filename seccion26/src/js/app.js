document.addEventListener("DOMContentLoaded", function(){
    eventListeners();
    darkMode();
})

function eventListeners(){
    const mobileMenu = document.querySelector(".mobile-menu")

    mobileMenu.addEventListener("click", navegacionResponsive);
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