let tblIrs, tblLunes, tblViernes;
const btnConsultar = document.querySelector("#btnConsultar");
const btnAccion = document.querySelector("#btnGuardar");
const btnLimpiar = document.querySelector("#btnLimpiar");
const formularioIrs = document.querySelector("#formularioIrs");

const idProducto = document.querySelector("#idProducto");
// APARTADO PARA CALCULAR EL PROMEDIO PESTAÑA NUEVO
const SumaTotalSalidas = document.querySelector("#SumaTotalSalidas");

const nombre = document.querySelector("#nombre");
const fechaInicial = document.querySelector("#fecha_inicial");
const fechaFinal = document.querySelector("#fecha_final");
const cantidad = document.querySelector("#cantidad");
const btnCalcular = document.querySelector("#btnCalcular");

// const errorDescripcionProducto = document.querySelector("#errorDescripcionProducto");
const errorFechaInicio = document.querySelector("#errorFechaInicio");
const errorFechaFin = document.querySelector("#errorFechaFin");
const errorIrsNuevo = document.querySelector("#errorIrsNuevo");

// PESTAÑA INDICADOR FILTRO POR PRODUCTO Y FECHA
const descripcionProducto = document.querySelector("#descripcionProducto");
const errorDescripcion = document.querySelector("#errorDescripcionProducto");
const btnMostrar = document.querySelector("#btnMostrar");
const btnBorrar = document.querySelector("#btnBorrar");
// FIN PESTAÑA INDICADOR

//para filtro por rango de fechas
const desde = document.querySelector("#desde");
const hasta = document.querySelector("#hasta");

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


const errorNombre = document.getElementById("errorNombre");
const errorFechaInicial = document.getElementById("errorFechaInicial");
const errorFechaFinal = document.getElementById("errorFechaFinal");

document.addEventListener('DOMContentLoaded', function () {
    //autocomplete Producto
    $("#nombre").autocomplete({
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
                        errorDescripcion.textContent = "NO SE ENCONTRARON RESULTADOS...";
                    }
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
            nombre.value = ui.item.descripcion;
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

    // btnConsultar.addEventListener("click", function (e) {
    //     e.preventDefault();
    //     var nombre = $("#nombre").val();
    //     var fechaInicial = $("#fecha_inicial").val();
    //     var fechaFinal = $("#fecha_final").val();
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + "irs/consultar",
    //         data: {
    //             submit: false,
    //             nombre: nombre,
    //             fecha_inicial: fechaInicial,
    //             fecha_final: fechaFinal,
    //         },
    //         success: function (response) {
    //             var data = JSON.parse(response);
    //             var valorNumerico = parseFloat(data["total"], 10); // Para enteros
    //             $("#SumaTotalSalidas").val(valorNumerico);
    //         },
    //     });
    // });

    btnConsultar.addEventListener("click", function (e) {
        e.preventDefault();
        var nombre = $("#nombre").val();
        var fechaInicial = $("#fecha_inicial").val();
        var fechaFinal = $("#fecha_final").val();
        $("#nombre").focus();

        if (nombre.trim() === '' || fechaInicial.trim() === '' || fechaFinal.trim() === '') {
            Swal.fire({
                icon: 'warning',
                title: 'CAMPOS OBLIGATORIOS',
                text: 'POR FAVOR, INGRESE LA DESCRIPCIÓN DE UN PRODUCTO Y SELECCIONE UN RANGO DE FECHA VÁLIDO ANTES DE CONTINUAR.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
            return;
        }
        // nombre.focus();
        $.ajax({
            type: "POST",
            url: base_url + "irs/consultar",
            data: {
                submit: false,
                nombre: nombre,
                fecha_inicial: fechaInicial,
                fecha_final: fechaFinal,
            },
            success: function (response) {
                var data = JSON.parse(response);
                if (data.hasOwnProperty("total") && !isNaN(parseFloat(data["total"]))) {
                    var valorNumerico = parseFloat(data["total"], 10);
                    $("#SumaTotalSalidas").val(valorNumerico);
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'NO SE ENCONTRARON RESULTADOS',
                        html: `PARA "` + '<b>' + nombre + '</b>' + `" Y LAS FECHAS SELECCIONADAS "` + '<b>' + fechaInicial + ` - ` + fechaFinal + '</b>' + `"`,
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                    fechaInicial.textContent = '';;
                    fechaFinal.textContent = '';;
                }

            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'SE PRODUJO UN ERROR EN LA SOLICITUD. POR FAVOR, INTÉNTALO NUEVAMENTE.'
                });
            }
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
        // order: [[4, 'desc']],
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
        // order: [[4, 'desc']],
    });

    // Agregar un controlador de eventos al botón "btnCalcularNuevo"
    // btnCalcularNuevo.addEventListener("click", function () {
    //     const numero1 = parseFloat(cantidadInicialNuevo.value);
    //     const numero2 = parseFloat(cantidadFinalNuevo.value);
    //     const resultado = (numero1 + numero2) / 2;
    //     cantidadMediaNuevo.value = resultado;
    // });

    btnCalcularNuevo.addEventListener("click", function () {
        const cantidadInicial = parseFloat(cantidadInicialNuevo.value);
        const cantidadFinal = parseFloat(cantidadFinalNuevo.value);
        if (isNaN(cantidadInicial) || isNaN(cantidadFinal)) {
            Swal.fire({
                icon: 'warning',
                title: 'CAMPOS VACÍOS',
                text: 'POR FAVOR, INGRESA VALORES VÁLIDOS PARA LA CANTIDAD INICIAL Y LA CANTIDAD FINAL.',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
            return;
        }
        const resultado = (cantidadInicial + cantidadFinal) / 2;
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
        if (nombre.value == '') {
            errorNombre.textContent = 'LA DESCRIPCIÓN DEL PRODUCTO ES OBLIGATORIO';
        } else if (fechaInicial.value == '') {
            errorFechaInicial.textContent = 'SELECCIONE LA FECHA INICIAL ES OBLIGATORIO';
        } else if (fechaFinal.value == '') {
            errorFechaFinal.textContent = 'SELECCIONE LA FECHA FINAL ES OBLIGATORIO';
        } else {
            const url = base_url + 'irs/registrar';
            insertarRegistros(url, this, tblIrs, btnAccion, false);
        }
    })

    // APARTADO PRUEBA 25/01/2024
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

})

// Función para realizar la petición AJAX y filtrar la tabla
function filtro() {
    var descripcion = descripcionProducto.value;
    var fechaInicio = desde.value;
    var fechaFin = hasta.value;

    $.ajax({
        type: "POST",
        url: base_url + "irs/filtrar",
        data: {
            descripcion: descripcion,
            fechaInicio: fechaInicio,
            fechaFin: fechaFin,
        },
        success: function (response) {
            tblIrs.clear().draw();
            tblIrs.rows.add(JSON.parse(response)).draw();
        },
    });
}

function botonLimpiar() {
    descripcionProducto.value = "";
    desde.value = "";
    hasta.value = "";
}

function limpiarCampos() {
    errorNombre.textContent = '';
    errorFechaInicial.textContent = '';
    errorFechaFinal.textContent = '';
}

