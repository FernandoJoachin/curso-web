/**IFFE */
(function(){
    obtenerTareas();
    let tareas = [];

    //Boton para mostrar el Modal de agregar tarea
    const btnNuevaTarea = document.querySelector("#agregar-tarea");
    btnNuevaTarea.addEventListener("click", mostrarFormulario);

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
        limpiarTareas()
        if(tareas.length === 0){
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

        tareas.forEach(tarea =>{
            const contenedorTarea = document.createElement("LI");
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add("tarea");

            const nombreTarea = document.createElement("P");
            nombreTarea.textContent = tarea.nombre;
            
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

            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            contenedorTarea.appendChild(nombreTarea);
            contenedorTarea.appendChild(opcionesDiv);
            
            const listadoTareas = document.querySelector("#listado-tareas");
            listadoTareas.appendChild(contenedorTarea);
        })
    }
    
    function mostrarFormulario(){
        const modal = document.createElement("DIV");
        modal.classList.add("modal");
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Añade una nueva tarea</legend>
                <div class="campo">
                    <label for="proyecto">Nombre Proyecto</label>
                    <input type="text" name="tarea" id="tarea" placeholder="Añadir una tarea al proyecto actual"/>
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="Añadir nueva tarea"/>
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
                submitFormNuevaTarea();
            }
        })

        document.querySelector(".dashboard").appendChild(modal);
    }

    function submitFormNuevaTarea(){
        const tarea = document.querySelector("#tarea").value.trim();
        if(tarea === ""){
            //Mostrar una alerta de error
            mostrarAlerta("El nombre de la tarea es obligatorio", "error", document.querySelector(".formulario legend"))
            return
        }
        agregarTarea(tarea);
    }

    async function agregarTarea(tarea){
        //Construir la petición
        const datos = new FormData();
        datos.append("nombre", tarea);
        datos.append("url", obtenerProyecto())

        try{
            const url = "http://localhost:3000/api/tarea";
            const respuesta = await fetch(url, {method: "POST", body: datos});
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
            const url = "http://localhost:3000/api/tarea/actualizar";

            const respuesta = await fetch(url, {method: "POST", body: datos});
            const resultado = await respuesta.json();
            console.log(resultado);
            if(resultado.respuesta.tipo === "exito"){
                mostrarAlerta(resultado.respuesta.mensaje, resultado.respuesta.tipo, document.querySelector(".contenedor-nueva-tarea"));
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
