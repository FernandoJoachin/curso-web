//Programación Orientada a Objeto o POO

//Object Literal
const producto = {
    nombre : "Tablet",
    precio : 500
}

//Object Constructor
function Cliente(nombre, apellido){
    this.nombre = nombre,
    this.apellido = apellido
};

function Producto(nombre, precio, disponible){
    this.nombre = nombre,
    this.precio = precio,
    this.disponible = disponible
};

//Prototypes
//Crea funciones que solo se utilizan en un objeto en específico
Cliente.prototype.formatearCliente = function (){
    return `El cliente es ${this.nombre} ${this.apellido}`
}
Producto.prototype.formatearProducto = function (){
    return `El producto es ${this.nombre} tiene un precio de: $${this.precio}`
}

const producto2 = new Producto("Televisor", 1000, false);
console.log(producto2);
const producto3 = new Producto("Celular", 900, true);
const cliente1 = new Cliente("Fer", "Joachin");
console.log(cliente1);

console.log(producto2.formatearProducto());
console.log(producto3.formatearProducto());
console.log(cliente1.formatearCliente());