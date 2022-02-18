document.addEventListener('DOMContentLoaded', () => iniciar());

function iniciar() {
    actualizar()
}

function actualizar() {
    
    let servicios = document.querySelectorAll('#actualizar');

    servicios.forEach( servicio => {
        servicio.addEventListener('click', (e) => {

          console.log(e.target.dataset.id)
            // window.location = `id=${e.target.data-id}`;
        })
    });  
}