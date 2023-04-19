//Funciones que retornan valores
function sumar(n1,n2){
    return n1 + n2;
};
const resultado = sumar(2,3);
console.log(resultado);

let total = 0;
function agregarCarrito(precio){
    return total += precio;
};

total = agregarCarrito(200);
total = agregarCarrito(1000);
console.log(total)

function calcularImpuesto(total){
    return 1.15 * total;
}
const totalaPagar= calcularImpuesto(total);
console.log(`El total a pagar es: ${totalaPagar}`);