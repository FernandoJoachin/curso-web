!function(){!async function(){try{const o="/api/tareas?id="+a(),n=await fetch(o),r=await n.json();e=r.tareas,t()}catch(e){console.log(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const n={0:"Pendiente",1:"Completa"};e.forEach(r=>{const c=document.createElement("LI");c.dataset.tareaId=r.id,c.classList.add("tarea");const s=document.createElement("P");s.textContent=r.nombre;const d=document.createElement("DIV");d.classList.add("opciones");const i=document.createElement("BUTTON");i.classList.add("estado-tarea"),i.classList.add(""+n[r.estado].toLowerCase()),i.textContent=n[r.estado],i.dataset.estadoTarea=r.estado,i.ondblclick=function(){!function(n){const r="1"===n.estado?"0":"1";n.estado=r,async function(n){const{estado:r,id:c,nombre:s}=n,d=new FormData;d.append("id",c),d.append("nombre",s),d.append("estado",r),d.append("url",a());try{const a="http://localhost:3000/api/tarea/actualizar",n=await fetch(a,{method:"POST",body:d}),i=await n.json();console.log(i),"exito"===i.respuesta.tipo&&(o(i.respuesta.mensaje,i.respuesta.tipo,document.querySelector(".contenedor-nueva-tarea")),e=e.map(e=>(e.id===c&&(e.estado=r,e.nombre=s),e)),t(),console.log(e))}catch(e){console.log(e)}}(n)}({...r})};const l=document.createElement("BUTTON");l.classList.add("eliminar-tarea"),l.textContent="Eliminar",l.dataset.idTarea=r.id,d.appendChild(i),d.appendChild(l),c.appendChild(s),c.appendChild(d);document.querySelector("#listado-tareas").appendChild(c)})}function a(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}function o(e,t,a){const o=document.querySelector(".alerta");o&&o.remove();const n=document.createElement("DIV");n.textContent=e,n.classList.add("alerta"),n.classList.add(t),a.parentElement.insertBefore(n,a.nextElementSibling),setTimeout(()=>{n.remove()},5e3)}document.querySelector("#agregar-tarea").addEventListener("click",(function(){const n=document.createElement("DIV");n.classList.add("modal"),n.innerHTML='\n            <form class="formulario nueva-tarea">\n                <legend>Añade una nueva tarea</legend>\n                <div class="campo">\n                    <label for="proyecto">Nombre Proyecto</label>\n                    <input type="text" name="tarea" id="tarea" placeholder="Añadir una tarea al proyecto actual"/>\n                </div>\n                <div class="opciones">\n                    <input type="submit" class="submit-nueva-tarea" value="Añadir nueva tarea"/>\n                    <button type="button" class="cerrar-modal">Cancelar</button>\n                </div>\n            </form>\n        ',setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),n.addEventListener("click",(function(r){if(r.preventDefault(),r.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{n.remove()},500)}r.target.classList.contains("submit-nueva-tarea")&&function(){const n=document.querySelector("#tarea").value.trim();if(""===n)return void o("El nombre de la tarea es obligatorio","error",document.querySelector(".formulario legend"));!async function(n){const r=new FormData;r.append("nombre",n),r.append("url",a());try{const a="http://localhost:3000/api/tarea",c=await fetch(a,{method:"POST",body:r}),s=await c.json();if(o(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const a=document.querySelector(".modal");setTimeout(()=>{a.remove()},3e3);const o={id:String(s.id),nombre:n,estado:"0",proyecto_id:s.proyecto_id};e=[...e,o],t()}}catch(e){console.log(e)}}(n)}()})),document.querySelector(".dashboard").appendChild(n)}))}();