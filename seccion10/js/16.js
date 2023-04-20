//Funciones

//Declaración de funciones
function sumar(){
    console.log(10 + 10);
};
sumar();

//Expresión de la función
const sumar2 = function(){
    console.log(3 + 3);
};
sumar2();

//IIFE
(function(){
    console.log("Esto es una función")
})();

/* NOTA 
Javascript se ejecuta en dos etapas.
La primera es la de creación o registro, en ella se registran las funciones.
La segunda es la de ejecución, en esa se ejecuta el código
*/