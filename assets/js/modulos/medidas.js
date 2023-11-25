let tblMedidas;
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');
const formulario = document.querySelector('#formulario');

const nombre = document.querySelector('#nombre');
const id = document.querySelector('#id');
const nombre_corto = document.querySelector('#nombre_corto');

const errorNombre = document.querySelector('#errorNombre');
const errorNombreCorto = document.querySelector('#errorNombreCorto');
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + 'medidas/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'medida' },
            { data: 'nombre_corto' },
            { data: 'acciones' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });
    btnNuevo.addEventListener('click', function(){
        id.value = '';
        errorNombre.textContent = '';
        errorNombreCorto.textContent = '';
        btnAccion.textContent = 'Registrar';
        formulario.reset();
    });
    //enviar datos
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        errorNombre.textContent = '';
        errorNombreCorto.textContent = '';
        if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES OBLIGATORIO...';
        } else if (nombre_corto.value == '') {
            errorNombreCorto.textContent = 'EL NOMBRE CORTO ES OBLIGATORIO...'; 
        }else{
            const url = base_url + 'medidas/registrar';
            insertarRegistros(url, this, tblMedidas, btnAccion, false);
        }        
    });
})

function eliminarMedida(idMedida) {
    const url = base_url + 'medidas/eliminar/' + idMedida;
    eliminarRegistros(url, tblMedidas);
}

function editarMedida(idMedida) {
    errorNombre.textContent = '';
    errorNombreCorto.textContent = '';
    const url = base_url + 'medidas/editar/' + idMedida;
    //hacer una instancia del objeto XMLHttpRequest 
    const http = new XMLHttpRequest();
    //Abrir una Conexion - POST - GET
    http.open('GET', url, true);
    //Enviar Datos
    http.send();
    //verificar estados
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            id.value = res.id;
            nombre.value = res.medida;
            nombre_corto.value = res.nombre_corto;
            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
}