let tblProveedores, editorDireccion;

const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');

const ruc = document.querySelector('#ruc');
const nombre = document.querySelector('#nombre');
const telefono = document.querySelector('#telefono');
const correo = document.querySelector('#correo');
const direccion = document.querySelector('#direccion');
const id = document.querySelector('#id');

const errorRuc = document.querySelector('#errorRuc');
const errorCorreo = document.querySelector('#errorCorreo');
const errorNombre = document.querySelector('#errorNombre');
const errorTelefono = document.querySelector('#errorTelefono');
const errorDireccion = document.querySelector('#errorDireccion');

document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblProveedores = $('#tblProveedores').DataTable({
        ajax: {
            url: base_url + 'proveedor/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'ruc' },
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
    ClassicEditor
        .create(document.querySelector('#direccion'), {
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
    btnNuevo.addEventListener('click', function(){
        id.value = '';
        btnAccion.textContent = 'Registrar';
        editorDireccion.setData('');
        formulario.reset();
        limpiarCampos();
    })
    //registrar proveedores
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        limpiarCampos();
        if (ruc.value == '') {
            errorRuc.textContent = 'EL RUC ES OBLIGATORIO...';
        } else if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES OBLIGATORIO...';
        }else if (telefono.value == '') {
            errorTelefono.textContent = 'EL TELEFONO ES OBLIGATORIO...';
        }else if (correo.value == '') {
            errorCorreo.textContent = 'EL CORREO ES OBLIGATORIO...';
        }else if (direccion.value == '') {
            errorDireccion.textContent = 'LA DIRECCION ES OBLIGATORIO...';
        }else{
            const url = base_url + 'proveedor/registrar';
            insertarRegistros(url, this, tblProveedores, btnAccion, false);
        }
        
    })
})

function eliminarProveedor(idProveedor){
    const url = base_url + 'proveedor/eliminar/' + idProveedor;
    eliminarRegistros(url, tblProveedores);
}

function editarProveedor(idProveedor) {
    limpiarCampos();
    const url = base_url + 'proveedor/editar/' + idProveedor;
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
            ruc.value = res.ruc;
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
    errorRuc.textContent = '';
    errorNombre.textContent = '';
    errorTelefono.textContent = '';
    errorCorreo.textContent = '';
    errorDireccion.textContent = '';
}