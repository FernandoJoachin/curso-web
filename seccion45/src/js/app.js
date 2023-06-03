let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
};

document.addEventListener("DOMContentLoaded", function(){
    iniciarApp();
})

function iniciarApp(){
    mostrarSeccion();
    tabs();  //Cambia la seccion dependiendo del tab en los botones
    btnsPaginador();//Agrega o quita btn del paginador
    paginaSiguiente();
    paginaAnterior();
    consultarApi(); //Consulta la API en el backend de PHP
}

function mostrarSeccion(){
    //Oculta la seccion que tenga la clase de mostrar
    const seccionAnterior = document.querySelector(".mostrar");
    const tabAnterior =  document.querySelector(".actual");
    
    if(seccionAnterior){
        seccionAnterior.classList.remove("mostrar");
    }
    if(tabAnterior){
        tabAnterior.classList.remove("actual");
    }

    //Selecciona la seccion con el paso
    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add("mostrar");

    //Resalta el boton
    const tab =  document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
}

function tabs(){
    const btns = document.querySelectorAll(".tabs button");
    btns.forEach(btn => {
        btn.addEventListener("click", function(e){
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            btnsPaginador();
        });
    })
}

function btnsPaginador(){
    const paginadorSiguiente = document.querySelector("#siguiente");
    const paginadorAnterior = document.querySelector("#anterior");

    if(paso === 1){
        paginadorAnterior.classList.add("ocultar");
        paginadorSiguiente.classList.remove("ocultar");
    }else if(paso ===2){
        paginadorSiguiente.classList.remove("ocultar");
        paginadorAnterior.classList.remove("ocultar");
    }else if(paso === 3){
        paginadorAnterior.classList.remove("ocultar");
        paginadorSiguiente.classList.add("ocultar");
    }

    mostrarSeccion();
}

function paginaSiguiente(){
    const paginadorSiguiente = document.querySelector("#siguiente");
    paginadorSiguiente.addEventListener("click",function(){
        if(paso >= pasoFinal){
            return;
        }
        paso++;
        btnsPaginador();
    })
}

function paginaAnterior(){
    const paginadorAnterior = document.querySelector("#anterior");
    paginadorAnterior.addEventListener("click",function(){
        if(paso <= pasoInicial){
            return;
        }
        paso--;
        btnsPaginador();
    })
}

async function consultarApi(){
    try{
        const url = "http://localhost:3000/api/servicios";
        const resultado = await fetch(url); // Await- Pausa la ejecución de la función y permite que otras tareas se ejecuten en paralelo
        const servicios = await resultado.json();
        mostrarServicios(servicios);
    }catch(e){
        console.log(e);
    }
}

function mostrarServicios(servicios){
    servicios.forEach(servicio => {
        const {id,nombre,precio} = servicio;

        const nombreServicio = document.createElement("P");
        nombreServicio.classList.add("nombre-servicio");
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement("P");
        precioServicio.classList.add("precio-servicio");
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement("DIV");
        servicioDiv.classList.add("servicio");
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio)
        };

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);
        document.querySelector("#servicios").appendChild(servicioDiv);
    })
}

function seleccionarServicio(servicio){
    const{id} = servicio;
    const{servicios} = cita;
    //Identificar al elemento que se le dio click
    const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);

    //Comprobar si un servicio esta agregado
    if(servicios.some(agregado => agregado.id === id)){
        //Elimina el servicio
        cita.servicios = servicios.filter(agregado => agregado.id != id);
        divServicio.classList.remove("seleccionado");
    }else{
        cita.servicios = [...servicios,servicio];
        divServicio.classList.add("seleccionado");
    }

   
}