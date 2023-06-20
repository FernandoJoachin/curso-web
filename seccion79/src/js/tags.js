(function(){
    const tagsInput = document.querySelector("#tags_input");
    if(tagsInput){
        const tagsDIV = document.querySelector("#tags");
        const tagsInputHidden = document.querySelector("[name=tags]");
        let tags = [];

        //Escuchar por los cambios en el input
        tagsInput.addEventListener("keypress", guardarTag);

        function guardarTag(e){
            //El 44 hace referencia a la coma
            if(e.keyCode === 44){
                if(e.target.value.trim() === "" || e.target.value < 1){
                    return;
                }

                e.preventDefault();
                tags = [...tags, e.target.value.trim()];
                tagsInput.value = "";
                console.log(tags)
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