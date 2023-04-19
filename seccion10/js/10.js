//Objetos
const nombreProducto = "Monitor HD";
const precio = 300;
const disponible = true;

const producto = {
    nombreProducto : "Monitor HD",
    precio : 300,
    disponible : true
};

console.log(producto.nombreProducto);
console.log(producto["precio"]);

//Agregar nuevas propiedades al objeto
producto.img = "imagen.jpg"

//Eliminar propiedades
delete producto.disponible;
console.log(producto);