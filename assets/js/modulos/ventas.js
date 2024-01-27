const tblNuevaVenta = document.querySelector('#tblNuevaVenta tbody');
// const btnAccion = document.querySelector('#btnAccion');


const idCliente = document.querySelector('#idCliente');
const telefonoCliente = document.querySelector('#telefonoCliente');
const direccionCliente = document.querySelector('#direccionCliente');
const errorCliente = document.querySelector('#errorCliente');

const descuento = document.querySelector('#descuento');
const metodo = document.querySelector('#metodo');
const impresion_directa = document.querySelector('#impresion_directa');

// INICIO EVALUACIÓN
const serie = document.querySelector('#serie');
const nombreEditar = document.querySelector('#nombreEditar');
// const telefono = document.querySelector('#telefono');
const cantidad = document.querySelector('#cantidad');
const transportista = document.querySelector('#transportista');
const fecha = document.querySelector('#fecha');
const hora = document.querySelector('#hora');
const id = document.querySelector('#id');


// FIN EVALUACIÓN
document.addEventListener('DOMContentLoaded', function () {
    //cargar productos de localStorage
    mostrarProducto();

    //autocomplete clientes
    $("#buscarCliente").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'clientes/buscar',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                    if (data.length > 0) {
                        errorCliente.textContent = '';
                    } else {
                        errorCliente.textContent = 'NO HAY CLIENTE CON ESE NOMBRE...';
                    }
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            telefonoCliente.value = ui.item.telefono;
            direccionCliente.innerHTML = ui.item.direccion;
            idCliente.value = ui.item.id;
        }
    });

    //completar venta
    // btnAccionesese.addEventListener('click', function () {
    //     let filas = document.querySelectorAll('#tblNuevaVenta tr').length;
    //     if (filas < 2) {
    //         alertaPersonalizada('warning', 'CANASTA VACÍA...');
    //         return;
    //     } else if (metodo.value == '') {
    //         alertaPersonalizada('warning', 'EL METODO ES OBLIGATORIO...');
    //         return;
    //     } else {
    //         const url = base_url + 'ventas/registrarVenta';
    //         //hacer una instancia del objeto XMLHttpRequest 
    //         const http = new XMLHttpRequest();
    //         //Abrir una Conexion - POST - GET
    //         http.open('POST', url, true);
    //         //Enviar Datos
    //         http.send(JSON.stringify({
    //             productos: listaCarrito,
    //             idCliente: idCliente.value,
    //             metodo: metodo.value,
    //             descuento: descuento.value,
    //             impresion: impresion_directa.checked
    //         }));
    //         //verificar estados
    //         http.onreadystatechange = function () {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 const res = JSON.parse(this.responseText);
    //                 console.log(this.responseText);

    //                 alertaPersonalizada(res.type, res.msg);
    //                 if (res.type == 'success') {
    //                     localStorage.removeItem(nombreKey);
    //                     setTimeout(() => {
    //                         // Swal.fire({
    //                         // title: 'Desea Generar Reporte?',
    //                         // showDenyButton: true,
    //                         // showCancelButton: true,
    //                         // cancelButtonColor: '#000',
    //                         // denyButtonColor: '#eb1623',
    //                         // confirmButtonColor: '#008cff',
    //                         // cancelButtonText: '<i class="fas fa-times-circle"></i> '+'Cancelar',
    //                         // confirmButtonText: '<i class="fas fa-print"></i> '+'Ticked',
    //                         // denyButtonText: '<i class="fas fa-file-pdf"></i> '+`Factura`,
    //                         // }).then(() => {
    //                         /* Read more about isConfirmed, isDenied below */
    //                         // if (result.isConfirmed) {
    //                         //     const ruta = base_url + 'ventas/reporte/ticked/' + res.idVenta;
    //                         //     window.open(ruta, '_blank');
    //                         // } else if (result.isDenied) {
    //                         //     const ruta = base_url + 'ventas/reporte/factura/' + res.idVenta;
    //                         //     window.open(ruta, '_blank');
    //                         // }
    //                         window.location.reload();
    //                         // })

    //                     }, 2000);

    //                     // window.location.reload();

    //                 }
    //             }
    //         }
    //     }

    // })

    btnAccion.addEventListener('click', function () {
        let filas = document.querySelectorAll('#tblNuevaVenta tr').length;
        if (filas < 2) {
            alertaPersonalizada('warning', 'CANASTA VACÍA...');
            return;
        } else if (metodo.value == '') {
            alertaPersonalizada('warning', 'EL METODO ES OBLIGATORIO...');
            return;
        } else {
            Swal.fire({
                title: '¿ESTÁS SEGURO DE COMPLETAR EL PEDIDO?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = base_url + 'ventas/registrarVenta';
                    //hacer una instancia del objeto XMLHttpRequest 
                    const http = new XMLHttpRequest();
                    //Abrir una Conexion - POST - GET
                    http.open('POST', url, true);
                    //Enviar Datos
                    http.send(JSON.stringify({
                        productos: listaCarrito,
                        idCliente: idCliente.value,
                        metodo: metodo.value,
                        descuento: descuento.value,
                        impresion: impresion_directa.checked
                    }));
                    //verificar estados
                    http.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            const res = JSON.parse(this.responseText);
                            console.log(this.responseText);

                            alertaPersonalizada(res.type, res.msg);
                            if (res.type == 'success') {
                                localStorage.removeItem(nombreKey);
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            }
                        }
                    }
                }
            })
        }
    })


    //cargar datos con el plugin datatables
    tblHistorial = $('#tblHistorial').DataTable({
        ajax: {
            url: base_url + 'ventas/listar',
            dataSrc: ''
        },
        columns: [
            // { data: 'fecha' },
            // { data: 'hora' },
            // { data: 'total' },
            // { data: 'nombre' },
            // { data: 'serie' },
            // { data: 'metodo' },
            // { data: 'acciones' }


            { data: 'fecha' },
            { data: 'serie' },
            { data: 'productos' },
            { data: 'cantidad' },
            { data: 'nombre' },
            { data: 'hora' },
            // { data: 'total' },
            // { data: 'nombre' },
            // { data: 'metodo' },
            // { data: 'acciones' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'desc']],
    });

})

//cargar productos
function mostrarProducto() {
    if (localStorage.getItem(nombreKey) != null) {
        const url = base_url + 'productos/mostrarDatos';
        //hacer una instancia del objeto XMLHttpRequest 
        const http = new XMLHttpRequest();
        //Abrir una Conexion - POST - GET
        http.open('POST', url, true);
        //Enviar Datos
        http.send(JSON.stringify(listaCarrito));
        //verificar estados


        // <td width="150">
        // <input type="number" class="form-control inputPrecio" data-id="${producto.id}" value="${producto.precio_venta}">
        // </td>

        // <td>${producto.subTotalVenta}</td>
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                if (res.productos.length > 0) {
                    res.productos.forEach(producto => {
                        html += `<tr>
                            <td>${producto.nombre}</td>
                            <td width="100">
                            <input type="number" class="form-control inputCantidad" data-id="${producto.id}" value="${producto.cantidad}">
                            </td>
                            
                            <td><button class="btn btn-danger btnEliminar" data-id="${producto.id}" type="button"><i class="fas fa-trash"></i></button></td>
                        </tr>`;
                    });
                    tblNuevaVenta.innerHTML = html;
                    totalPagar.value = res.totalVenta;
                    btnEliminarProducto();
                    agregarCantidad();
                    agregarPrecioVenta();
                } else {
                    tblNuevaVenta.innerHTML = '';
                }
            }
        }
    } else {
        tblNuevaVenta.innerHTML = `<tr>
            <td colspan="4" class="text-center">CANASTA VACÍA...</td>
        </tr>`;
    }
}

// INICIO EVALUACIÓN...
function modificarSalida(idVenta) {
    // limpiarCampos();
    const url = base_url + 'ventas/editar/' + idVenta;
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
            id.value = res.id;
            serie.value = res.serie;
            nombreEditar.value = res.productos;
            cantidad.value = res.cantidad;
            transportista.value = res.nombre;
            // fecha.value = res.fecha;
            // hora.value = res.hora; 
            btnAccion.textContent = 'Actualizar';
            firstTab.show();
            // evaluación...
        }
    }
}

function verReporte(idVenta) {
    Swal.fire({
        title: 'Desea Generar Reporte?',
        showDenyButton: true,
        showCancelButton: true,
        cancelButtonColor: '#000',
        denyButtonColor: '#eb1623',
        confirmButtonColor: '#008cff',
        cancelButtonText: '<i class="fas fa-times-circle"></i> ' + 'Cancelar',
        confirmButtonText: '<i class="fas fa-print"></i> ' + 'Ticked',
        denyButtonText: '<i class="fas fa-file-pdf"></i> ' + `Factura`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            const ruta = base_url + 'ventas/reporte/ticked/' + idVenta;
            window.open(ruta, '_blank');
        } else if (result.isDenied) {
            const ruta = base_url + 'ventas/reporte/factura/' + idVenta;
            window.open(ruta, '_blank');
        }
    })
}

function anularVenta(idVenta) {
    Swal.fire({
        title: 'Está seguro de anular la venta?',
        text: "El stock de los productos cambiarán!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Anular!',
        cancelButtonText: 'Cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'ventas/anular/' + idVenta;
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
                    alertaPersonalizada(res.type, res.msg);
                    if (res.type == 'success') {
                        tblHistorial.ajax.reload();
                    }
                }
            }
        }
    })
}