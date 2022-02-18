document.addEventListener('DOMContentLoaded', ()=> {
    iniciar();
});

function iniciar(){
    buscardor();
}

function buscardor(){
    $input = document.querySelector('#fecha');

    $input.addEventListener('input', (e) =>{
        const fecha = e.target.value;
        window.location = `?fecha=${fecha}`;
    });

}