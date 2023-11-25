let tblProductos;
document.addEventListener('DOMContentLoaded', function(){
    //cargar datos con el plugin datatables
    tblProductos = $('#tblProductos').DataTable({
        ajax: {
            url: base_url + 'productos/listarInactivos',
            dataSrc: ''
        },
        columns: [
            { data: "codigo" },
            { data: "descripcion" },
            { data: "precio_compra" },
            { data: "precio_venta" },
            { data: "cantidad" },
            { data: "medida" },
            { data: "categoria" },
            { data: "nombre" },
            { data: "ubicacion" },
            { data: "imagen" },
            { data: "acciones" },
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

function restaurarProducto(idProducto) {
    const url = base_url + 'productos/restaurar/' + idProducto;
    restaurarRegistros(url, tblProductos);
}