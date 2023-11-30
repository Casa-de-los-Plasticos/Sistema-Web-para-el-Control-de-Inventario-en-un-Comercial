let tblIrs, tblLunes, tblViernes;
const btnConsultar = document.querySelector("#btnConsultar");
const btnAccion = document.querySelector("#btnGuardar");
const btnLimpiar = document.querySelector("#btnLimpiar");
const formularioIrs = document.querySelector("#formularioIrs");

const idProducto = document.querySelector("#idProducto");
// APARTADO PARA CALCULAR EL PROMEDIO PESTAÑA NUEVO
const fechaInicial = document.querySelector("#fecha_inicial");
const fechaFinal = document.querySelector("#fecha_final");
const SumaTotalSalidas = document.querySelector("#SumaTotalSalidas");

const descripcion = document.querySelector("#descripcionProducto");
const cantidad = document.querySelector("#cantidad");
const btnCalcular = document.querySelector("#btnCalcular");

const errorDescripcionProducto = document.querySelector("#errorDescripcionProducto");
const errorFechaInicio = document.querySelector("#errorFechaInicio");
const errorFechaFin = document.querySelector("#errorFechaFin");
const errorIrsNuevo = document.querySelector("#errorIrsNuevo");

// APARTADO DE PRUEBA 02/11/2023
// const codigo = document.querySelector('#codigo');
// const descripcion = document.querySelector('#descripcion');
// const cantidad = document.querySelector('#cantidad');
const razon = document.querySelector('#razon');

const errorCodigo = document.querySelector('#errorCodigo');
const errorCantidad = document.querySelector('#errorCantidad');

// APARTADO PESTAÑA NUEVO
// var codigoNuevo = document.querySelector("#codigoNuevo");

const cantidadInicialNuevo = document.getElementById("cantidadInicialNuevo");
const cantidadFinalNuevo = document.getElementById("cantidadFinalNuevo");
const btnCalcularNuevo = document.getElementById("btnCalcularNuevo");
const cantidadMediaNuevo = document.getElementById("cantidadMediaNuevo");

const irsNuevo = document.getElementById("irsNuevo");
const btnCalcularIrs = document.getElementById("btnCalcularIrs");

document.addEventListener('DOMContentLoaded', function () {
    //autocomplete Producto
    $("#descripcionProducto").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + "irs/buscarNombre",
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    response(data);
                    if (data.length > 0) {
                        errorDescripcionProducto.textContent = "";
                    } else {
                        errorDescripcionProducto.textContent = "NO SE ENCONTRARON RESULTADOS...";
                    }
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
            descripcion.value = ui.item.descripcion;
            id.value = ui.item.id;
        },
    });

    // AUTOCOMPLETE PRODUCTO POR NOMBRE 02/11/2023

    //autocomplete Producto

    //cargar datos con el plugin datatables
    tblIrs = $('#tblIrs').DataTable({
        ajax: {
            url: base_url + 'irs/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'descripcion' },
            { data: 'fecha_inicio' },
            { data: 'fecha_fin' },
            { data: 'resultado' },
            { data: 'fecha' },
            { data: 'hora' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });

    btnConsultar.addEventListener("click", function (e) {
        e.preventDefault();
        var descripcionProducto = $("#descripcionProducto").val();
        var fechaInicial = $("#fecha_inicial").val();
        var fechaFinal = $("#fecha_final").val();
        $.ajax({
            type: "POST",
            url: base_url + "irs/consultar",
            data: {
                submit: false,
                descripcionProducto: descripcionProducto,
                fecha_inicial: fechaInicial,
                fecha_final: fechaFinal,
            },
            success: function (response) {
                var data = JSON.parse(response);
                var valorNumerico = parseInt(data["SUM(cantidad)"], 10); // Para enteros
                $("#SumaTotalSalidas").val(valorNumerico);
            },
        });
    });

    // tblLunes = $('#tblLunes').DataTable({
    //     ajax: {
    //         url: base_url + 'irs/listarLunes',
    //         dataSrc: ''
    //     },
    //     columns: [
    //         { data: 'id' },
    //         { data: 'codigo' },
    //         { data: 'descripcion' },
    //         { data: 'cantidad' },
    //         { data: 'fecha' },
    //         { data: 'hora' }
    //     ],
    //     language: {
    //         url: base_url + 'assets/js/espanol.json'
    //     },
    //     dom,
    //     buttons,
    //     responsive: true,
    //     order: [[5, 'desc']],
    // });

    // tblViernes = $('#tblViernes').DataTable({
    //     ajax: {
    //         url: base_url + 'irs/listarViernes',
    //         dataSrc: ''
    //     },
    //     columns: [
    //         { data: 'id' },
    //         { data: 'codigo' },
    //         { data: 'descripcion' },
    //         { data: 'cantidad' },
    //         { data: 'fecha' },
    //         { data: 'hora' }
    //     ],
    //     language: {
    //         url: base_url + 'assets/js/espanol.json'
    //     },
    //     dom,
    //     buttons,
    //     responsive: true,
    //     order: [[5, 'desc']],
    // });

    // Agregar un controlador de eventos al botón "btnCalcularNuevo"
    btnCalcularNuevo.addEventListener("click", function () {
        const numero1 = parseFloat(cantidadInicialNuevo.value);
        const numero2 = parseFloat(cantidadFinalNuevo.value);
        const resultado = (numero1 + numero2) / 2;
        cantidadMediaNuevo.value = resultado;
    });

    // Agregar un controlador de eventos al botón "btnCalcularNuevo"
    btnCalcularIrs.addEventListener("click", function () {
        const numero1 = parseFloat(SumaTotalSalidas.value);
        const numero2 = parseFloat(cantidadMediaNuevo.value);
        const resultado = (numero1 / numero2).toFixed(2);
        irsNuevo.value = resultado;
    });

    btnLimpiar.addEventListener('click', function () {
        id.value = '';
        errorNombre.textContent = '';
        btnAccion.textContent = 'Registrar';
        formularioIrs.reset();
    })

    //registrar clientes
    formularioIrs.addEventListener('submit', function (e) {
        e.preventDefault();
        limpiarCampos();
        if (descripcion.value == '') {
            errorDescripcionProducto.textContent = 'LA DESCRIPCIÓN DEL PRODUCTO ES OBLIGATORIO';
        } else if (fechaInicial.value == '') {
            errorFechaInicio.textContent = 'SELECCIONE LA FECHA INICIAL ES OBLIGATORIO';
        } else if (fechaFinal.value == '') {
            errorFechaFin.textContent = 'SELECCIONE LA FECHA FINAL ES OBLIGATORIO';
        } else {
            const url = base_url + 'irs/registrar';
            insertarRegistros(url, this, tblIrs, btnAccion, false);
        }
    })

})

function limpiarCampos() {
    errorDescripcionProducto.textContent = '';
    errorFechaInicio.textContent = '';
    errorFechaFin.textContent = '';
}

