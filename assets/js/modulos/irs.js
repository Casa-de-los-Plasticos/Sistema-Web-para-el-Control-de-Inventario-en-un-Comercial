let tblIrs, tblLunes, tblViernes;
const btnConsultar = document.querySelector("#btnConsultar");
const btnAccion = document.querySelector("#btnGuardar");
const btnLimpiar = document.querySelector("#btnLimpiar");
const formularioIrs = document.querySelector("#formularioIrs");

const idProducto = document.querySelector("#idProducto");
// APARTADO PARA CALCULAR EL PROMEDIO
const fechaInicial = document.querySelector("#fecha_inicial");
const fechaFinal = document.querySelector("#fecha_final");
const SumaTotalSalidas = document.querySelector("#SumaTotalSalidas");

const descripcion = document.querySelector("#descripcion");
const cantidad = document.querySelector("#cantidad");
const btnCalcular = document.querySelector("#btnCalcular");

const errorDescripcion = document.querySelector("#errorDescripcion");
const errorFechaInicio = document.querySelector("#errorFechaInicio");
const errorFechaFin = document.querySelector("#errorFechaFin"); 

// PESTAÑA INDICADOR FILTRO POR PRODUCTO Y FECHA
 
const producto = document.querySelector("#productos"); 
const errorProducto = document.querySelector("#errorProducto");
const btnMostrar = document.querySelector("#btnMostrar");
const btnBorrar = document.querySelector("#btnBorrar");
// FIN PESTAÑA INDICADOR

//para filtro por rango de fechas
const desde = document.querySelector("#desde");
const hasta = document.querySelector("#hasta");

// APARTADO PESTAÑA NUEVO
// var codigoNuevo = document.querySelector("#codigoNuevo");

const cantidadInicialNuevo = document.getElementById("cantidadInicialNuevo");
const cantidadFinalNuevo = document.getElementById("cantidadFinalNuevo");
const btnCalcularNuevo = document.getElementById("btnCalcularNuevo");
const cantidadMediaNuevo = document.getElementById("cantidadMediaNuevo");

const irsNuevo = document.getElementById("irsNuevo");
const btnCalcularIrs = document.getElementById("btnCalcularIrs");

var tableIrs = document.getElementById("tblIrs");


document.addEventListener("DOMContentLoaded", function () {
    //autocomplete Producto
    // $("#descripcionProducto").autocomplete({
    //     source: function (request, response) {
    //         $.ajax({
    //             url: base_url + "irs/buscarNombre",
    //             dataType: "json",
    //             data: {
    //                 term: request.term,
    //             },
    //             success: function (data) {
    //                 response(data);
    //                 if (data.length > 0) {
    //                     errorDescripcionProducto.textContent = "";
    //                 } else {
    //                     errorDescripcionProducto.textContent =
    //                         "NO HAY PRODUCTO CON ESA DESCRIPCIÓN...";
    //                 }
    //             },
    //         });
    //     },
    //     minLength: 2,
    //     select: function (event, ui) {
    //         descripcion.value = ui.item.descripcion;
    //     },
    // });

    $("#descripcion").autocomplete({
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
                        errorDescripcion.textContent = "";
                    } else {
                        errorDescripcion.textContent =
                            "NO HAY PRODUCTO CON ESA DESCRIPCIÓN...";
                    }
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
            descripcion.value = ui.item.descripcion;
        },
    });

    //cargar datos con el plugin datatables
    tblIrs = $("#tblIrs").DataTable({
        ajax: {
            url: base_url + "irs/listar",
            dataSrc: "",
        },
        columns: [
            { data: "descripcion" },
            { data: "fecha_inicio" },
            { data: "fecha_fin" },
            { data: "resultado" },
            { data: "fecha" },
            { data: "hora" },
        ],
        language: {
            url: base_url + "assets/js/espanol.json",
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, "asc"]],
    });

    btnConsultar.addEventListener("click", function (e) {
        e.preventDefault();
        var descripcionProducto = $("#descripcion").val();
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
                var valorNumerico = parseInt(data["ventas"], 10); // Para enteros
                $("#SumaTotalSalidas").val(valorNumerico);
            },
        });
    });

    tblLunes = $('#tblLunes').DataTable({
        ajax: {
            url: base_url + 'irs/listarLunes',
            dataSrc: ''
        },
        columns: [
            // { data: 'id' },
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'cantidad' },
            { data: 'fecha' },
            { data: 'hora' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[3, 'desc']],
    });

    tblViernes = $('#tblViernes').DataTable({
        ajax: {
            url: base_url + 'irs/listarViernes',
            dataSrc: ''
        },
        columns: [
            // { data: 'id' },
            { data: 'codigo' },
            { data: 'descripcion' },
            { data: 'cantidad' },
            { data: 'fecha' },
            { data: 'hora' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[3, 'desc']],
    });

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

    // Agrega la función de clic al botón "Limpiar" para restablecer los campos
    btnBorrar.addEventListener("click", function () {
        // Limpia los campos de descripción, fecha de inicio y fecha de fin
        botonLimpiar();
        filtro("");
        // Puedes mostrar el mensaje de SweetAlert si lo deseas
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'success',
            title: 'LOS DATOS SE HAN LIMPIADO CON ÉXITO...',
            showConfirmButton: false,
            timer: 2000
        });
    });

    // Agrega evento al botón "Mostrar"
    btnMostrar.addEventListener("click", function () {
        filtro();
    });

    // Agrega evento al campo de descripción para filtrar en tiempo real
    producto.addEventListener("keyup", function () {
        filtro();
    });
});

// Función para realizar la petición AJAX y filtrar la tabla
function filtro() {
    var productos = producto.value;
    var fechaInicio = desde.value;
    var fechaFin = hasta.value;

    $.ajax({
        type: "POST",
        url: base_url + "irs/filtrar",
        data: {
            productos: productos,
            fechaInicio: fechaInicio,
            fechaFin: fechaFin,
        },
        success: function (response) {
            tblIrs.clear().draw();
            tblIrs.rows.add(JSON.parse(response)).draw();
        },
    });
}


function limpiarCampos() {
    errorDescripcionProducto.textContent = "";
    errorFechaInicio.textContent = "";
    errorFechaFin.textContent = "";
}

function botonLimpiar() {
    descripcionProducto.value = "";
    desde.value = "";
    hasta.value = "";
}