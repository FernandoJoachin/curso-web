//Arreglos o Arrays
const numeros = [10,20,30,40];
console.table(numeros);

const meses = new Array("Enero","Febrero", "Marzo", "Abril", "Mayo");
console.table(meses);

const arreglo = ["Hola", 10, true, null, {nombre:"Fernando", trabajo:"Desarrollador-Web"}, [1,2,3]];
console.table(arreglo);

//Aceder a los valores de un arreglo
console.log(numeros[3]);

numeros.forEach(function(numeros){
    console.log(numeros);
});

//Conocer la extension de un arreglo
console.log(meses.length);

//Agregar elementos a un arreglo
numeros.push(50,60,70); //Agrega al final del arreglo
numeros.unshift(-10,-20,-30); //Agrega al inicio del arreglo

//Eliminar elementos de un arreglos
numeros.pop(); //Elimina el ultimo elemento del arreglo
numeros.shift(); //Elimina el primer elemento del arreglo
meses.splice(2,1); //Primer valor es el indice del elemento, el segunda valor es cuantos elementos apartir de ahi se van a eliminar

//Rest Operator o Spread Operator
const nuevoArreglo = [...meses,"Junio"];
console.table(nuevoArreglo);