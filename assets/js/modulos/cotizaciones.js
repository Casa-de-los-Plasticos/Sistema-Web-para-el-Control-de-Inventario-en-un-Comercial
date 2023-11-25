// let tblHistorial;
const tblNuevaCotizacion = document.querySelector('#tblNuevaCotizacion tbody');

const idCliente = document.querySelector('#idCliente');
const telefonoCliente = document.querySelector('#telefonoCliente');
const direccionCliente = document.querySelector('#direccionCliente');

const descuento = document.querySelector('#descuento');
const metodo = document.querySelector('#metodo');
const validez = document.querySelector('#validez');

const errorCliente = document.querySelector('#errorCliente');

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

    //completar cotizacion
    btnAccion.addEventListener('click', function () {
        let filas = document.querySelectorAll('#tblNuevaCotizacion tr').length;
        if (filas < 2) {
            alertaPersonalizada('warning', 'CANASTA VACÍA...');
            return;
        } else if (idCliente.value == ''
            && telefonoCliente.value == '') {
            alertaPersonalizada('warning', 'EL CLIENTE ES OBLIGATORIO...');
            return;
        } else if (metodo.value == '') {
            alertaPersonalizada('warning', 'EL MÉTODO ES OBLIGATORIO...');
            return;
        } else if (validez.value == '') {
            alertaPersonalizada('warning', 'LA VALIDÉZ ES OBLIGATORIO...');
            return;
        } else {
            const url = base_url + 'cotizaciones/registrarCotizacion';
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
                validez: validez.value
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
                            Swal.fire({
                                title: 'Desea Generar Reporte?',
                                showDenyButton: true,
                                showCancelButton: true,
                                cancelButtonColor: '#000',
                                denyButtonColor: '#eb1623',
                                confirmButtonColor: '#008cff',
                                cancelButtonText: '<i class="fas fa-times-circle"></i> '+'Cancelar',
                                confirmButtonText: '<i class="fas fa-print"></i> '+'Ticked',
                                denyButtonText: '<i class="fas fa-file-pdf"></i> '+`Factura`,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    const ruta = base_url + 'cotizaciones/reporte/ticked/' + res.idCotizacion;
                                    window.open(ruta, '_blank');
                                } else if (result.isDenied) {
                                    const ruta = base_url + 'cotizaciones/reporte/factura/' + res.idCotizacion;
                                    window.open(ruta, '_blank');
                                }
                                window.location.reload();
                            })

                        }, 2000);
                    }
                }
            }
        }

    })

    //cargar datos con el plugin datatables
    tblHistorial = $('#tblHistorial').DataTable({
        ajax: {
            url: base_url + 'cotizaciones/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'fecha' },
            { data: 'hora' },
            { data: 'total' },
            { data: 'nombre' },
            { data: 'validez' },
            { data: 'metodo' },
            { data: 'acciones' }
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
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                if (res.productos.length > 0) {
                    res.productos.forEach(producto => {
                        html += `<tr>
                            <td>${producto.nombre}</td>
                            <td>${producto.precio_venta}</td>
                            <td width="100">
                            <input type="number" class="form-control inputCantidad" data-id="${producto.id}" value="${producto.cantidad}">
                            </td>
                            <td>${producto.subTotalVenta}</td>
                            <td><button class="btn btn-danger btnEliminar" data-id="${producto.id}" type="button"><i class="fas fa-trash"></i></button></td>
                        </tr>`;
                    });
                    tblNuevaCotizacion.innerHTML = html;
                    totalPagar.value = res.totalVenta;
                    btnEliminarProducto();
                    agregarCantidad();
                } else {
                    tblNuevaCotizacion.innerHTML = '';
                }
            }
        }
    } else {
        tblNuevaCotizacion.innerHTML = `<tr>
            <td colspan="4" class="text-center">CANASTA VACÍA...</td>
        </tr>`;
    }
}

function verReporte(idCotizacion) {
    Swal.fire({
        title: 'Desea Generar Reporte?',
        showDenyButton: true,
        showCancelButton: true,
        cancelButtonColor: '#000',
        denyButtonColor: '#eb1623',
        confirmButtonColor: '#008cff',
        cancelButtonText: '<i class="fas fa-times-circle"></i> '+'Cancelar',
        confirmButtonText: '<i class="fas fa-print"></i> '+'Ticked',
        denyButtonText: '<i class="fas fa-file-pdf"></i> '+`Factura`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            const ruta = base_url + 'cotizaciones/reporte/ticked/' + idCotizacion;
            window.open(ruta, '_blank');
        } else if (result.isDenied) {
            const ruta = base_url + 'cotizaciones/reporte/factura/' + idCotizacion;
            window.open(ruta, '_blank');
        }
    })
}