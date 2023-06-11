/**IFFE */
(function(){
    //Boton para mostrar el Modal de agregar tarea
    const btnNuevaTarea = document.querySelector("#agregar-tarea");
    btnNuevaTarea.addEventListener("click", mostrarFormulario);
    
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

    function agregarTarea(tarea){}

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
