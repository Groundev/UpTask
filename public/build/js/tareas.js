!function(){!async function(){try{const a="/api/tareas?id="+r(),o=await fetch(a),n=await o.json();e=n.tareas,t()}catch(e){console.error(e)}}();let e=[];function t(){if(function(){const e=document.querySelector("#listado-tareas");for(;e.firstChild;)e.removeChild(e.firstChild)}(),0===e.length){const e=document.querySelector("#listado-tareas"),t=document.createElement("LI");return t.textContent="No hay Tareas",t.classList.add("no-tareas"),void e.appendChild(t)}const o={0:"Pendiente",1:"Completa"};e.forEach(c=>{const s=document.createElement("LI");s.dataset.tareaId=c.id,s.classList.add("tarea");const i=document.createElement("P");i.textContent=c.nombre,i.ondblclick=function(){a(editar=!0,{...c})};const d=document.createElement("DIV");d.classList.add("opciones");const l=document.createElement("BUTTON");l.classList.add("estado-tarea"),l.classList.add(""+o[c.estado].toLowerCase()),l.textContent=o[c.estado],l.dataset.estadoTarea=c.estado,l.ondblclick=function(){!function(e){const t="1"===e.estado?"0":"1";e.estado=t,n(e)}({...c})};const m=document.createElement("BUTTON");m.classList.add("eliminar-tarea"),m.dataset.idTarea=c.id,m.textContent="Eliminar",m.ondblclick=function(){!function(a){Swal.fire({title:"¿Quieres Eliminar la Tarea?",showCancelButton:!0,confirmButtonText:"Si",cancelButtonText:"No"}).then(o=>{o.isConfirmed&&async function(a){const{estado:o,id:n,nombre:c}=a,s=new FormData;s.append("id",n),s.append("nombre",c),s.append("estado",o),s.append("proyectoId",r());try{const o="http://localhost:3000/api/tarea/eliminar",n=await fetch(o,{method:"POST",body:s}),r=await n.json();r.resultado&&(Swal.fire("Eliminado!",r.mensaje,"success"),e=e.filter(e=>e.id!==a.id),t())}catch(e){console.error(e)}}(a)})}({...c})},d.appendChild(l),d.appendChild(m),s.appendChild(i),s.appendChild(d);document.querySelector("#listado-tareas").appendChild(s)})}function a(a=!1,c={}){console.log(c);const s=document.createElement("DIV");s.classList.add("modal"),s.innerHTML=`\n        <form class="formulario nueva-tarea">\n            <legend>${a?"Editar Tarea":"Añade una Nueva Tarea"}</legend>\n            <div class="campo">\n                <label>Tarea</label>\n                <input type="text" name="tarea" \n                placeholder=${c.nombre?"Edita la Tarea":"Añadir Tarea al Proyecto"} \n                id="tarea" value=${c.nombre?c.nombre:""}>\n            </div>\n            <div class="opciones">\n            <input type="submit" class="submit-nueva-tarea" value=${c.nombre?"Guardar Cambios":"Añadir Tarea"}>\n            <button type="button" class="cerrar-modal">Cancelar</button>\n            </div>\n        </form>\n        `,setTimeout(()=>{document.querySelector(".formulario").classList.add("animar")},0),s.addEventListener("click",(function(i){if(i.preventDefault(),i.target.classList.contains("cerrar-modal")){document.querySelector(".formulario").classList.add("cerrar"),setTimeout(()=>{s.remove()},110)}if(i.target.classList.contains("submit-nueva-tarea")){const s=document.querySelector("#tarea").value.trim();if(""===s)return void o("Tarea Sin Nombre","error",document.querySelector(".formulario legend"));a?(c.nombre=s,n(c)):async function(a){const n=new FormData;n.append("nombre",a),n.append("proyectoId",r());try{const r="http://localhost:3000/api/tarea",c=await fetch(r,{method:"POST",body:n}),s=await c.json();if(console.log(s),o(s.mensaje,s.tipo,document.querySelector(".formulario legend")),"exito"===s.tipo){const o=document.querySelector(".modal");setTimeout(()=>{o.remove()},3e3);const n={id:String(s.id),nombre:a,estado:"0",proyectoId:s.proyectoId};e=[...e,n],t(),console.log(n)}}catch(e){console.log(e)}}(s)}})),document.querySelector(".dashboard").appendChild(s)}function o(e,t,a){const o=document.querySelector(".alerta");o&&o.remove();const n=document.createElement("DIV");n.classList.add("alerta",t),n.textContent=e,a.parentElement.insertBefore(n,a.nextSibling),setTimeout(()=>{n.remove()},4e3)}async function n(a){const{estado:o,id:n,nombre:c,proyectoId:s}=a,i=new FormData;i.append("id",n),i.append("nombre",c),i.append("estado",o),i.append("proyectoId",r());try{const a="http://localhost:3000/api/tarea/actualizar",r=await fetch(a,{method:"POST",body:i}),s=await r.json();if("exito"===s.respuesta.tipo){Swal.fire(s.respuesta.mensaje,s.respuesta.mensaje,"success");const a=document.querySelector(".modal");a&&a.remove(),e=e.map(e=>(e.id===n&&(e.estado=o,e.nombre=c),e)),t()}}catch(e){console.log(e)}}function r(){const e=new URLSearchParams(window.location.search);return Object.fromEntries(e.entries()).id}document.querySelector("#agregar-tarea").addEventListener("click",(function(){a(!1)}))}();