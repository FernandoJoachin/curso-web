/**IFFE */
(function(){
    obtenerTareas();
    let tareas = [];
    let filtradas = [];

    //Boton para mostrar el Modal de agregar tarea
    const btnNuevaTarea = document.querySelector("#agregar-tarea");
    btnNuevaTarea.addEventListener("click", function(){
        mostrarFormulario();
    });

    //Filtros de búsqueda
    const filtros = document.querySelectorAll("#filtros input[type='radio']");
    filtros.forEach(radio => {
        radio.addEventListener("input", filtrarTareas);
    })

    function filtrarTareas(e){
        const valueFiltro = e.target.value;
        if(valueFiltro !== ""){
            filtradas = tareas.filter(tarea => tarea.estado === valueFiltro);
        }else{
            filtradas = [];
        }
        mostrarTareas();
    }

    async function obtenerTareas(){
        try{
            const id = obtenerProyecto();
            const url = `/api/tareas?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            tareas = resultado.tareas;
            mostrarTareas();
        }catch(error){
            console.log(error);
        }
    }

    function mostrarTareas(){
        limpiarTareas();
        totalPendientes();
        totalCompletadas();

        const argsTareas = filtradas.length ? filtradas : tareas;
        if(argsTareas === 0){
            const contenedorTareas = document.querySelector("#listado-tareas");

            const textoNoTareas = document.createElement("LI");
            textoNoTareas.textContent = "No hay tareas";
            textoNoTareas.classList.add("no-tareas");
            contenedorTareas.appendChild(textoNoTareas);
            return;
        }

        const estados = {
            0: "Pendiente",
            1: "Completa"
        }

        argsTareas.forEach(tarea =>{
            const contenedorTarea = document.createElement("LI");
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add("tarea");

            const nombreTarea = document.createElement("P");
            nombreTarea.textContent = tarea.nombre;
            nombreTarea.ondblclick = function() {
                mostrarFormulario(true, {...tarea});
            }
            
            const opcionesDiv = document.createElement("DIV");
            opcionesDiv.classList.add("opciones");

            const btnEstadoTarea = document.createElement("BUTTON");
            btnEstadoTarea.classList.add("estado-tarea");
            btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
            btnEstadoTarea.textContent = estados[tarea.estado];
            btnEstadoTarea.dataset.estadoTarea = tarea.estado;
            btnEstadoTarea.ondblclick = function() {
                cambiarEstadoTarea({...tarea});
            }

            const btnEliminarTarea = document.createElement("BUTTON");
            btnEliminarTarea.classList.add("eliminar-tarea");
            btnEliminarTarea.textContent = "Eliminar";
            btnEliminarTarea.dataset.idTarea = tarea.id;
            btnEliminarTarea.ondblclick = function() {
                confirmarEliminarTarea({...tarea});
            }

            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);
            
            const listadoTareas = document.querySelector("#listado-tareas");
            listadoTareas.appendChild(contenedorTarea);
        })
    }

    function totalPendientes(){
        const totalPendientes = tareas.filter(tarea => tarea.estado === "0");
        const pendienteRadio = document.querySelector("#pendientes");

        if(totalPendientes.length === 0){
            pendienteRadio.disabled = true;
        }else{
            pendienteRadio.disabled = false;
        }
    }

    function totalCompletadas(){
        const totalCompletadas = tareas.filter(tarea => tarea.estado === "1");
        const completasRadio = document.querySelector("#completadas");

        if(totalCompletadas.length === 0){
            completasRadio.disabled = true;
        }else{
            completasRadio.disabled = false;
        }
    }
    
    function mostrarFormulario(editar = false, tarea = {}){
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>${editar ? "Editar tarea" : "Añade una nueva tarea"}</legend>
                <div class="campo">
                    <label for="proyecto">Nombre Proyecto</label>
                    <input type="text" name="tarea" id="tarea" placeholder="${editar ? "Editar tarea" : "Añadir una tarea al proyecto actual"}" value="${tarea.nombre ? tarea.nombre : ""}"/>
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="${editar ? "Guardar cambios" : "Añadir nueva tarea"}"/>
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;

        setTimeout(() => {
            const formulario = document.querySelector(".formulario");
            formulario.classList.add("animar");
        },0)

        modal.addEventListener("click", function(e){
            e.preventDefault();
            if(e.target.classList.contains("cerrar-modal")){
                const formulario = document.querySelector(".formulario");
                formulario.classList.add("cerrar");
                setTimeout(() => {
                    modal.remove();
                },500)
            }

            if(e.target.classList.contains("submit-nueva-tarea")){
                const nombreTarea = document.querySelector("#tarea").value.trim();
                if(nombreTarea === ""){
                    //Mostrar una alerta de error
                    mostrarAlerta("El nombre de la tarea es obligatorio", "error", document.querySelector(".formulario legend"))
                    return
                }
                if(editar){
                    tarea.nombre = nombreTarea;
                    actualizarTarea(tarea);
                }else{
                    agregarTarea(nombreTarea);
                }
            }
        })

        document.querySelector(".dashboard").appendChild(modal);
    }

    async function agregarTarea(tarea){
        //Construir la petición
        const datos = new FormData();
        datos.append("nombre", tarea);
        datos.append("url", obtenerProyecto())

        try{
            const url = "/api/tarea";
            const respuesta = await fetch(url, {method: "POST", body: datos});
            console.log(respuesta);
            const resultado = await respuesta.json();

            mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector(".formulario legend"))
            
            if(resultado.tipo === "exito"){
                const modal = document.querySelector(".modal");
                setTimeout(() => {
                    modal.remove();
                }, 3000);

                //Agregar el objeto de tarea al global de tareas
                const tareaObj = {
                    id: String(resultado.id),
                    nombre: tarea,
                    estado: "0",
                    proyecto_id: resultado.proyecto_id
                }
                tareas = [...tareas, tareaObj];
                mostrarTareas();
            }
        }catch(error){
            console.log(error);
        }
    }

    function cambiarEstadoTarea(tarea) {
        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;
        actualizarTarea(tarea);
    }

    async function actualizarTarea(tarea){
        const {estado, id, nombre} = tarea;
        const datos = new FormData();
        datos.append("id", id);
        datos.append("nombre", nombre);
        datos.append("estado", estado);
        datos.append("url", obtenerProyecto());
        
        try {
            const url = "/api/tarea/actualizar";

            const respuesta = await fetch(url, {method: "POST", body: datos});
            const resultado = await respuesta.json();

            if(resultado.respuesta.tipo === "exito"){
                //mostrarAlerta(resultado.respuesta.mensaje, resultado.respuesta.tipo, document.querySelector(".contenedor-nueva-tarea"));
                Swal.fire(resultado.respuesta.mensaje, resultado.respuesta.mensaje, "success");
                const modal = document.querySelector(".modal");
                if(modal){
                    modal.remove();
                }
                
                tareas = tareas.map(tareaMemoria => {
                    if(tareaMemoria.id === id) {
                        tareaMemoria.estado = estado;
                        tareaMemoria.nombre = nombre;
                    } 
                    return tareaMemoria;
                });
                mostrarTareas();
                console.log(tareas);
            }
        } catch (error) {
            console.log(error);
        }
    } 

    function confirmarEliminarTarea(tarea){
        //Codigo sacado de SweetAlert2
        Swal.fire({
            title: '¿Eliminar tarea?',
            showCancelButton: true,
            confirmButtonText: 'Si',
            cancelButtonText : "No",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              eliminarTarea(tarea);
            }
        })
    }

    async function eliminarTarea(tarea){
        const datos = new FormData();
        try{
            const {estado, id, nombre} = tarea;
            const datos = new FormData();
            datos.append("id", id);
            datos.append("nombre", nombre);
            datos.append("estado", estado);
            datos.append("url", obtenerProyecto());

            const url = "/api/tarea/eliminar";

            const respuesta = await fetch(url, {method: "POST", body: datos});
            const resultado = await respuesta.json();
            if(resultado.resultado){
                //mostrarAlerta(resultado.mensaje, resultado.tipo, document.querySelector(".contenedor-nueva-tarea"))
                Swal.fire("Eliminado", resultado.mensaje, "success");
                tareas = tareas.filter(tareaMemoria => tareaMemoria.id !== tarea.id);
                mostrarTareas();
            }

        }catch(e){
            consol.log(e);
        }
    }

    function obtenerProyecto(){
        const proyectoParams = new URLSearchParams(window.location.search) //Obtiene de la ruta el token(url) del proyecto
        /**Imprimir URLSearchParams */
        const proyecto = Object.fromEntries(proyectoParams.entries());
        return proyecto.id //Retorna la url
    }

    function limpiarTareas() {
        const listadoTareas = document.querySelector('#listado-tareas');
        
        while(listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }

    function mostrarAlerta(mensaje,tipoAlerta, referencia){
        //Evita que se genere múltiples alertas
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
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);
    
        //Elimina la alerta
        setTimeout(() => {
            alerta.remove()
        },5000)
    }
})();
