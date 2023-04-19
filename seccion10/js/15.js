//Arrays Methods
const meses = ["Enero","Febrero", "Marzo", "Abril", "Mayo"];

const carrito = [
    {nombre:"Monitor 30 Pulgadas", precio:500},
    {nombre:"Television 30 Pulgadas", precio:700},
    {nombre:"Tablet", precio:600},
    {nombre:"Audifonos", precio:50},
    {nombre:"Teclado", precio:400},
    {nombre:"Celular", precio:1200},
];

//forEach
meses.forEach(function(meses){
    if(meses == "Marzo"){
        console.log("Marzo si existe");
    }
});

//Includes
let resultado = meses.includes("Marzo");

//Sone ideal para arreglo de objetos
resultado = carrito.some(function(producto){
    return producto.nombre == "celular";
});

//Reduce
resultado = carrito.reduce(function(total,producto){
    return total + producto.precio;
},0);

//Filter
resultado = carrito.filter(function(producto){
    return producto.precio > 400 
})
console.log(resultado);