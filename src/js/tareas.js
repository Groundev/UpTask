(function (){
    // Boton para mostrar el Modal de Agregar tarea
    const nuevaTareaBtn = document.querySelector('#agregar-tarea')
    nuevaTareaBtn.addEventListener('click', mostrarFormulario)

    function mostrarFormulario (){
        const modal = document.createElement('DIV')
        modal.classList.add('modal')
        modal.innerHTML  = `
        <form class="formulario nueva-tarea">
            <legend>Añade una Nueva Tarea</legend>
            <div class="campo">
                <label>Tarea</label>
                <input type="text" name="tarea" 
                placeholder="Añadir Tarea al Proyecto" 
                id="tarea">
            </div>
            <div class="opciones">
            <input type="submit" class="submit-nueva-tarea" value="Añadir Tarea">
            <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>
        `;
        document.querySelector('body').appendChild(modal)
    }
})()