(function(){
    const inputPonente = document.querySelector("#ponentes");
    if(inputPonente){
        let ponentes = [];
        let ponentesFiltrados = [];

        const listadoPonentes = document.querySelector("#listado-ponentes");
        const ponenteHidden = document.querySelector('[name="ponente_id"]');
       
        obtenerPonentes();
        inputPonente.addEventListener("input", buscarPonentes);

        if(ponenteHidden.value){
            (async()=>{
                const ponente = await obtenerPonente(ponenteHidden.value);
                const {nombre,apellido} = ponente;

                const ponenteDOM = document.createElement("LI");
                ponenteDOM.classList.add("listado-ponentes__ponente", "listado-ponentes__ponente--seleccionado");
                ponenteDOM.textContent = `${nombre} ${apellido}`;
                listadoPonentes.appendChild(ponenteDOM);
            })();
        }

        async function obtenerPonentes(){
            const url = "/api/ponentes";
    
            try{
                const respuesta = await fetch(url);
                const resultado = await respuesta.json();
                formatearPonentes(resultado);
            }catch(e){
                console.log(e);
            }
        }

        async function obtenerPonente(id){
            const url = `/api/ponente?id=${id}`;
    
            try{
                const respuesta = await fetch(url);
                const resultado = await respuesta.json();
                return resultado;
            }catch(e){
                console.log(e);
            }
        }

        function formatearPonentes(ponentesArray = []){
            ponentes = ponentesArray.map(ponente => {
                return {
                    nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`,
                    id: ponente.id
                }
            })
        }

        function buscarPonentes(e){
            const busqueda = e.target.value;
            if(busqueda.length > 3){
                const expresion = new RegExp(busqueda, "i"); //Expresión regular donde no importa las mayúsculas o minúsculas
                ponentesFiltrados = ponentes.filter(ponente => {
                    if(ponente.nombre.toLowerCase().search(expresion) != -1){
                        return ponente;
                    }
                })
            }else{
                ponentesFiltrados = [];
            }
            mostrarPonentes();
        }

        function mostrarPonentes(){
            while(listadoPonentes.firstChild){
                listadoPonentes.removeChild(listadoPonentes.firstChild);
            }

            if(ponentesFiltrados.length > 0){
                ponentesFiltrados.forEach(ponente =>{
                    const ponenteHTML = document.createElement("LI");
                    ponenteHTML.classList.add("listado-ponentes__ponente");
                    ponenteHTML.textContent = ponente.nombre;
                    ponenteHTML.dataset.ponenteId = ponente.id;
                    ponenteHTML.onclick = seleccionarPonente;
    
                    //Añadir al DOM
                    listadoPonentes.appendChild(ponenteHTML);
                })
            }else{
                const noResultados = document.createElement("P");
                noResultados.classList.add("listado-ponentes__no-resultado");
                noResultados.textContent = "No hubo resultados para tu búsqueda";
                listadoPonentes.appendChild(noResultados);
            }
        }

        function seleccionarPonente(e){
            const ponente = e.target;

            const ponentePrevio = document.querySelector(".listado-ponentes__ponente--seleccionado");
            if(ponentePrevio){
                ponentePrevio.classList.remove("listado-ponentes__ponente--seleccionado");
            }

            ponente.classList.add("listado-ponentes__ponente--seleccionado");
            ponenteHidden.value = ponente.dataset.ponenteId;
        }
    }
})();