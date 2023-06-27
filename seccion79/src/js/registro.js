import Swal from "sweetalert2";
(function (){
    const resumen = document.querySelector("#registro-resumen");
    let eventos = [];

    if(resumen){
        const eventosBtn = document.querySelectorAll(".evento__agregar");
        eventosBtn.forEach(boton => boton.addEventListener("click", seleccionarEvento));
        
        const formularioRegistro = document.querySelector("#registro");
        formularioRegistro.addEventListener("submit", submitFormulario);

        function seleccionarEvento(e){
            if(eventos.length < 5){
                //Deshabilitar el evento
                e.target.disabled = true;
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector(".evento__nombre").textContent.trim()
                }];
                mostrarEventos();
            }else{
                Swal.fire({
                    title: "Error",
                    text: "Máximo 5 eventos por registro",
                    icon: "error",
                    confirmButtonText: "OK"
                })
            }
        }
    
        function mostrarEventos(){
            limpiarEventos();
            if(eventos.length > 0){
                eventos.forEach(evento => {
                    const eventoDOM = document.createElement("DIV");
                    eventoDOM.classList.add("registro__evento");
    
                    const titulo = document.createElement("H3");
                    titulo.classList.add("registro__nombre");
                    titulo.textContent = evento.titulo;
    
                    const eliminarBtn = document.createElement("BUTTON");
                    eliminarBtn.classList.add("registro__eliminar");
                    eliminarBtn.innerHTML = '<i class="fa-solid fa-trash"></i>';
                    eliminarBtn.onclick = function(){
                        eliminarEvento(evento.id);
                    }
    
                    eventoDOM.appendChild(titulo);
                    eventoDOM.appendChild(eliminarBtn);
                    resumen.appendChild(eventoDOM);
                })
            }
        }
    
        function eliminarEvento(id){
            eventos = eventos.filter(evento => evento.id !== id);
            const agregarBtn = document.querySelector(`[data-id="${id}"]`);
            agregarBtn.disabled = false;
            mostrarEventos();
        }

        function submitFormulario(e){
            e.preventDefault();
            
            //Obtener el regalo
            const regalo_id = document.querySelector("#regalo").value;
            const evento_id = eventos.map(evento => evento.id);

            if(evento_id.length === 0 || regalo_id === ""){
                Swal.fire({
                    title: "Error",
                    text: "Elije al menos un evento y un regalo",
                    icon: "error",
                    confirmButtonText: "OK"
                })
                return;
            }
        }
    
        function limpiarEventos(){
            while(resumen.firstChild){
                resumen.removeChild(resumen.firstChild);
            }
        }
    }
})();