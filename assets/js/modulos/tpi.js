let tblTpi;
const formulario = document.querySelector('#formulario');
const id = document.querySelector('#id');
const nombre = document.querySelector('#nombre'); 
const btnAccion = document.querySelector('#btnAccion');
const btnNuevo = document.querySelector('#btnNuevo');

// LO QUE SE ESTÁ IMPLEMENTANDO

const codigo = document.querySelector('#codigo');
const descripcion = document.querySelector('#descripcion');
const stock = document.querySelector('#stock');
const cantidad = document.querySelector("#cantidad");
const tpi = document.querySelector("#tpi");

const errorCodigo = document.querySelector("#errorCodigo");
const errorCantidad_Actual = document.querySelector("#errorCantidad_Actual");

document.addEventListener('DOMContentLoaded', function(){

    //autocomplete Producto
    $("#codigo").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'tpi/buscar',
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
            stock.value = ui.item.cantidad;  
            codigo.value = ui.item.id;
        }
    });

    //cargar datos con el plugin datatables
    tblTpi = $('#tblTpi').DataTable({
        ajax: {
            url: base_url + 'tpi/listar',
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

    //calcular el tpi de dinero
    cantidad.addEventListener("keyup", function (e) {
        if (stock.value != "") {
            let totalDescuento = stock.value != "" ? stock.value : 0;
            let totaltpi = (parseFloat(totalDescuento) / parseFloat(e.target.value)) * 100;
            tpi.value = totaltpi.toFixed(2);
        }
    });


    btnNuevo.addEventListener('click', function(){
        id.value = ''; 
        btnAccion.textContent = 'Registrar';
        formulario.reset();
    })
    //registrar categorias
    formulario.addEventListener('submit', function(e){
        e.preventDefault();
        errorCodigo.textContent = '';
        if (codigo.value == '') {
            errorCodigo.textContent = 'EL CÓDIGO ES OBLIGATORIO...';
        } else if (cantidad.value == '') {
            errorCantidad_Actual.textContent = 'LA CANTIDAD ES OBLIGATORIO...';
        } else {
            const url = base_url + 'tpi/registrar';
            insertarRegistros(url, this, tblTpi, btnAccion, false);
        }        
    });
})

function eliminarTpi(idTpi) {
    const url = base_url + 'tpi/eliminar/' + idTpi;
    eliminarRegistros(url, tblTpi);
} 
