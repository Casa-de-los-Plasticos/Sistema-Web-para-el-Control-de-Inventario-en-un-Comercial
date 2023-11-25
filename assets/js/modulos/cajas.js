const monto_inicial = document.querySelector("#monto_inicial");
const btnAbrirCaja = document.querySelector("#btnAbrirCaja");

const formulario = document.querySelector("#formulario");
const monto = document.querySelector("#monto");
const descripcion = document.querySelector("#descripcion");
const foto = document.querySelector("#foto");
const btnRegistrarGasto = document.querySelector("#btnRegistrarGasto");

let tblGastos, myChart;

document.addEventListener("DOMContentLoaded", function () {
    // VERIFICAR ESTADO
        btnAbrirCaja.addEventListener("click", function () {
            if (monto_inicial == "") {
            alertaPersonalizada("warning", "EL MONTO ES OBLIGATORIO...");
            } else {
            const url = base_url + "cajas/abrirCaja";
            //hacer una instancia del objeto XMLHttpRequest
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open("POST", url, true);
            //Enviar Datos
            http.send(
                JSON.stringify({
                monto: monto_inicial.value,
                })
            );
            //verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertaPersonalizada(res.type, res.msg);
                window.location.reload();
                }
            };
            }
        });
    if (formulario && document.querySelector("#reporteMovimiento")) {

        //cargar datos con el plugin datatables
        $("#tblAperturaCierre").DataTable({
            ajax: {
            url: base_url + "cajas/listar",
            dataSrc: "",
            },
            columns: [
            { data: "monto_inicial" },
            { data: "fecha_apertura" },
            { data: "fecha_cierre" },
            { data: "monto_final" },
            { data: "total_ventas" },
            { data: "nombre" },
            { data: "accion" }
            ],
            language: {
            url: base_url + "assets/js/espanol.json",
            },
            dom,
            buttons,
            responsive: true,
            order: [[0, "asc"]],
        });

        //Inicializar un Editor
        ClassicEditor.create(document.querySelector("#descripcion"), {
            toolbar: {
            items: [
                "selectAll",
                "|",
                "heading",
                "|",
                "bold",
                "italic",
                "outdent",
                "indent",
                "|",
                "undo",
                "redo",
                "alignment",
                "|",
                "link",
                "blockQuote",
                "insertTable",
                "mediaEmbed",
            ],
            shouldNotGroupWhenFull: true,
            },
        }).catch((error) => {
            console.error(error);
        });

        // REGISTRAR GASTO
        formulario.addEventListener("submit", function (e) {
            e.preventDefault();
            if (monto.value == "") {
            alertaPersonalizada("warning", "EL MONTO ES OBLIGATORIO...");
            } else if (descripcion.value == "") {
            alertaPersonalizada("warning", "LA DESCRIPCION ES OBLIGATORIO...");
            } else {
            const url = base_url + "cajas/registraGasto";
            insertarRegistros(url, this, tblGastos, btnRegistrarGasto, false);
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        });

        //cargar datos con el plugin datatables
        tblGastos = $("#tblGastos").DataTable({
            ajax: {
            url: base_url + "cajas/listargastos",
            dataSrc: "",
            },
            columns: [{ data: "monto" }, { data: "descripcion" }, { data: "foto" }],
            language: {
            url: base_url + "assets/js/espanol.json",
            },
            dom,
            buttons,
            responsive: true,
            order: [[0, "asc"]],
        });

        movimientos();
    }
});

function movimientos() {
    const url = base_url + "cajas/movimientos";
    //hacer una instancia del objeto XMLHttpRequest
    const http = new XMLHttpRequest();
    //Abrir una Conexion - POST - GET
    http.open("GET", url, true);
    //Enviar Datos
    http.send();
    //verificar estados
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        const res = JSON.parse(this.responseText);
        var ctx = document.getElementById("reporteMovimiento").getContext("2d");

        myChart = new Chart(ctx, {
            type: "pie",
            data: {
            labels: ["Monto Inicial", "Ingresos", "Gastos", "Egresos", "Saldo"],
            datasets: [
                {
                backgroundColor: [
                    '#0c62e0',
                    '#515a62',
                    '#128e0a',
                    '#e4ad07',
                    '#e20e22'
                ],

                hoverBackgroundColor: [
                    '#0c62e0',
                    '#515a62',
                    '#128e0a',
                    '#e4ad07',
                    '#e20e22'
                ],
                data: [res.montoInicial, res.ingresos, res.gastos, res.egresos, res.saldo],
                borderWidth: [1, 1, 1, 1, 1],
                },
            ],
            },
            options: {
            maintainAspectRatio: false,
            cutoutPercentage: 0,
            legend: {
                position: "bottom",
                display: false,
                labels: {
                boxWidth: 8,
                },
            },
            tooltips: {
                displayColors: false,
            },
            },
        });

        let html = `
            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                <div><i class="fas fa-check-circle"></i> Monto Inicial </div> <span class="badge bg-primary rounded-pill">${res.moneda + ' ' + res.inicialDecimal}</span>
            </li>
            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                <div><i class="fas fa-check-circle"></i> Ingresos </div><span class="badge bg-secondary rounded-pill">${res.moneda + ' ' + res.ingresosDecimal}</span>
            </li>
            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                <div><i class="fas fa-check-circle"></i> Gastos </div><span class="badge bg-success rounded-pill">${res.moneda + ' ' + res.gastosDecimal}</span>
            </li>
            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                <div><i class="fas fa-check-circle"></i> Egresos </div><span class="badge bg-warning rounded-pill">${res.moneda + ' ' + res.egresosDecimal}</span>
            </li>
            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                <div><i class="fas fa-check-circle"></i> Saldo </div><span class="badge bg-danger rounded-pill">${res.moneda + ' ' + res.saldoDecimal}</span>
            </li>`;
            document.querySelector('#listaMovimientos').innerHTML = html;
        }
    };
}

function cerrarCaja() {
    Swal.fire({
        title: 'Esta seguro de Cerrar la Caja?',
        text: "Los Movimientos Comenzarán desde Cero!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'cajas/cerrarCaja';
            //hacer una instancia del objeto XMLHttpRequest 
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open('GET', url, true);
            //Enviar Datos
            http.send();
            //verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    if (res.type = 'success') {
                        window.location.reload();
                    }
                }
            }
        }
    })
}
