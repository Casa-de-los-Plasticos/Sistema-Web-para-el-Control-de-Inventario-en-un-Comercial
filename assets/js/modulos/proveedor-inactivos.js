let tblProveedores;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblProveedores = $('#tblProveedores').DataTable({
        ajax: {
            url: base_url + 'proveedor/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'ruc' },
            { data: 'nombre' },
            { data: 'telefono' },
            { data: 'correo' },
            { data: 'direccion' },
            { data: 'acciones' },
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });
})

function restaurarProveedor(idProveedor) {
    const url = base_url + 'proveedor/restaurar/' + idProveedor;
    restaurarRegistros(url, tblProveedores);
}