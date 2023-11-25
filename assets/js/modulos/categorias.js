let tblCategorias;
const formulario = document.querySelector('#formulario');
const id = document.querySelector('#id');
const nombre = document.querySelector('#nombre');
const errorNombre = document.querySelector('#errorNombre');
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + 'categorias/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'categoria' },
            { data: 'fecha' },
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
        btnAccion.textContent = 'Registrar';
        formulario.reset();
    })
    //registrar categorias
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        errorNombre.textContent = '';
        if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES OBLIGATORIO...';
        } else {
            const url = base_url + 'categorias/registrar';
            insertarRegistros(url, this, tblCategorias, btnAccion, false);
        }        
    });
})

function eliminarCategoria(idCategoria) {
    const url = base_url + 'categorias/eliminar/' + idCategoria;
    eliminarRegistros(url, tblCategorias);
}

function editarCategoria(idCategoria) {
    errorNombre.textContent = '';
    const url = base_url + 'categorias/editar/' + idCategoria;
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
            nombre.value = res.categoria;
            btnAccion.textContent = 'Actualizar';
            firstTab.show()
        }
    }
} 
