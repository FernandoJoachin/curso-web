"use strict"; //Ejecutar JS en modo estricto
//Objeto
const producto = {
    nombreProducto : "Monitor 20 Pulgadas",
    precio : 300,
    disponible : true
};
//Hace que no se puedan agregar más atributos al objeto
Object.freeze(producto) //No te permite agregar nuevos elementos ni eliminarlos, y tampoco te permite modificarlos 
console.log(Object.isFrozen(producto))

Object.seal(producto) //No te permite agregar nuevos elementos y tampoco eliminarlos, pero si te permite modificarlos
console.log(Object.isSealed(producto))

//producto.img = "imagen.jpg"
console.log(producto);