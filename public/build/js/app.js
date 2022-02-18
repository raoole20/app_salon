let paso = 1;
const pasoInicial = 1;
const pasoFinal   = 3;

const cita = {
    id : '',
    nombre : '',
    fecha  : '',
    hora   : '',
    servicios : []
}

// Iniciamos la funcionalidad en el momento que cargue el documento
document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
    
})


// funcion para inicar las fincionalidades
function iniciarApp(){
    paginador();
    botonesPaginador();
    consultarAPI();
    nombreCliente();
    paginaAnteriorb();
    paginaSiguienteb();
    seleccionarFecha();
    seleccionarHora();

    mostrarRsumen();
}



function paginador() {

    let button = document.querySelectorAll('.button');

        button.forEach( boton => {   
            boton.addEventListener('click', (e)=>{
                paso = parseInt( e.target.dataset.paso );
                botonesPaginador();
            });
        });
}

function  cambiarSeccion( ){


    if( document.querySelector('.mostrar') ){

        document.querySelector('.mostrar').classList.remove('mostrar');
        document.querySelector(`.actual`).classList.remove('actual')

    }
    document.querySelector(`#paso-${paso}`).classList.add('mostrar');
    document.querySelector(`[data-paso="${paso}"]`).classList.add('actual')




}

function botonesPaginador(  ){

    let paginaSiguiente = document.querySelector('#siguiente');
    let paginaAnterior  = document.querySelector('#anterior');


    // paginaSiguiente.addEventListener('click', () => {  
    //     if(paso === pasoFinal ) return;
    //     paso = paso + 1;
    // });  

    // console.log(paso);

    if( paso === 1 ){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if( paso === 3){
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');

        mostrarRsumen()

    }else{
        paginaAnterior.classList.remove ('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    cambiarSeccion();
}

function paginaSiguienteb(){

    let paginaSiguiente = document.querySelector('#siguiente');

    paginaSiguiente.addEventListener('click', () => {  
        if(paso === pasoFinal ) return;
        paso = paso + 1;
        botonesPaginador();
    });  
}

function paginaAnteriorb(){

   
    let paginaAnterior  = document.querySelector('#anterior');

    paginaAnterior.addEventListener('click', () => {
        // console.log('diste click')
        if(paso === pasoInicial ) return;
        paso = paso - 1;
        botonesPaginador();
    });
   
}

async function  consultarAPI(){

    try{
        const url = 'http://localhost:8080/api/servicios';
        const resultado = await fetch(url);
        const servicios = await resultado.json();

        // crea un arreglo con los valores del json
        mostrarServicios(servicios);

    }catch(error){
        console.log(error);
    }
}

function mostrarServicios(servicios){

    servicios.forEach( servicio => {

        const{ id, nombre, precio } = servicio;

        // scripting
        const nombreServicio = document.createElement('p');
        nombreServicio.textContent = nombre;
        nombreServicio.classList.add('servicio-nombre');

        const precioServicio = document.createElement('p');
        precioServicio.textContent = '$' + precio;
        precioServicio.classList.add('servicio-precio');

        const servicioDiv = document.createElement('DIV');
        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function () {
            seleccionarServicio(servicio);
        }

        document.querySelector('#servicios').appendChild(servicioDiv);
    });
}

function seleccionarServicio(servicio) {

    const { id } = servicio;
    const { servicios } = cita;

    const divServicio = document.querySelector(`[data-id-servicio="${servicio.id}"]`);

    if( servicios.some( Element => Element.id === id ) ){
        cita.servicios = servicios.filter( element => element.id !== id );
        divServicio.classList.remove('seleccionado');
    }else{
        cita.servicios = [...servicios, servicio];
        //! cita.servicios.push(servicio)  
        // cual es la diferencia WTF???
        divServicio.classList.add('seleccionado');
    }



}   

function nombreCliente(){
    cita.nombre = document.querySelector('#nombre').value;
    cita.id = document.querySelector('#id').value;
}

function seleccionarFecha(){

    const inputFecha  = document.querySelector('#fecha');

    inputFecha.addEventListener('input', (e) => {

        const dia = new Date(e.target.value).getUTCDay();

        // console.log(dia);

        if( [6, 0].includes(dia) ){
            setTimeout( () => {
                e.target.value = '';
            },3000);
            mostarrAlerta('Fines de semana no permitidos', 'error', '.formulario');
        }else{
            cita.fecha = e.target.value;
        }


    });
}


function mostarrAlerta(mensaje, tipo, elemento_, eliminar = true){

    if( document.querySelector('.alerta')) {
        document.querySelector('.alerta').remove()
    };

    const alerta = document.createElement('div');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);
    const elemento = document.querySelector(elemento_);
    elemento.appendChild(alerta);

    if( eliminar ){
        setTimeout( () => {
            alerta.remove();
        }, 3000)  
    }
}

function  seleccionarHora(){

    const input = document.querySelector('#hora');

    input.addEventListener( 'input', (e) => {

        let hora = parseInt( e.target.value.split(':')[0] );
        // console.log( hora );

        if( hora > 8 && hora < 20 ){
            // guardar en el arreglo
            cita.hora = e.target.value;
            // console.log( cita )
            
        }else{
            // Mostrar Error
            mostarrAlerta('Hora no valida', 'error', '.formulario');
        }
    })

}

function mostrarRsumen(){   
    // console.log(cita)
    const resumen = document.querySelector('#paso-3');
    
    resumen.innerHTML = ''; // muy mal performa

    if( Object.values(cita).includes('') || cita.servicios.length === 0 ){
        // invalido 
        mostarrAlerta('Datos incompletos o vacios', 'error', '.contenido-resumen', false);
        return
    }

    // crear los elementos html

    const { nombre, fecha, hora, servicios } = cita;

    let pName = document.createElement('P');
    pName.innerHTML = `<span>Nombre: </span> ${nombre}`;

    let pDate = document.createElement('P');
    pDate.innerHTML = `<span>fecha: </span> ${fecha}`;

    let pTime = document.createElement('P');
    pTime.innerHTML = `<span>Hora: </span> ${hora}`;

    const headingServicios = document.createElement('H3')
    headingServicios.textContent = 'Resumen de servicios'

    resumen.appendChild(headingServicios);

    
    servicios.forEach( servicio => {
        
        const { nombre, precio  } = servicio;

        let sDiv = document.createElement('DIV');
        sDiv.classList.add('contenedor-servicios');

        let pSName = document.createElement('P');
        pSName.innerHTML = `${ nombre }`

        let sPrecio = document.createElement('P');
        sPrecio.innerHTML = `<span>Precio: </span> ${precio}`;

        let hr = document.createElement('P');
        hr.innerHTML = `<hr/>`;

        sDiv.appendChild(pSName);
        resumen.appendChild(pSName);        
        resumen.appendChild(sPrecio);        
        resumen.appendChild(hr)
    });

    const r = document.createElement('H3')
    r.textContent = 'Resumen de Cita'

    resumen.appendChild(headingServicios);
    
    resumen.appendChild(pName)
    resumen.appendChild(pDate)
    resumen.appendChild(pTime)

    const boton = document.createElement('BUTTON');
    boton.classList.add('boton');
    boton.onclick = fecth;
    boton.textContent = 'confirmar cita';

    resumen.appendChild(boton);
    
}

async function fecth() {

    const datos = new FormData();            // enviar datos al servidor mediante formfata  

    const { nombre,id, fecha, hora, servicios } = cita;
    const idServicio = servicios.map( servicio => servicio.id );

    datos.append('fecha', fecha);              
    datos.append('hora', hora);              
    datos.append('usuarioId', id);              
    datos.append('servicios ', idServicio);    

    console.log( [...datos] );              //Creando copia del formdata

    try {
        const url = 'http://localhost:8080/api/cita';     // Url donde realizaremos el fecth

        let respuesta = await fetch(url, {
            method : 'POST',                     // cuando la peticion es post se debe definir que sera de ese tipo  [instrucciones]    
            body   : datos
        });                                     //realizando consulta
    
        respuesta = await respuesta.json();      // convirtiendo en un json
    
        if( respuesta.resultado ){
            swal({
                title: "Cita Creada",
                text: "Tu cita fue creada con exito",
                icon: "success",
                button: "Ok",
              }).then( () => {
                window.location.reload();
              });
        }
    } catch (error) {
        swal({
            title: "Error",
            text: "Ha ocurrido un error",
            icon: "error",
            button: "Ok",
          })
          console.log(error);
    }
   
}