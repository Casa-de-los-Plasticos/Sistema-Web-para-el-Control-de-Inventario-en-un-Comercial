let tblMedidas;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblMedidas = $('#tblMedidas').DataTable({
        ajax: {
            url: base_url + 'medidas/listarInactivos',
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
})

function restaurarMedida(idMedida) {
    const url = base_url + 'medidas/restaurar/' + idMedida;
    restaurarRegistros(url, tblMedidas);
}