//Notification API
const boton =  document.querySelector("#boton");
boton.addEventListener("click", function(){
    Notification.requestPermission()
        .then(resultado => console.log(`El resutado es: ${resultado}`))
});

if(Notification.permission === "granted"){
    new Notification("Esta es una notificación",{
        icon : "img/ccj.png",
        body : "Codigo con Fer"
    })
}