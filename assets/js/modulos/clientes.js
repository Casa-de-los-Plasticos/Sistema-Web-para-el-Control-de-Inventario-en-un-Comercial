let tblClientes, editorDireccion;

const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');

const identidad = document.querySelector('#identidad');
const num_identidad = document.querySelector('#num_identidad');
const nombre = document.querySelector('#nombre');
const telefono = document.querySelector('#telefono');
const correo = document.querySelector('#correo');
const direccion = document.querySelector('#direccion');
const id = document.querySelector('#id');

const errorIdentidad = document.querySelector('#errorIdentidad');
const errorNum_identidad = document.querySelector('#errorNum_identidad');
const errorNombre = document.querySelector('#errorNombre');
const errorTelefono = document.querySelector('#errorTelefono');
const errorDireccion = document.querySelector('#errorDireccion');

document.addEventListener('DOMContentLoaded', function () {
    //cargar datos con el plugin datatables
    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            url: base_url + 'clientes/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'identidad' },
            { data: 'num_identidad' },
            { data: 'nombre' },
            { data: 'telefono' },
            { data: 'correo' },
            { data: 'direccion' },
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
    //Inicializar un Editor
    ClassicEditor.create(document.querySelector('#direccion'), {
            toolbar: {
                items: [
                    'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    'alignment', '|',
                    'link', 'blockQuote', 'insertTable', 'mediaEmbed'
                ],
                shouldNotGroupWhenFull: true
            },
    })
        .then(editor => {
            editorDireccion = editor
        })
        .catch(error => {
            console.error(error);
        });

    //limpiar campos
    btnNuevo.addEventListener('click', function () {
        id.value = '';
        btnAccion.textContent = 'Registrar';
        editorDireccion.setData('');
        formulario.reset();
        limpiarCampos();
    })
    //registrar clientes
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        limpiarCampos();
        if (identidad.value == '') {
            errorIdentidad.textContent = 'LA IDENTIDAD ES OBLIGATORIO';
        } else if (num_identidad.value == '') {
            errorNum_identidad.textContent = 'EL N° DE IDENTIDAD ES OBLIGATORIO';
        } else if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES OBLIGATORIO';
        } else if (telefono.value == '') {
            errorTelefono.textContent = 'EL TELEFONO ES OBLIGATORIO';
        } else if (direccion.value == '') {
            errorDireccion.textContent = 'LA DIRECCIÓN ES OBLIGATORIO';
        } else {
            const url = base_url + 'clientes/registrar';
            insertarRegistros(url, this, tblClientes, btnAccion, false);
        }
    })
})


function eliminarCliente(idCliente) {
    const url = base_url + 'clientes/eliminar/' + idCliente;
    eliminarRegistros(url, tblClientes);
}

function editarCliente(idCliente) {
    limpiarCampos();
    const url = base_url + 'clientes/editar/' + idCliente;
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
            identidad.value = res.identidad;
            num_identidad.value = res.num_identidad;
            nombre.value = res.nombre;
            telefono.value = res.telefono;
            correo.value = res.correo;
            editorDireccion.setData(res.direccion);
            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
}

function limpiarCampos() {
    errorIdentidad.textContent = '';
    errorNum_identidad.textContent = '';
    errorNombre.textContent = '';
    errorTelefono.textContent = '';
    errorCorreo.textContent = '';
    errorDireccion.textContent = '';
}