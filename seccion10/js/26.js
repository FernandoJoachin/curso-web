//This
const reservacion = {
    nombre : "Fernando",
    apellido : "Joachin",
    total : 5000,
    pagado: false,
    informacion : function(){
        console.log(`El cliente ${this.nombre} reservó y su cantidad a pagar es de ${this.total}`)
    }
};

window.nombre = "Pedro"
const reservacion2 = {
    nombre : "Pedro",
    apellido : "Joachin",
    total : 5000,
    pagado: false,
    informacion :() => console.log(`El cliente ${this.nombre} reservó y su cantidad a pagar es de ${this.total}`)
    
};

reservacion.informacion();
reservacion2.informacion();