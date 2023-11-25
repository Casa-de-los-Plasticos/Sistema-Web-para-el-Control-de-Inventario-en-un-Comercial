const modalApartado = new bootstrap.Modal('#modalApartado');
const modalEntrega = new bootstrap.Modal('#modalEntrega');
const fecha_retiro = document.querySelector('#fecha_retiro');
const fecha_apartado = document.querySelector('#fecha_apartado');
const abono = document.querySelector('#abono');
const color = document.querySelector('#color');

const tblNuevaApartado = document.querySelector('#tblNuevoApartado tbody');

const idCliente = document.querySelector('#idCliente');
const telefonoCliente = document.querySelector('#telefonoCliente');
const direccionCliente = document.querySelector('#direccionCliente');
const errorCliente = document.querySelector('#errorCliente');

const idApartado = document.querySelector('#idApartado');
const clienteApartado = document.querySelector('#clienteApartado');
const monto_abonado = document.querySelector('#monto_abonado');
const monto_total = document.querySelector('#monto_total');
const monto_pendiente = document.querySelector('#monto_pendiente');
const btnProcesar = document.querySelector('#btnProcesar');

document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    locale: 'es',
    events: base_url + 'apartados/listar',
    dateClick: function (info) {
      const fechaActual = document.querySelector('#fechaActual').value;
      if (fechaActual > info.dateStr) {
        alertaPersonalizada('warning', 'FECHA PASADA');
        return;
      } else {
        fecha_apartado.value = info.dateStr;
        fecha_retiro.setAttribute('min', fecha_apartado.value);
        modalApartado.show();
      }

    },
    eventClick: function (info) {
      const url = base_url + 'apartados/verDatos/' + info.event.id;
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
          const totalPendiente = parseFloat(res.total) - parseFloat(res.abono);
          idApartado.value = res.id;
          clienteApartado.value = res.nombre;
          monto_abonado.value = res.abono;
          monto_total.value = res.total;
          monto_pendiente.value = totalPendiente.toFixed(2);
          modalEntrega.show();
        }
      }

    }
  });
  calendar.render();

  btnProcesar.addEventListener('click', function () {
    Swal.fire({
      title: 'Esta seguro de procesar?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Procesar!'
    }).then((result) => {
      if (result.isConfirmed) {
        const url = base_url + 'apartados/procesarEntrega/' + idApartado.value;
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
            generarPdf(idApartado.value);
            idApartado.value = '';
            modalEntrega.hide();
          }
        }
      }
    })

  })

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
                    errorCliente.textContent = 'NO HAY CLIENTE...';
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

  //completar apartado
  btnAccion.addEventListener('click', function () {
    let filas = document.querySelectorAll('#tblNuevoApartado tr').length;
    if (filas < 2) {
      alertaPersonalizada('warning', 'CANASTA VACÍA...');
      return;
    } else if (idCliente.value == ''
      && telefonoCliente.value == '') {
      alertaPersonalizada('warning', 'EL CLIENTE ES OBLIGATORIO...');
      return;
    } else if (fecha_apartado.value == '') {
      alertaPersonalizada('warning', 'FECHA APARTADO ES OBLIGATORIO...');
      return;
    } else if (fecha_retiro.value == '') {
      alertaPersonalizada('warning', 'FECHA RETIRO ES OBLIGATORIO...');
      return;
    } else if (abono.value == '') {
      alertaPersonalizada('warning', 'ABONO ES OBLIGATORIO...');
      return;
    } else {
      const url = base_url + 'apartados/registrarApartado';
      //hacer una instancia del objeto XMLHttpRequest 
      const http = new XMLHttpRequest();
      //Abrir una Conexion - POST - GET
      http.open('POST', url, true);
      //Enviar Datos
      http.send(JSON.stringify({
        productos: listaCarrito,
        idCliente: idCliente.value,
        fecha_apartado: fecha_apartado.value,
        fecha_retiro: fecha_retiro.value,
        abono: abono.value,
        color: color.value
      }));
      //verificar estados
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          console.log(this.responseText);
          alertaPersonalizada(res.type, res.msg);
          if (res.type == 'success') {
            localStorage.removeItem(nombreKey);
            generarPdf(res.idApartado);
          }
        }
      }
    }

  })

  //cargar datos con el plugin datatables
  tblHistorial = $('#tblHistorial').DataTable({
    ajax: {
      url: base_url + 'apartados/listarHistorial',
      dataSrc: ''
    },
    columns: [
      { data: 'fecha_create' },
      { data: 'cliente' },
      { data: 'abono' },
      { data: 'total' },
      { data: 'fecha_apartado' },
      { data: 'fecha_retiro' },
      { data: 'estado' },
      { data: 'acciones' },
    ],
    language: {
      url: base_url + 'assets/js/espanol.json'
    },
    dom,
    buttons,
    responsive: true,
    order: [[0, 'asc']],
  });
});

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
            tblNuevaApartado.innerHTML = html;
            totalPagar.value = res.totalVenta;
            btnEliminarProducto();
            agregarCantidad();
            } else {
            tblNuevaApartado.innerHTML = `<tr>
                <td colspan="5" class="text-center">CANASTA VACÍA...</td>
            </tr>`;
            }
        }
        }
    } else {
        tblNuevaApartado.innerHTML = `<tr>
        <td colspan="5" class="text-center">CANASTA VACÍA...</td>
        </tr>`;
    }
}

function generarPdf(idApartado) {
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
                const ruta = base_url + 'apartados/reporte/ticked/' + idApartado;
                window.open(ruta, '_blank');
            } else if (result.isDenied) {
                const ruta = base_url + 'apartados/reporte/factura/' + idApartado;
                window.open(ruta, '_blank');
            }
            window.location.reload();
        })

    }, 2000);
}

function verReporte(idApartado) {
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
        const ruta = base_url + 'apartados/reporte/ticked/' + idApartado;
        window.open(ruta, '_blank');
        } else if (result.isDenied) {
        const ruta = base_url + 'apartados/reporte/factura/' + idApartado;
        window.open(ruta, '_blank');
        }
    })
}