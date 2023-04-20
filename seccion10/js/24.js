//For Loop
for(let i = 0; i < 3; i++){
    console.log(i);
};

for(let i = 0; i < 10; i++){
    if(i % 2 === 0){
        console.log(`El número ${i} es par`);
    }else{
        console.log(`El número ${i} es impar`);
    };
};

const carrito = [
    {nombre:"Monitor 30 Pulgadas", precio:500},
    {nombre:"Television 30 Pulgadas", precio:700},
    {nombre:"Tablet", precio:600},
    {nombre:"Audifonos", precio:50},
    {nombre:"Teclado", precio:400},
    {nombre:"Celular", precio:1200},
];
for(let i = 0; i < carrito.length; i++){
    console.log(carrito[i].nombre);
};

//While Loop
let i = 0;
while(i < 10){
    console.log(i);
    i++;
};

i = 0;
while(i < 10){
    if(i % 2 === 0){
        console.log(`El número ${i} es par`);
    }else{
        console.log(`El número ${i} es impar`);
    };
    i++;
};

i = 0;
while(i < carrito.length){
    console.log(carrito[i].nombre);
    i++;
};

//Do While Loop
i = 0;
do{
    console.log(i);
    i++;
}while(i < 10);