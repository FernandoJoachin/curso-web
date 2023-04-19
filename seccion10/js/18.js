//Funciones con parametros y argumentos
function sumar(numero1 = 0,numero2 = 0){ //numero1 y numero2 son parametros
    console.log(numero1 + numero2);
};
sumar(10,10); //Argumentos o valores reales
sumar(7,12);
sumar(1);

//Expresión de la función
const sumar2 = function(n1,n2){
    console.log(n1 + n2);
};
sumar2(3,4);