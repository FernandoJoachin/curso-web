//Fetch API
async function obtenerEmpleados(){
    const archivos = "empleados.json";

    //Primera forma de hacerlo
    /* 
    fetch(archivos)
    .then(resultado => resultado.json())
    .then(datos => {
        const {empleados} = datos; 
        //console.log(empleados);

        empleados.forEach(empleados => {
            console.log(empleados.id);
            console.log(empleados.nombre);
            console.log(empleados.puesto);
            //document.querySelector(".contenido").textContent += empleados.nombre; - Imprimir los valores en pantalla
        });
    })
    */

    //Segunda forma de hacerlo
    const resultado = await fetch(archivos);
    const datos = await resultado.json();
    console.log(datos);
};
obtenerEmpleados();