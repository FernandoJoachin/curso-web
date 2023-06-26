(function(){
    const tagsInput = document.querySelector("#tags_input");
    if(tagsInput){
        const tagsDIV = document.querySelector("#tags");
        const tagButton = document.querySelector(".formulario__icono-tag");
        const tagsInputHidden = document.querySelector("[name=tags]");
        const listadoTags = document.querySelector("#listado-tags");
        let tags = [];
        let tagsDB = [];
        let tagsDropDown = [];

        obtenerTags();
        tagButton.addEventListener("click", allTags)
        tagsInput.addEventListener("input", buscarTags);

        //Recuperar del input oculto
        if(tagsInputHidden.value !== ""){
            tags = tagsInputHidden.value.split(",");
            mostrarTags();
        }


        //Escuchar por los cambios en el input
        tagsInput.addEventListener("keypress", guardarTag);

        async function obtenerTags(){
            const url = "/api/tags";
    
            try{
                const respuesta = await fetch(url);
                const resultado = await respuesta.json();
                tagsDB = resultado;
            }catch(e){
                console.log(e);
            }
        }

        function buscarTags(e){
            const busqueda = e.target.value;
            if(busqueda.length > 2){
                const expresion = new RegExp(busqueda, "i"); //Expresión regular donde no importa las mayúsculas o minúsculas
                tagsDropDown = tagsDB.filter(tags => {
                    if(tags.nombre.toLowerCase().search(expresion) != -1){
                        return tags;
                    }
                })
            }else{
                tagsDropDown = [];
            }
            mostrarTagsDropDown();
        }

        function allTags(){
            const tagButtonPrevio = document.querySelector(".formulario__icono-tag--allTags");
            if(tagButtonPrevio){
                tagButtonPrevio.classList.remove("formulario__icono-tag--allTags");
                while(listadoTags.firstChild){
                    listadoTags.removeChild(listadoTags.firstChild);
                }
                return;
            }
            tagButton.classList.add("formulario__icono-tag--allTags");
            tagsDropDown = tagsDB;
            mostrarTagsDropDown();
        }
        
        function mostrarTagsDropDown(){
            while(listadoTags.firstChild){
                listadoTags.removeChild(listadoTags.firstChild);
            }

            if(tagsDropDown.length > 0){
                tagsDropDown.forEach(tag =>{
                    const tagHTML = document.createElement("LI");
                    tagHTML.classList.add("listado-tags__tag");
                    tagHTML.textContent = tag.nombre;
                    tagHTML.onclick = seleccionarTag;
    
                    //Añadir al DOM
                    listadoTags.appendChild(tagHTML);
                })
            }else{
                const noResultados = document.createElement("P");
                noResultados.classList.add("listado-tags__no-resultado");
                noResultados.textContent = "No hubo resultados para tu búsqueda";
                listadoTags.appendChild(noResultados);
            }
        }

        function seleccionarTag(e){
            const tag = e.target;
            tagsInput.value = tag.textContent + "";
            const eventoComa = new KeyboardEvent("keypress", { key: ",", keyCode: 44 });
            // Disparar el evento en el campo de entrada
            tagsInput.dispatchEvent(eventoComa);

            while(listadoTags.firstChild){
                listadoTags.removeChild(listadoTags.firstChild);
            }
        }

        function guardarTag(e){
            //El 44 hace referencia a la coma
            if(e.keyCode === 44){
                if(e.target.value.trim() === "" || e.target.value < 1){
                    return;
                }

                e.preventDefault();
                tags = [...tags, e.target.value.trim()];
                tagsInput.value = "";
                mostrarTags();
            }
        }

        function mostrarTags(){
            tagsDIV.textContent = "";
            tags.forEach(tag => {
                const etiqueta = document.createElement("LI");
                etiqueta.classList.add("formulario__tag");
                etiqueta.textContent = tag;
                etiqueta.ondblclick = eliminarTag;
                tagsDIV.appendChild(etiqueta);
            });
            actualizarInputHidden();
        }

        function eliminarTag(e){
            e.target.remove();
            tags = tags.filter(tag => tag !== e.target.textContent);
            actualizarInputHidden();
        }

        function actualizarInputHidden(){
            tagsInputHidden.value = tags.toString();
        }
    }
})()