let tblMesas;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblMesas = $('#tblMesas').DataTable({
        ajax: {
            url: base_url + 'mesas/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'tiempo' },
            { data: 'monto' },
            { data: 'cliente' },
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
})

function restaurarMesas(idMesa) {
    const url = base_url + 'mesas/restaurar/' + idMesa;
    // primerTab.show();
    restaurarRegistros(url, tblMesas);
}