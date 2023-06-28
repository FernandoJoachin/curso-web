import Swal from "sweetalert2";
(function (){
    const resumen = document.querySelector("#registro-resumen");
    let eventos = [];

    if(resumen){
        const eventosBtn = document.querySelectorAll(".evento__agregar");
        eventosBtn.forEach(boton => boton.addEventListener("click", seleccionarEvento));
        
        const formularioRegistro = document.querySelector("#registro");
        formularioRegistro.addEventListener("submit", submitFormulario);

        mostrarEventos();

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
            }else{
                const noRegistro = document.createElement("P");
                noRegistro.textContent = "No hay eventos, añade hasta 5 del lazo izquierdo";
                noRegistro.classList.add("registro__texto");
                resumen.appendChild(noRegistro);
            }
        }
    
        function eliminarEvento(id){
            eventos = eventos.filter(evento => evento.id !== id);
            const agregarBtn = document.querySelector(`[data-id="${id}"]`);
            agregarBtn.disabled = false;
            mostrarEventos();
        }

        async function submitFormulario(e){
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

            const url = "/finalizar-registro/conferencias";
            const datos = new FormData();
            datos.append("eventos", evento_id);
            datos.append("regalo_id", regalo_id);
            
            try {
                const respuesta = await fetch(url, {
                    method: "POST",
                    body: datos
                });
                const resultado = await respuesta.json();
                if(resultado.resultado){
                    Swal.fire({
                        title: "Registro Exitoso",
                        text: "Tus conferencias se han almacenado y tu registro fue exitoso, te esperamos en DevWebcamp",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => location.href = `/boleto?id=${resultado.token}`)
                }else{
                    Swal.fire({
                        title: "Error",
                        text: "Hubo un error",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(() => location.reload())
                }
            } catch (error) {
                console.log(error);
            }
        }
    
        function limpiarEventos(){
            while(resumen.firstChild){
                resumen.removeChild(resumen.firstChild);
            }
        }
    }
})();