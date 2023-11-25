$(function () {
    "use strict";
});

// INICIO PRE TEST TASA DE PRECISIÓN DE INVENTARIO
let currentPage = 1;
let itemsPerPage = 15; // Cantidad de registros por página
let totalItems = 0; // Número total de registros
let totalPages = 1; // Número total de páginas
let barChart = null;
const ctx = document.getElementById("barChart").getContext("2d");
const prevButton = document.getElementById("prevPage");
const nextButton = document.getElementById("nextPage");
setTotalItems(50);
prevButton.addEventListener("click", () => {
    if (currentPage > 1) {
        loadTopProductos(currentPage - 1);
    }
});

nextButton.addEventListener("click", () => {
    if (currentPage < totalPages) {
        loadTopProductos(currentPage + 1);
    }
});

function loadTopProductos(pagina) {
    const url = base_url + `consolidado/topProductos/?pagina=${pagina}`;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);

            if (barChart) {
                barChart.destroy();
            }

            updateBarChart(res);
            currentPage = pagina;

            updatePaginationButtons();
        }
    };
}

function updateBarChart(data) {
    let nombres = data.map(item => item.descripcion);
    let resultados = data.map(item => item.resultado);

    var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke1.addColorStop(0, "#fc4a1a");
    gradientStroke1.addColorStop(1, "#f7b733");

    barChart = new Chart(ctx, {
        type: "horizontalBar",
        data: {
            labels: nombres,
            datasets: [
                {
                    label: "Resultado",
                    data: resultados,
                    backgroundColor: gradientStroke1,
                    borderColor: gradientStroke1,
                    hoverBackgroundColor: gradientStroke1,
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

loadTopProductos(currentPage);
// FIN PRE TEST TASA DE PRECISIÓN DE INVENTARIO

// INICIO POST TEST TASA DE PRECISIÓN DE INVENTARIO
let currentPagePost = 1;
let itemsPerPagePost = 15; // Cantidad de registros por página
let totalItemsPost = 0; // Número total de registros
let totalPagesPost = 1; // Número total de páginas
let barChartPost = null;
const ctxPost = document.getElementById("barChartPost").getContext("2d");
const prevButtonPost = document.getElementById("prevPagePost");
const nextButtonPost = document.getElementById("nextPagePost");
setTotalItemsPost(50);
prevButtonPost.addEventListener("click", () => {
    if (currentPagePost > 1) {
        loadTopProductosPost(currentPagePost - 1);
    }
});

nextButtonPost.addEventListener("click", () => {
    if (currentPagePost < totalPagesPost) {
        loadTopProductosPost(currentPagePost + 1);
    }
});

function loadTopProductosPost(paginaPost) {
    const urlPost = base_url + `consolidado/topProductosPost/?pagina=${paginaPost}`;
    const http = new XMLHttpRequest();
    http.open("GET", urlPost, true);
    http.send();

    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const resPost = JSON.parse(this.responseText);

            if (barChartPost) {
                barChartPost.destroy();
            }

            updateBarChartPost(resPost);
            currentPagePost = paginaPost;

            updatePaginationButtonsPost();
        }
    };
}

function updateBarChartPost(dataPost) {
    let nombresPost = dataPost.map(item => item.descripcion);
    let resultadosPost = dataPost.map(item => item.resultado);

    var gradientStroke = ctx.createLinearGradient(0, 0, 0, 300);
    gradientStroke.addColorStop(0, "#8B0000");
    gradientStroke.addColorStop(1, "#E32636");

    barChartPost = new Chart(ctxPost, {
        type: "horizontalBar",
        data: {
            labels: nombresPost,
            datasets: [
                {
                    label: "Resultado",
                    data: resultadosPost,
                    backgroundColor: gradientStroke,
                    borderColor: gradientStroke,
                    hoverBackgroundColor: gradientStroke,
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

function updatePaginationButtonsPost() {
    if (currentPagePost === 1) {
        prevButtonPost.disabled = true;
    } else {
        prevButtonPost.disabled = false;
    }

    if (currentPagePost === totalPagesPost) {
        nextButtonPost.disabled = true;
    } else {
        nextButtonPost.disabled = false;
    }
}

function setTotalItemsPost(totalPost) {
    totalItemsPost = totalPost;
    totalPagesPost = Math.ceil(totalItemsPost / itemsPerPagePost);
    updatePaginationButtonsPost();
}

loadTopProductosPost(currentPagePost);

function generarNumero(numero) {
    return Math.floor(Math.random() * numero);
}

function colorRGBA(ctx) {
    var color1 = "rgba(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    var color2 = "rgba(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";

    var gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, color1);
    gradient.addColorStop(1, color2);

    return gradient;
}
// FIN POST TEST TASA DE PRECISIÓN DE INVENTARIO
