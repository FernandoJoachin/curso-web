//Clases
class Producto{
    constructor(nombre, precio, disponible){
        this.nombre = nombre,
        this.precio = precio,
        this.disponible = disponible
    };

    formatearProducto(){
        return `El producto es ${this.nombre} tiene un precio de: $${this.precio}`
    };

    obtenerPrecio(){
        console.log(this.precio);
    };
};

//Herencia
class Libro extends Producto{
    constructor(nombre, precio, isbn){
        super(nombre, precio),
        this.isbn = isbn
    };

    formatearProducto(){
        return `${super.formatearProducto()} y su ISBN es ${this.isbn}`
    };

    obtenerPrecio(){
        super.obtenerPrecio(),
        console.log("Si hay en existencia");
    };
};

const libro = new Libro("Revolución de Javascript", 120, "89219203022134567");

const producto2 = new Producto("Televisor", 1000, false);
const producto3 = new Producto("Celular", 900, true);

console.log(libro.formatearProducto());
libro.obtenerPrecio();
console.log(producto3.formatearProducto());