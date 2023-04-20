//Arrow Functions
const sumar2 = (n1,n2) => console.log(n1 + n2);;
sumar2(7,23);

const aprendiendo = tecnologia => console.log(`Aprendiendo ${tecnologia}`);
aprendiendo("Javascript");


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
meses.forEach(meses => {
    if(meses == "Marzo"){
        console.log("Marzo si existe");
    }
});

//Sone ideal para arreglo de objetos
resultado = carrito.some(producto => producto.nombre == "Celular");

//Reduce
resultado = carrito.reduce((total,producto) => total + producto.precio,0);

//Filter
resultado = carrito.filter(producto => producto.precio > 400);
console.log(resultado);