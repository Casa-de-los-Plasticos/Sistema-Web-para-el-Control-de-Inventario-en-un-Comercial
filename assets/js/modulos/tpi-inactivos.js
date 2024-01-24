let tblCategorias;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblCategorias = $('#tblCategorias').DataTable({
        ajax: {
            url: base_url + 'tpi/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'resultado' },
            { data: 'cantidad' },
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

function restaurarCategoria(idCategoria) {
    const url = base_url + 'tpi/restaurar/' + idCategoria;
    restaurarRegistros(url, tblCategorias);
}