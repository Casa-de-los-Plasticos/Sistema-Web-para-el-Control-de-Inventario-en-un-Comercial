let tblAlmacen;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblAlmacen = $('#tblAlmacen').DataTable({
        ajax: {
            url: base_url + 'almacen/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'cantidad' },
            { data: 'razon' },
            { data: 'fecha' },
            { data: 'hora' },
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

function restaurarAlmacen(idAlmacen) {
    const url = base_url + 'almacen/restaurar/' + idAlmacen;
    restaurarRegistros(url, tblAlmacen);
}