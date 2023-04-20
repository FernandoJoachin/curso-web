//Métodos de propiedad
const reproductor = {
    reproducir : function(id){
        console.log(`Reproduciendo canción con el ID: ${id}`);
    },

    pausar : function(){
        console.log("Pausando...")
    },

    creandoPlayList : function(nombre){
        console.log(`Creando la playlist: ${nombre}`)
    },

    reproduciendoPlayList : function(nombre){
        console.log(`Reproduciendo la playlist: ${nombre}`)
    }

};

reproductor.borrarCancion = function(id){
    console.log(`Eliminando canción con el ID: ${id}`)
}

reproductor.reproducir(3840);
reproductor.pausar();
reproductor.borrarCancion(20);
reproductor.creandoPlayList("Heavy Metal"); 
reproductor.reproduciendoPlayList("Heavy Metal"); 