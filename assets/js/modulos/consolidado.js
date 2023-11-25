let tblTpiConsolidados;

const btnConsultar = document.querySelector("#btnConsultar");
const btnAccion = document.querySelector("#btnGuardar");
const btnNuevo = document.querySelector("#btnNuevo");
const consultaForm = document.querySelector("#consultaForm");

const idProducto = document.querySelector("#idProducto");
// APARTADO PARA CALCULAR EL PROMEDIO
const codigo = document.querySelector("#codigo");
const fechaInicial = document.querySelector("#fecha_inicial");
const fechaFinal = document.querySelector("#fecha_final");
const tpi = document.querySelector("#tpi");

const descripcion = document.querySelector("#descripcion");
const cantidad = document.querySelector("#cantidad");
const btnCalcular = document.querySelector("#btnCalcular");

const errorCodigo = document.querySelector("#errorCodigo");
const errorFechaInicio = document.querySelector("#errorFechaInicio");
const errorFechaFin = document.querySelector("#errorFechaFin");


// PESTAÑA INDICADOR FILTRO POR PRODUCTO Y FECHA
const descripcionProducto = document.querySelector("#descripcionProducto");
const errorDescripcion = document.querySelector("#errorDescripcionProducto");
const btnMostrar = document.querySelector("#btnMostrar");
const btnBorrar = document.querySelector("#btnBorrar");
// FIN PESTAÑA INDICADOR

//para filtro por rango de fechas
const desde = document.querySelector("#desde");
const hasta = document.querySelector("#hasta");

var tableConsolidado = document.getElementById("tblTpiConsolidados");

document.addEventListener("DOMContentLoaded", function () {
    //autocomplete Producto
    // $("#descripcionProducto").autocomplete({
    //     source: function (request, response) {
    //         $.ajax({
    //             url: base_url + "consolidado/buscarNombre",
    //             dataType: "json",
    //             data: {
    //                 term: request.term,
    //             },
    //             success: function (data) {
    //                 response(data);
    //                 if (data.length > 0) {
    //                     errorDescripcion.textContent = "";
    //                 } else {
    //                     errorDescripcion.textContent =
    //                         "NO HAY PRODUCTO CON ESA DESCRIPCIÓN...";
    //                 }
    //             },
    //         });
    //     },
    //     minLength: 2,
    //     select: function (event, ui) {
    //         descripcionProducto.value = ui.item.descripcion;
    //     },
    // });

    //autocomplete Producto
    $("#codigo").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'consolidado/buscarCodigo',
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

    // $("#btnConsultar").autocomplete({
    //     source: function (request, response) {
    //         $.ajax({
    //             url: base_url + "consolidado/consultar",
    //             dataType: "json",
    //             data: {
    //                 term: request.term,
    //             },
    //             success: function (data) {
    //                 response(data);
    //                 if (data.length > 0) {
    //                     errorCodigo.textContent = "";
    //                 } else {
    //                     errorCodigo.textContent = "NO HAY PRODUCTO CON ESE CÓDIGO...";
    //                 }
    //             },
    //         });
    //     },
    //     minLength: 2,
    //     select: function (event, ui) {
    //         descripcion.value = ui.item.descripcion;
    //         codigo.value = ui.item.id;
    //     },
    // });

    //cargar datos con el plugin datatables
    tblTpiConsolidados = $("#tblTpiConsolidados").DataTable({
        ajax: {
            url: base_url + "consolidado/listar",
            dataSrc: "",
        },
        columns: [
            // { data: "fecha" },
            // { data: "codigo" },
            { data: "descripcion" },
            { data: "fecha_inicio" },
            { data: "fecha_fin" },
            { data: "resultado" },
            { data: "fecha" },
            { data: "hora" }
        ],
        language: {
            url: base_url + "assets/js/espanol.json",
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, "asc"]],
    });

    // CALCULAR EL TASA DE PRESICIÓN DE INVENTARIO
    btnConsultar.addEventListener("click", function (e) {
        e.preventDefault();
        var codigoProducto = $("#codigo").val();
        var fechaInicial = $("#fecha_inicial").val();
        var fechaFinal = $("#fecha_final").val();
        $.ajax({
            type: "POST",
            url: base_url + "consolidado/consultar",
            data: {
                submit: false,
                codigoProducto: codigoProducto,
                fecha_inicial: fechaInicial,
                fecha_final: fechaFinal,
            },
            success: function (response) {
                var data = JSON.parse(response);
                var valorNumerico = parseFloat(data["resultados"], 10);
                $("#tpi").val(valorNumerico);
            },
        });
    });

    btnNuevo.addEventListener("click", function () {
        id.value = "";
        errorNombre.textContent = "";
        btnAccion.textContent = "Registrar";
        formulario.reset();
    });
    //registrar consolidado
    consultaForm.addEventListener("submit", function (e) {
        e.preventDefault();
        errorCodigo.textContent = "";
        if (codigo.value == "") {
            errorCodigo.textContent = "EL CÓDIGO ES OBLIGATORIO...";
        } else if (fechaInicial.value == "") {
            errorFechaInicio.textContent = "LA FECHA INICIAL ES OBLIGATORIO...";
        } else if (fechaFinal.value == "") {
            errorFechaFin.textContent = "LA FECHA FINAL ES OBLIGATORIO...";
        } else {
            const url = base_url + "consolidado/registrar";
            insertarRegistros(url, this, tblTpiConsolidados, btnAccion, false);
        }
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
    descripcionProducto.addEventListener("keyup", function () {
        filtro();
    });
});

// Función para realizar la petición AJAX y filtrar la tabla
function filtro() {
    var descripcion = descripcionProducto.value;
    var fechaInicio = desde.value;
    var fechaFin = hasta.value;

    $.ajax({
        type: "POST",
        url: base_url + "consolidado/filtrar",
        data: {
            descripcion: descripcion,
            fechaInicio: fechaInicio,
            fechaFin: fechaFin,
        },
        success: function (response) {
            tblTpiConsolidados.clear().draw();
            tblTpiConsolidados.rows.add(JSON.parse(response)).draw();
        },
    });
}

function botonLimpiar() {
    descripcionProducto.value = "";
    desde.value = "";
    hasta.value = "";
}