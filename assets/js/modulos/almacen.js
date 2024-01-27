let tblAlmacen;

const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');
const formulario = document.querySelector('#formulario');

const idProducto = document.querySelector('#idProducto');
// const buscarProducto = document.querySelector('#buscarProducto');
const codigo = document.querySelector('#codigo');
const descripcion = document.querySelector('#descripcion');
const cantidad = document.querySelector('#cantidad');
const razon = document.querySelector('#razon');

const errorCodigo = document.querySelector('#errorCodigo');
const errorCantidad = document.querySelector('#errorCantidad');

document.addEventListener('DOMContentLoaded', function(){

    //autocomplete Producto
    $("#codigo").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'almacen/buscar',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                    if (data.length > 0) {
                        errorCodigo.textContent = '';
                    } else {
                        errorCodigo.textContent = 'NO HAY PRODUCTO CON ESE CÓDIGO...';
                    }
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            descripcion.value = ui.item.descripcion;  
            codigo.value = ui.item.id;
        }
    });

    //cargar datos con el plugin datatables
    tblAlmacen = $('#tblAlmacen').DataTable({
        ajax: {
            url: base_url + 'almacen/listar',
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
    btnNuevo.addEventListener('click', function(){
        id.value = ''; 
        btnAccion.textContent = 'Registrar';
        formulario.reset();
    });
    //enviar datos
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        errorCodigo.textContent = '';
        errorCantidad.textContent = '';
        if (codigo.value == '') {
            errorCodigo.textContent = 'EL CÓDIGO ES OBLIGATORIO...';
        } else if (cantidad.value == '') {
            errorCantidad.textContent = 'LA CANTIDAD CORTO ES OBLIGATORIO...'; 
        }else{
            const url = base_url + 'almacen/registrar';
            insertarRegistros(url, this, tblAlmacen, btnAccion, false);
        }        
    });
})

function eliminarAlmacen(idAlmacen) {
    const url = base_url + 'almacen/eliminar/' + idAlmacen;
    eliminarRegistros(url, tblAlmacen);
}