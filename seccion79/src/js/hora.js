(function(){
    const horas = document.querySelector("#horas");

    if(horas){

        const categoria = document.querySelector('[name="categoria_id"]');
        categoria.addEventListener("change", terminoBusqueda);
        const dias = document.querySelectorAll('[name="dia"]');
        dias.forEach(dia => dia.addEventListener("change", terminoBusqueda));

        const inputHiddenDia = document.querySelector('[name="dia_id"]');
        const inputHiddenHora = document.querySelector('[name="hora_id"]');

        let busqueda = {
            categoria_id: +categoria.value || "",
            dia: +inputHiddenDia.value || ""
        };

        if(!Object.values(busqueda).includes("")){
            (async()=>{
                await  buscarEventos();
                const id = inputHiddenHora.value;
                const horaSeleccionada = document.querySelector(`[data-hora-id="${id}"]`);
                horaSeleccionada.classList.remove("horas__hora--desactivada");
                horaSeleccionada.classList.add("horas__hora--seleccionada");
                horaSeleccionada.onclick = seleccionarHora;
            })();
        }

        function terminoBusqueda(e){
            //Reiniciar los campos ocultos y el selector de horas
            inputHiddenHora.value = "";
            inputHiddenDia.value = "";
            const horaPrevia = document.querySelector(".horas__hora--seleccionada");
            if(horaPrevia){
                horaPrevia.classList.remove("horas__hora--seleccionada");
            }

            busqueda[e.target.name] = e.target.value;
            if(Object.values(busqueda).includes("")){
                return;
            }
            buscarEventos();
        }

        async function buscarEventos(){
            const {categoria_id, dia} = busqueda;
            const url = `/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;

            try{
                const resultado = await fetch(url);
                const eventos = await resultado.json();
                obtenerHorasDisponibles(eventos);
            }catch(e){
                console.log(e);
            }
        }

        function obtenerHorasDisponibles(eventos){
            //Reiniciar las horas
            const listadoHora = document.querySelectorAll("#horas li");
            listadoHora.forEach(li => li.classList.add("horas__hora--desactivada"));

            //Comprobar eventos ya tomados, y quitar la variable de desactivada
            const horasTomadas = eventos.map(evento => evento.hora_id);

            const listadoHoraArray = Array.from(listadoHora);

            const resultado = listadoHoraArray.filter(li => !horasTomadas.includes(li.dataset.horaId))
            resultado.forEach(li => li.classList.remove("horas__hora--desactivada"));

            const horasDisponnibles = document.querySelectorAll("#horas li:not(.horas__hora--desactivada)");
            horasDisponnibles.forEach(horaDisponible => horaDisponible.addEventListener("click", seleccionarHora));
        }

        function seleccionarHora(e){
            //Desactiva la hora previa, si hay un nuevo click
            const horaPrevia = document.querySelector(".horas__hora--seleccionada");
            if(horaPrevia){
                horaPrevia.classList.remove("horas__hora--seleccionada");
            }
            //Agregar clase de seleccionado
            e.target.classList.add("horas__hora--seleccionada");
            inputHiddenHora.value = e.target.dataset.horaId;

            //Llenar el campo oculto de dia
            inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
        }

    }
})();