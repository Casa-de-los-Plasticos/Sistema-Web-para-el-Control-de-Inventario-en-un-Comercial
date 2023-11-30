$(function () {
    "use strict";
});
let tblProductos, tblProductosHome;

// LISTADO DE PRODUCTOS DESDE EL HOME
tblProductosHome = $("#tblProductosHome").DataTable({
    ajax: {
        url: base_url + "admin/listar",
        dataSrc: "",
    },
    columns: [
        { data: "codigo" },
        { data: "descripcion" },
        { data: "cantidad" },
        { data: "medida" },
        { data: "categoria" },
        { data: "nombre" },
        { data: "ubicacion" },
        // { data: "imagen" }
    ],
    language: {
        url: base_url + "assets/js/espanol.json",
    },
    dom,
    buttons,
    responsive: true,
    order: [[1, "asc"]],
});

// INICIO GRÁFICA TPI
let currentPage = 1;
let itemsPerPage = 10;
let totalItems = 0;
let totalPages = 1;
let barChart = null;
const ctx = document.getElementById("barChart").getContext("2d");
const prevButton = document.getElementById("prevPage");
const nextButton = document.getElementById("nextPage");

prevButton.addEventListener("click", async () => {
    if (currentPage > 1) {
        await loadTopProductos(currentPage - 1);
    }
});

nextButton.addEventListener("click", async () => {
    if (currentPage < totalPages) {
        await loadTopProductos(currentPage + 1);
    }
});

async function loadTopProductos(pagina) {
    const urlPreTest = base_url + `admin/topProductos/?pagina=${pagina}&fecha=2023-07-08`;
    const urlPostTest = base_url + `admin/topProductosPost/?pagina=${pagina}&fecha=2023-09-13`;

    try {
        const resPreTest = await fetchData(urlPreTest);
        const resPostTest = await fetchData(urlPostTest);

        if (barChart) {
            barChart.destroy();
        }

        updateBarChart(resPreTest, resPostTest);
        currentPage = pagina;

        updatePaginationButtons();
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
}

async function fetchData(url) {
    return new Promise((resolve, reject) => {
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject("Error en la solicitud");
                }
            }
        };
        http.send();
    });
}

function updateBarChart(dataPreTest, dataPostTest) {
    let nombres = dataPreTest.map(item => item.descripcion);
    let resultadosPreTest = dataPreTest.map(item => item.resultado);
    let resultadosPostTest = dataPostTest.map(item => item.resultado);

    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, "#fc4a1a");
    gradientStroke1.addColorStop(1, "#f7b733");

    var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke2.addColorStop(0, "#3bb2b8");
    gradientStroke2.addColorStop(1, "#4776e6");

    barChart = new Chart(ctx, {
        type: "horizontalBar",
        data: {
            labels: nombres,
            datasets: [
                {
                    label: "Pre Test",
                    data: resultadosPreTest,
                    backgroundColor: gradientStroke1,
                    borderColor: gradientStroke1,
                    hoverBackgroundColor: "#fc4a1a",
                    borderWidth: 1,
                },
                {
                    label: "Post Test",
                    data: resultadosPostTest,
                    backgroundColor: gradientStroke2,
                    borderColor: gradientStroke2,
                    hoverBackgroundColor: "#3bb2b8",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                },
            },
        },
    });
}

function updatePaginationButtons() {
    if (currentPage === 1) {
        prevButton.disabled = true;
    } else {
        prevButton.disabled = false;
    }

    if (currentPage === totalPages) {
        nextButton.disabled = true;
    } else {
        nextButton.disabled = false;
    }
}

function setTotalItems(total) {
    totalItems = total;
    totalPages = Math.ceil(totalItems / itemsPerPage);
    updatePaginationButtons();
}

// Inicializar con el pre test
setTotalItems(50);
loadTopProductos(currentPage);
// FIN GRÁFICA TPI

// INICIO GRÁFICA IRS
let currentPageIRS = 1;
let itemsPerPageIRS = 10;
let totalItemsIRS = 0;
let totalPagesIRS = 1;
let barChartIRS = null;
const ctxIRS = document.getElementById("barChartIRS").getContext("2d");
const prevButtonIRS = document.getElementById("prevPageIRS");
const nextButtonIRS = document.getElementById("nextPageIRS");

prevButtonIRS.addEventListener("click", async () => {
    if (currentPageIRS > 1) {
        await loadTopProductosIRS(currentPageIRS - 1);
    }
});

nextButtonIRS.addEventListener("click", async () => {
    if (currentPageIRS < totalPagesIRS) {
        await loadTopProductosIRS(currentPageIRS + 1);
    }
});

async function loadTopProductosIRS(paginaIRS) {
    const urlPreTestIRS = base_url + `admin/topProductosIRS/?pagina=${paginaIRS}&fecha=2023-07-08`;
    const urlPostTestIRS = base_url + `admin/topProductosPostIRS/?pagina=${paginaIRS}&fecha=2023-09-19`;

    try {
        const resPreTestIRS = await fetchData(urlPreTestIRS);
        const resPostTestIRS = await fetchData(urlPostTestIRS);

        if (barChartIRS) {
            barChartIRS.destroy();
        }

        updateBarChartIRS(resPreTestIRS, resPostTestIRS);
        currentPageIRS = paginaIRS;

        updatePaginationButtonsIRS();
    } catch (error) {
        console.error("Error al cargar datos:", error);
    }
}

async function fetchData(urlIRS) {
    return new Promise((resolve, reject) => {
        const http = new XMLHttpRequest();
        http.open("GET", urlIRS, true);
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    resolve(JSON.parse(this.responseText));
                } else {
                    reject("Error en la solicitud");
                }
            }
        };
        http.send();
    });
}

function updateBarChartIRS(dataPreTestIRS, dataPostTestIRS) {
    let nombresIRS = dataPreTestIRS.map(item => item.descripcion);
    let resultadosPreTestIRS = dataPreTestIRS.map(item => item.resultado);
    let resultadosPostTestIRS = dataPostTestIRS.map(item => item.resultado);

    var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke.addColorStop(0, "#2196F3");
    gradientStroke.addColorStop(1, "#0D47A1");

    var gradientStroke4 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke4.addColorStop(0, "#42e695");
    gradientStroke4.addColorStop(1, "#3bb2b8");

    barChartIRS = new Chart(ctxIRS, {
        type: "horizontalBar",
        data: {
            labels: nombresIRS,
            datasets: [
                {
                    label: "Pre Test",
                    data: resultadosPreTestIRS,
                    backgroundColor: gradientStroke,
                    borderColor: gradientStroke,
                    hoverBackgroundColor: "#2196F3",
                    borderWidth: 1,
                },
                {
                    label: "Post Test",
                    data: resultadosPostTestIRS,
                    backgroundColor: gradientStroke4,
                    borderColor: gradientStroke4,
                    hoverBackgroundColor: "#42e695",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                },
            },
        },
    });
}

function updatePaginationButtonsIRS() {
    if (currentPageIRS === 1) {
        prevButtonIRS.disabled = true;
    } else {
        prevButtonIRS.disabled = false;
    }

    if (currentPageIRS === totalPagesIRS) {
        nextButtonIRS.disabled = true;
    } else {
        nextButtonIRS.disabled = false;
    }
}

function setTotalItemsIRS(totalIRS) {
    totalItemsIRS = totalIRS;
    totalPagesIRS = Math.ceil(totalItemsIRS / itemsPerPageIRS);
    updatePaginationButtonsIRS();
}

// Inicializar con el pre test
setTotalItemsIRS(50);
loadTopProductosIRS(currentPageIRS);
// FIN GRÁFICA IRS

// topUsuariosMorris();
// topTransportistasMorris();
// topProveedoresMorris();
// topProductosMorris();

// function topUsuariosMorris() {
//     const url = base_url + 'admin/topUsuariosMorris'; // Suponiendo que '6' es la cantidad que quieres obtener
//     const http = new XMLHttpRequest();

//     http.open("GET", url, true);
//     http.send();

//     http.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             const res = JSON.parse(this.responseText);

//             if (res.length > 0) {
//                 const activos = parseInt(res[0].activos);
//                 const inactivos = parseInt(res[0].inactivos);

//                 let donutData = [
//                     { label: 'Activos', value: activos },
//                     { label: 'Inactivos', value: inactivos }
//                 ];

//                 new Morris.Donut({
//                     element: 'donutUsuarios', // Elemento donde se renderizará el gráfico de donut
//                     data: donutData, // Datos para el gráfico de donut
//                     colors: ['#005cff', '#008cff'],// #6078ea #17ead9
//                     resize: true // Otras opciones que desees incluir para personalizar el gráfico
//                 });
//             }
//         }
//     };
// }

// function topTransportistasMorris() {
//     const url = base_url + 'admin/topTransportistasMorris'; // Suponiendo que '6' es la cantidad que quieres obtener
//     const http = new XMLHttpRequest();

//     http.open("GET", url, true);
//     http.send();

//     http.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             const res = JSON.parse(this.responseText);

//             if (res.length > 0) {
//                 const activos = parseInt(res[0].activos);
//                 const inactivos = parseInt(res[0].inactivos);

//                 let donutData = [
//                     { label: 'Activos', value: activos },
//                     { label: 'Inactivos', value: inactivos }
//                 ];

//                 // Colores definidos en los gradientes lineales
//                 const colors = ['#ee0979', '#ee3979'];

//                 new Morris.Donut({
//                     element: 'donutTransportistas', // Elemento donde se renderizará el gráfico de donut
//                     data: donutData, // Datos para el gráfico de donut
//                     colors: colors.slice(0, donutData.length), // Usamos solo la cantidad de colores necesarios
//                     resize: true // Otras opciones que desees incluir para personalizar el gráfico
//                 });
//             }
//         }
//     };
// }

// function topProveedoresMorris() {
//     const url = base_url + 'admin/topProveedoresMorris'; // Suponiendo que '6' es la cantidad que quieres obtener
//     const http = new XMLHttpRequest();

//     http.open("GET", url, true);
//     http.send();

//     http.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             const res = JSON.parse(this.responseText);

//             if (res.length > 0) {
//                 const activos = parseInt(res[0].activos);
//                 const inactivos = parseInt(res[0].inactivos);

//                 let donutData = [
//                     { label: 'Activos', value: activos },
//                     { label: 'Inactivos', value: inactivos }
//                 ];

//                 new Morris.Donut({
//                     element: 'donutProveedores', // Elemento donde se renderizará el gráfico de donut
//                     data: donutData, // Datos para el gráfico de donut
//                     colors: ['#008080', '#005080'],// #00b09b
//                     resize: true // Otras opciones que desees incluir para personalizar el gráfico
//                 });
//             }
//         }
//     };
// }

// function topProductosMorris() {
//     const url = base_url + 'admin/topProductosMorris/';
//     const http = new XMLHttpRequest();
//     //Abrir una Conexion - POST - GET
//     http.open("GET", url, true);
//     //Enviar Datos
//     http.send();
//     //verificar estados
//     http.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             const res = JSON.parse(this.responseText);

//             let donutData = [];
//             for (let i = 0; i < res.length; i++) {
//                 donutData.push({
//                     label: res[i].descripcion,
//                     value: res[i].cantidad
//                 });
//             }

//             Morris.Donut({
//                 element: 'donutProductos', // Elemento donde se renderizará el gráfico de dona
//                 data: donutData, // Datos para el gráfico de dona
//                 resize: true,
//                 colors: [
//                     '#fc4a1a', '#005cff', '#ee0979', '#22e695'
//                 ],
//             });
//         }
//     };
// }
// pieChart();
// function pieChart() {
//     const url = base_url + 'admin/topProductosMorris/';
//     const http = new XMLHttpRequest();
//     //Abrir una Conexion - POST - GET
//     http.open("GET", url, true);
//     //Enviar Datos
//     http.send();
//     //verificar estados
//     http.onreadystatechange = function () {
//         if (this.readyState == 4 && this.status == 200) {
//             const res = JSON.parse(this.responseText);

//             am5.ready(function () {
//                 // Create root element
//                 // https://www.amcharts.com/docs/v5/getting-started/#Root_element
//                 var root = am5.Root.new("chartdiv");

//                 // Set themes
//                 // https://www.amcharts.com/docs/v5/concepts/themes/
//                 root.setThemes([
//                     am5themes_Animated.new(root)
//                 ]);

//                 // Create chart
//                 // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
//                 var chart = root.container.children.push(
//                     am5percent.PieChart.new(root, {
//                         endAngle: 270,
//                         layout: root.verticalLayout,
//                         innerRadius: am5.percent(60)
//                     })
//                 );

//                 // Create series
//                 // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
//                 var series = chart.series.push(
//                     am5percent.PieSeries.new(root, {
//                         valueField: "value",
//                         categoryField: "category",
//                         endAngle: 270
//                     })
//                 );

//                 series.set("colors", am5.ColorSet.new(root, {
//                     colors: [
//                         am5.color(0x34A853),
//                         am5.color(0x4285F4),
//                         am5.color(0xEA4335),
//                         am5.color(0xFFC107),
//                         // am5.color(0xA95A52),
//                         // am5.color(0xE35B5D),
//                         // am5.color(0xFFA446),
//                         // am5.color(0x009688) verde oscuro
//                     ],
//                     // colorSet1: [
//                     //     am5.color(0x4285F4), // Azul
//                     //     am5.color(0x34A853), // Verde
//                     //     am5.color(0xFBBC05), // Amarillo
//                     //     am5.color(0xEA4335), // Rojo
//                     //     am5.color(0xFF6D00), // Naranja
//                     //     am5.color(0x9C27B0), // Púrpura
//                     //     am5.color(0x3F51B5), // Índigo
//                     // ]
//                 }));

//                 var gradient = am5.RadialGradient.new(root, {
//                     stops: [{
//                         color: am5.color(0x000000)
//                     },
//                     {
//                         color: am5.color(0x000000)
//                     },
//                     {}
//                     ]
//                 });

//                 series.slices.template.setAll({
//                     fillGradient: gradient,
//                     strokeWidth: 2,
//                     stroke: am5.color(0xffffff),
//                     cornerRadius: 10,
//                     shadowOpacity: 0.1,
//                     shadowOffsetX: 2,
//                     shadowOffsetY: 2,
//                     shadowColor: am5.color(0x000000),
//                     fillPattern: am5.GrainPattern.new(root, {
//                         maxOpacity: 0.2,
//                         density: 0.5,
//                         colors: [am5.color(0x000000)]
//                     })
//                 });

//                 series.slices.template.states.create("hover", {
//                     shadowOpacity: 1,
//                     shadowBlur: 10
//                 });

//                 series.ticks.template.setAll({
//                     strokeOpacity: 0.4,
//                     strokeDasharray: [2, 2]
//                 });

//                 series.states.create("hidden", {
//                     endAngle: -90
//                 });

//                 // Set data from API response
//                 var chartData = [];
//                 for (let i = 0; i < res.length; i++) {
//                     chartData.push({
//                         category: `${res[i].descripcion}: ${res[i].cantidad}`, // Descripción + Cantidad
//                         value: res[i].cantidad
//                     });
//                 }
//                 series.data.setAll(chartData);

//                 var legend = chart.children.push(am5.Legend.new(root, {
//                     centerX: am5.percent(50),
//                     x: am5.percent(50),
//                     marginTop: 15,
//                     marginBottom: 15,
//                 }));
//                 legend.markerRectangles.template.adapters.add("fillGradient", function () {
//                     return undefined;
//                 });
//                 legend.data.setAll(series.dataItems);

//                 series.appear(1000, 100);

//             }); // end am5.ready()
//         }
//     };
// }




