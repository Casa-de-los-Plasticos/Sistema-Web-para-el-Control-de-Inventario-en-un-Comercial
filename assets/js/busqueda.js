const inputBuscarCodigo = document.querySelector("#buscarProductoCodigo");
const inputBuscarNombre = document.querySelector("#buscarProductoNombre");
const barcode = document.querySelector("#barcode");
const nombre = document.querySelector("#nombre");
const containerCodigo = document.querySelector("#containerCodigo");
const containerNombre = document.querySelector("#containerNombre");
const errorBusqueda = document.querySelector("#errorBusqueda");

const btnAccion = document.querySelector("#btnAccion");
const totalPagar = document.querySelector("#totalPagar");

//para filtro por rango de fechas
const desde = document.querySelector("#desde");
const hasta = document.querySelector("#hasta");

let listaCarrito, tblHistorial;

document.addEventListener("DOMContentLoaded", function () {
    //comprobar productos en localStorage
    if (localStorage.getItem(nombreKey) != null) {
        listaCarrito = JSON.parse(localStorage.getItem(nombreKey));
    }
    //mostrar input para la busqueda por nombre
    nombre.addEventListener("click", function () {
        containerCodigo.classList.add("d-none");
        containerNombre.classList.remove("d-none");
        inputBuscarNombre.value = "";
        errorBusqueda.textContent = "";
        inputBuscarNombre.focus();
    });
    //mostrar input para la busqueda por codigo
    barcode.addEventListener("click", function () {
        containerNombre.classList.add("d-none");
        containerCodigo.classList.remove("d-none");
        inputBuscarCodigo.value = "";
        errorBusqueda.textContent = "";
        inputBuscarCodigo.focus();
    });

    inputBuscarCodigo.addEventListener("keyup", function (e) {
        if (e.keyCode === 13) {
            buscarProducto(e.target.value);
        }
        return;
    });
    //autocomplete productos
    $("#buscarProductoNombre").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + "productos/buscarPorNombre",
                dataType: "json",
                data: {
                    term: request.term,
                },
                success: function (data) {
                    response(data);
                    if (data.length > 0) {
                        errorBusqueda.textContent = "";
                    } else {
                        errorBusqueda.textContent = "NO HAY PRODUCTO CON ESE NOMBRE...";
                    }
                },
            });
        },
        minLength: 2,
        select: function (event, ui) {
            let precio =
                nombreKey == "posCompra" ? ui.item.precio_compra : ui.item.precio_venta;
            agregarProducto(ui.item.id, 1, ui.item.stock, precio);
            inputBuscarNombre.value = "";
            inputBuscarNombre.focus();
            return false;
        },
    });

    //filtro rango de fechas
    desde.addEventListener("change", function () {
        tblHistorial.draw();
    });
    hasta.addEventListener("change", function () {
        tblHistorial.draw();
    });

    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        var FilterStart = desde.value;
        var FilterEnd = hasta.value;
        var DataTableStart = data[0].trim();
        var DataTableEnd = data[0].trim();
        if (FilterStart == "" || FilterEnd == "") {
            return true;
        }
        if (DataTableStart >= FilterStart && DataTableEnd <= FilterEnd) {
            return true;
        } else {
            return false;
        }
    });
});

function buscarProducto(valor) {
    const url = base_url + "productos/buscarPorCodigo/" + valor;
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
            errorBusqueda.textContent = "";
            if (res.estado) {
                let precio =
                    nombreKey == "posCompra"
                        ? ui.item.precio_compra
                        : ui.item.precio_venta;
                agregarProducto(res.datos.id, 1, res.datos.cantidad, precio);
            } else {
                errorBusqueda.textContent = "EL CÓDIGO NO EXISTE...";
                // alertaPersonalizada('warning', 'CODIGO NO EXISTE...');
            }
            inputBuscarCodigo.value = "";
            inputBuscarCodigo.focus();
        }
    };
}

//agregar productos a localStorage
function agregarProducto(idProducto, cantidad, stockActual, precio) {
    console.log(cantidad);
    console.log(stockActual);
    if (localStorage.getItem(nombreKey) == null) {
        listaCarrito = [];
    } else {
        if (nombreKey === "posVenta" || nombreKey === "posApartados") {
            let cantidadAgregado = 0;
            for (let i = 0; i < listaCarrito.length; i++) {
                if (listaCarrito[i]["id"] == idProducto) {
                    cantidadAgregado =
                        parseInt(listaCarrito[i]["cantidad"]) + parseInt(cantidad);
                }
            }
            // console.log(cantidadAgregado);
            if (
                parseInt(cantidadAgregado) > parseInt(stockActual) ||
                parseInt(stockActual) == 0
            ) {
                alertaPersonalizada("warning", "STOCK NO DISPONIBLE...");
                return;
            }
        }
        for (let i = 0; i < listaCarrito.length; i++) {
            if (listaCarrito[i]["id"] == idProducto) {
                listaCarrito[i]["cantidad"] = parseInt(listaCarrito[i]["cantidad"]) + 1;
                localStorage.setItem(nombreKey, JSON.stringify(listaCarrito));
                alertaPersonalizada("success", "PRODUCTO AGREGADO...");
                mostrarProducto();
                return;
            }
        }
    }

    // SI LISTA CARRITO NO EXISTE
    if (nombreKey === "posVenta" || nombreKey === "posApartados") {
        if (stockActual <= 0) {
            alertaPersonalizada("warning", "STOCK NO DISPONIBLE...");
            return;
        }
    }

    listaCarrito.push({
        id: idProducto,
        cantidad: cantidad,
        precio: precio,
    });
    localStorage.setItem(nombreKey, JSON.stringify(listaCarrito));
    alertaPersonalizada("success", "PRODUCTO AGREGADO...");
    mostrarProducto();
}

//agregar evento click para eliminar
function btnEliminarProducto() {
    let lista = document.querySelectorAll(".btnEliminar");
    for (let i = 0; i < lista.length; i++) {
        lista[i].addEventListener("click", function () {
            let idProducto = lista[i].getAttribute("data-id");
            console.log(idProducto);
            eliminarProducto(idProducto);
        });
    }
}
//eliminar productos del table
function eliminarProducto(idProducto) {
    for (let i = 0; i < listaCarrito.length; i++) {
        if (listaCarrito[i]["id"] == idProducto) {
            listaCarrito.splice(i, 1);
        }
    }
    localStorage.setItem(nombreKey, JSON.stringify(listaCarrito));
    alertaPersonalizada("success", "PRODUCTO ELIMINADO...");
    mostrarProducto();
}

//agregar evento change para cambiar la cantidad
function agregarCantidad() {
    let lista = document.querySelectorAll(".inputCantidad");
    for (let i = 0; i < lista.length; i++) {
        lista[i].addEventListener("change", function () {
            let idProducto = lista[i].getAttribute("data-id");
            let cantidad = lista[i].value;
            cambiarCantidad(idProducto, cantidad);
        });
    }
}

function cambiarCantidad(idProducto, cantidad) {
    if (nombreKey === "posVenta" || nombreKey === "posApartados") {
        const url = base_url + "ventas/verificarStock/" + idProducto;
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
                if (res.cantidad >= cantidad) {
                    for (let i = 0; i < listaCarrito.length; i++) {
                        if (listaCarrito[i]["id"] == idProducto) {
                            listaCarrito[i]["cantidad"] = cantidad;
                        }
                    }
                    localStorage.setItem(nombreKey, JSON.stringify(listaCarrito));
                } else {
                    alertaPersonalizada("warning", "STOCK NO DISPONIBLE...");
                }
                mostrarProducto();
                return;
            }
        };
    } else {
        for (let i = 0; i < listaCarrito.length; i++) {
            if (listaCarrito[i]["id"] == idProducto) {
                listaCarrito[i]["cantidad"] = cantidad;
            }
        }
        localStorage.setItem(nombreKey, JSON.stringify(listaCarrito));
        mostrarProducto();
    }
}

//Precio Editable - Agregar evento change para cambiar la cantidad
function agregarPrecioVenta() {
    let lista = document.querySelectorAll(".inputPrecio");
    for (let i = 0; i < lista.length; i++) {
        lista[i].addEventListener("change", function () {
            let idProducto = lista[i].getAttribute("data-id");
            let precio = lista[i].value;
            cambiarPrecio(idProducto, precio);
        });
    }
}

function cambiarPrecio(idProducto, precio) {
    for (let i = 0; i < listaCarrito.length; i++) {
        if (listaCarrito[i]["id"] == idProducto) {
            listaCarrito[i]["precio"] = precio;
        }
    }
    localStorage.setItem(nombreKey, JSON.stringify(listaCarrito));
    mostrarProducto();
}
