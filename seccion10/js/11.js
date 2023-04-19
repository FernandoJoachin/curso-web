//Objeto
const producto = {
    nombreProducto : "Monitor 20 Pulgadas",
    precio : 300,
    disponible : true
};

//Forma anterior
const precioProducto = producto.precio;
const nombre_producto = producto.nombreProducto;
console.log(precioProducto);
console.log(nombre_producto);

//Destructuring
const {precio, nombreProducto} = producto;
console.log(precio);
console.log(nombreProducto);