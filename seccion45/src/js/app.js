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
    tabs();//Cambia la seccion dependiendo del tab en los botones
    btnsPaginador();//Agrega o quita btn del paginador
    paginaSiguiente();
    paginaAnterior();

    consultarApi(); //Consulta la API en el backend de PHP

    nombreClienteCita();//Añade el nombre del cliente al objeto Cita
    fechaCita();//Añade la fecha de la cita al objeto Cita
    horaCita();//Añade la hora de la cita al objeto Cita
    resumenCita()//Muestra el resumen de la cita
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
        resumenCita();
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
    console.log(cita);
}

function nombreClienteCita(){
    const nombre = document.querySelector("#nombre").value;
    cita.nombre = nombre;
}

function fechaCita(){
    const fecha = document.querySelector("#fecha");
    fecha.addEventListener("input", function(e){
        const dia = new Date(e.target.value).getUTCDay();
        if([0,6].includes(dia)){
            e.target.value = "";
            mostrarAlerta("Fines de semanas no disponibles","error","#paso-2 p");
        }else{
            cita.fecha = e.target.value;
        }
    });
}

function horaCita(){
    const hora = document.querySelector("#hora");
    hora.addEventListener("input", function(e){
        const horaCita = e.target.value;
        const horaSplit = horaCita.split(":")[0];
        if(horaSplit < 10 || horaSplit > 20){
            e.target.value = "";
            mostrarAlerta("Hora no válida","error","#paso-2 p");
        }else{
            cita.hora = e.target.value;
        }
    });
}

function resumenCita(){
    const resumen = document.querySelector(".contenido-resumen");
    //Limpiar el contenido de resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes("") || cita.servicios.length === 0){ //Object.values() Itera sobre el objeto
        mostrarAlerta("Faltan datos de servicios, fecha o hora de la cita","error",".contenido-resumen", false)
    }else{
        //Formatear el div de resumen
        const {nombre,fecha,hora,servicios} = cita;

        const headingServicio = document.createElement("H3");
        headingServicio.textContent = "Resumen de los servicios"
        resumen.appendChild(headingServicio);

        console.log(servicios);
        servicios.forEach(servicio => {
            const {nombre,precio} = servicio;
            const contenedorServicios = document.createElement("DIV");
            contenedorServicios.classList.add("contenedor-servicio");

            const nombreServicio = document.createElement("P");
            nombreServicio.textContent = nombre;

            const precioCliente = document.createElement("P");
            precioCliente.innerHTML = `<span>Precio:</span> $${precio}`;

            contenedorServicios.appendChild(nombreServicio);
            contenedorServicios.appendChild(precioCliente);
            resumen.appendChild(contenedorServicios);
        })

        const citaServicio = document.createElement("H3");
        citaServicio.textContent = "Resumen de la cita"
        resumen.appendChild(citaServicio);

        const nombreCita = document.createElement("P");
        nombreCita.innerHTML = `<span>Nombre:</span> ${nombre}`;
        resumen.appendChild(nombreCita);

        //Formatear fecha
        const fechaObj = new Date(fecha);
        const dia = fechaObj.getDate()+2;
        const mes = fechaObj.getMonth();
        const year = fechaObj.getFullYear();
        const fechaUTC = new Date(Date.UTC(year,mes,dia));
        const opciones = {weekday:"long", year:"numeric", month:"long", day:"numeric"};
        const fechaFormateada = fechaUTC.toLocaleDateString("es-MX",opciones); // Devuelve una representación de la fecha basada en las convenciones culturales del lugar dado

        const fechaCita = document.createElement("P");
        fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;
        resumen.appendChild(fechaCita);

        const horaCita = document.createElement("P");
        horaCita.innerHTML = `<span>Hora:</span> ${hora}`;
        resumen.appendChild(horaCita);

        //Boton para crear una cita
        const btnReservar = document.createElement("BUTTON");
        btnReservar.classList.add("boton");
        btnReservar.textContent = "Reservar cita";
        btnReservar.onclick = reservarCita;
        resumen.appendChild(btnReservar);


    }
}

function reservarCita(){
    const datos = new FormData() //Para imprimir - console.log([...datos]);
    datos.append("nombre","Juan"); //
}

function mostrarAlerta(mensaje,tipoAlerta, elemento, desaparecer = true){
    const alertaPrevia = document.querySelector(".alerta");
    if(alertaPrevia){
        alertaPrevia.remove();
    }

    //Crea la alerta
    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;
    alerta.classList.add("alerta");
    alerta.classList.add(tipoAlerta);

    //Agrega la alerta
    const referencia = document.querySelector(elemento);
    referencia.appendChild(alerta);

    //Elimina la alerta
    if(desaparecer){
        setTimeout(() => alerta.remove(), 2000);
    }
}