const carrito = [
    {nombre:"Monitor 30 Pulgadas", precio:500},
    {nombre:"Television 30 Pulgadas", precio:700},
    {nombre:"Tablet", precio:600},
    {nombre:"Audifonos", precio:50},
    {nombre:"Teclado", precio:400},
    {nombre:"Celular", precio:1200},
];

//forEach
carrito.forEach(producto => console.log(producto.nombre));

//map
const arreglo2 = carrito.map(producto => `${producto.nombre} - ${producto.precio}`);
console.log(arreglo2);
console.log(arreglo2[1]);