//String o cadenas de texto
const producto = "Monitor de 20 Pulgadas";
const producto2 = String("Monitor de 30 Pulgadas");
const producto3 = new String("Monitor de 40 Pulgadas");


console.log(producto);
console.log(typeof producto);
console.log(producto2);
console.log(typeof producto2);
console.log(producto3);
console.log(typeof producto3);

const tweet = "Aprendiendo Javascript con el curso de Desarrollo Web Completo";
const producto4 = "Monitor HD";

//Length - extension del String
console.log(tweet.length)

//IndexOf - encontrar un elemento en un String (retonar la posición)
console.log(tweet.indexOf("Javascript")) //-1 significa que no se encontro

//Includes - encontrar un elemento en un String (retonar true y false)
console.log(tweet.includes("Javascript"))