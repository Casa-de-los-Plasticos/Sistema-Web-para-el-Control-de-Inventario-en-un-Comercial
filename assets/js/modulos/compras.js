const tblNuevaCompra = document.querySelector('#tblNuevaCompra tbody');
const formulario = document.querySelector('#formulario');
const btnActualizar = document.querySelector('#btnActualizar');
const serie = document.querySelector('#serie');
//provedores
const telefonoProveedor = document.querySelector('#telefonoProveedor');
const direccionProveedor = document.querySelector('#proveedorDireccion');
const idProveedor = document.querySelector('#idProveedor');
const errorProveedor = document.querySelector('#errorProveedor');

// INICIO EVALUACIÓN
const serieEditar = document.querySelector('#serieEditar');
const nombreEditar = document.querySelector('#nombreEditar');
// const telefono = document.querySelector('#telefono');
const cantidad = document.querySelector('#cantidad');
const proveedor = document.querySelector('#proveedor');
const fecha = document.querySelector('#fecha');
const hora = document.querySelector('#hora');
const id = document.querySelector('#id');

document.addEventListener('DOMContentLoaded', function () {
    //autocomplete proveedores
    $("#buscarProveedor").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'proveedor/buscar',
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                    if (data.length > 0) {
                        errorProveedor.textContent = '';
                    } else {
                        errorProveedor.textContent = 'NO HAY PROVEEDOR CON ESE NOMBRE...';
                    }
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            telefonoProveedor.value = ui.item.telefono;
            direccionProveedor.innerHTML = ui.item.direccion;
            idProveedor.value = ui.item.id;
            serie.focus();
        }
    });

    //cargar datos
    mostrarProducto();

    // //completar compra
    // btnAccion.addEventListener('click', function () {
    //     let filas = document.querySelectorAll('#tblNuevaCompra tr').length;
    //     if (filas < 2) {
    //         alertaPersonalizada('warning', 'CANASTA VACÍA...');
    //         return;
    //     } else if (idProveedor.value == ''
    //         && telefonoProveedor.value == '') {
    //         alertaPersonalizada('warning', 'EL PROVEEDOR ES OBLIGATORIO...');
    //         return;
    //     } else if (serie.value == '') {
    //         alertaPersonalizada('warning', 'LA SERIE ES OBLIGATORIO...');
    //         return;
    //     } else {
    //         const url = base_url + 'compras/registrarCompra';
    //         //hacer una instancia del objeto XMLHttpRequest 
    //         const http = new XMLHttpRequest();
    //         //Abrir una Conexion - POST - GET
    //         http.open('POST', url, true);
    //         //Enviar Datos
    //         http.send(JSON.stringify({
    //             productos: listaCarrito,
    //             idProveedor: idProveedor.value,
    //             serie: serie.value,
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
    //                         //     title: 'Desea Generar Reporte?',
    //                         //     showDenyButton: true,
    //                         //     showCancelButton: true,
    //                         //     cancelButtonColor: '#000',
    //                         //     denyButtonColor: '#eb1623',
    //                         //     confirmButtonColor: '#008cff',
    //                         //     cancelButtonText: '<i class="fas fa-times-circle"></i> '+'Cancelar',
    //                         //     confirmButtonText: '<i class="fas fa-print"></i> '+'Ticked',
    //                         //     denyButtonText: '<i class="fas fa-file-pdf"></i> '+`Factura`,
    //                         // }).then((result) => {
    //                         //     /* Read more about isConfirmed, isDenied below */
    //                         //     if (result.isConfirmed) {
    //                         //         const ruta = base_url + 'compras/reporte/ticked/' + res.idCompra;
    //                         //         window.open(ruta, '_blank');
    //                         //     } else if (result.isDenied) {
    //                         //         const ruta = base_url + 'compras/reporte/factura/' + res.idCompra;
    //                         //         window.open(ruta, '_blank');
    //                         //     }
    //                             window.location.reload();
    //                         // })

    //                     }, 2000);
    //                 }
    //             }
    //         }
    //     }

    // })

    btnAccion.addEventListener('click', function () {
        let filas = document.querySelectorAll('#tblNuevaCompra tr').length;
        if (filas < 2) {
            alertaPersonalizada('warning', 'CANASTA VACÍA...');
            return;
        } else if (idProveedor.value == '' && telefonoProveedor.value == '') {
            alertaPersonalizada('warning', 'EL PROVEEDOR ES OBLIGATORIO...');
            return;
        } else if (serie.value == '') {
            alertaPersonalizada('warning', 'LA SERIE ES OBLIGATORIO...');
            return;
        } else {
            Swal.fire({
                title: '¿ESTÁS SEGURO DE COMPLETAR EL INGRESO?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = base_url + 'compras/registrarCompra';
                    // Hacer una instancia del objeto XMLHttpRequest 
                    const http = new XMLHttpRequest();
                    // Abrir una Conexion - POST - GET
                    http.open('POST', url, true);
                    // Enviar Datos
                    http.send(JSON.stringify({
                        productos: listaCarrito,
                        idProveedor: idProveedor.value,
                        serie: serie.value,
                    }));
                    // Verificar estados
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


    //mostrar historial
    //cargar datos con el plugin datatables
    tblHistorial = $('#tblHistorial').DataTable({
        ajax: {
            url: base_url + 'compras/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'fecha' },
            { data: 'serie' },
            { data: 'productos' },
            { data: 'cantidad' },
            { data: 'nombre' },
            { data: 'hora' },
            // { data: 'total' },
            // { data: 'acciones' },
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
        // <td>${producto.precio_compra}</td>
        // <td>${producto.subTotalCompra}</td>
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                if (res.productos.length > 0) {
                    res.productos.forEach(producto => {
                        html += `<tr>
                            <td>${producto.nombre}</td>
                            <td width="100">
                            <input type="number" class="form-control inputCantidad" data-id="${producto.id}" value="${producto.cantidad}" placeholder="Cantidad">
                            </td>
                            <td><button class="btn btn-danger btnEliminar" data-id="${producto.id}" type="button"><i class="fas fa-trash"></i></button></td>
                        </tr>`;
                    });
                    tblNuevaCompra.innerHTML = html;
                    totalPagar.value = res.totalCompra;
                    btnEliminarProducto();
                    agregarCantidad();
                } else {
                    tblNuevaCompra.innerHTML = '';
                }
            }
        }
    } else {
        tblNuevaCompra.innerHTML = `<tr>
            <td colspan="4" class="text-center">CANASTA VACÍA...</td>
        </tr>`;
    }
}

// INICIO EVALUACIÓN...
function modificarIngreso(idCompra) {
    // limpiarCampos();
    const url = base_url + 'compras/editar/' + idCompra;
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
            serieEditar.value = res.serie;
            nombreEditar.value = res.productos;
            cantidad.value = res.cantidad;
            proveedor.value = res.nombre;
            // fecha.value = res.fecha;
            // hora.value = res.hora; 
            // btnAccion.textContent = 'Actualizar';
            firstTab.show();
            // evaluación...
        }
    }
}

function verReporte(idCompra) {
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
            const ruta = base_url + 'compras/reporte/ticked/' + idCompra;
            window.open(ruta, '_blank');
        } else if (result.isDenied) {
            const ruta = base_url + 'compras/reporte/factura/' + idCompra;
            window.open(ruta, '_blank');
        }
    })
}

function anularCompra(idCompra) {
    Swal.fire({
        title: 'Está seguro de anular la compra?',
        text: "El stock de los productos cambiarán!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Anular!',
        cancelButtonText: 'Cancelar!'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + 'compras/anular/' + idCompra;
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