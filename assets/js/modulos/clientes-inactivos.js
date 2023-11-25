let tblClientes;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            url: base_url + 'clientes/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'identidad' },
            { data: 'num_identidad' },
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

function restaurarCliente(idCliente) {
    const url = base_url + 'clientes/restaurar/' + idCliente;
    restaurarRegistros(url, tblClientes);
}