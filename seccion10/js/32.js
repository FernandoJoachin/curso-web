// Async / await
function descargarNuevosClientes(){
    return new Promise(resolve => {
        console.log("Descargando clientes... espere...");

        setTimeout(() => {
            resolve("Los clientes fueron descargados");
        }, 5000);
    });
};

function descargarUltimosPedidos(){
    return new Promise(resolve => {
        console.log("Descargando pedidos... espere...");

        setTimeout(() => {
            resolve("Los pedidos fueron descargados");
        }, 3000);
    });
};

async function app(){
    try{
        /* 
        const resultado = await descargarNuevosClientes();
        console.log(resultado);
        console.log("Se bloqueo")
        */
        const resultado = await Promise.all([descargarNuevosClientes(), descargarUltimosPedidos()]);
        console.log(resultado[0]);
        console.log(resultado[1]);
    }catch(error){
        console.log(error);
    }
};

app();
//console.log("No se bloqueo")