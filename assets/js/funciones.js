const firstTabEl = document.querySelector('#nav-tab button:last-child')
const firstTab = new bootstrap.Tab(firstTabEl)

const primerTabEl = document.querySelector('#nav-tab button:first-child')
const primerTab = new bootstrap.Tab(primerTabEl)

function insertarRegistros(url, idFormulario, tbl, idButton, accion) {
    //crear formData
    const data = new FormData(idFormulario);
    //hacer una instancia del objeto XMLHttpRequest 
    const http = new XMLHttpRequest();
    //Abrir una Conexion - POST - GET
    http.open('POST', url, true);
    //Enviar Datos
    http.send(data);
    //verificar estados
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: res.type,
                title: res.msg,
                showConfirmButton: false,
                timer: 2000
            })
            if (res.type == 'success') {
                if (accion) {
                    clave.removeAttribute('readonly');
                }
                if (tbl != null) {
                    document.querySelector('#id').value = '';
                    idButton.textContent = 'Registrar';
                    idFormulario.reset();
                    tbl.ajax.reload();
                    primerTab.show();
                }
            }
        }
    }
}

function eliminarRegistros(url, tbl) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El registro no se eliminará de forma permanente, solo cambiará el estado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
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
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if (res.type == 'success') {
                        tbl.ajax.reload();
                    }
                }
            }
        }
    })
}

function restaurarRegistros(url, tbl) {
    Swal.fire({
        title: 'Esta seguro de restaurar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Restaurar!'
    }).then((result) => {
        if (result.isConfirmed) {
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
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 2000
                    })
                    if (res.type == 'success') {
                        tbl.ajax.reload();
                    }
                }
            }
        }
    })
}

function alertaPersonalizada(type, msg) {
    Swal.fire({
        toast: true,
        position: 'top-right',
        icon: type,
        title: msg,
        showConfirmButton: false,
        timer: 2000
    })
}