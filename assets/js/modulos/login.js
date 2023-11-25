const formulario = document.querySelector('#formulario');
const correo = document.querySelector('#correo');
const clave = document.querySelector('#clave');

const errorCorreo = document.querySelector('#errorCorreo');
const errorClave = document.querySelector('#errorClave');

document.addEventListener('DOMContentLoaded', function () {
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorCorreo.textContent = '';
        errorClave.textContent = '';
        if (correo.value == '') {
            errorCorreo.textContent = 'EL CORREO ES OBLIGATORIO...';
        } else if (clave.value == '') {
            errorClave.textContent = 'LA CONTRASEÑA ES OBLIGATORIO...';
        } else {
            const url = base_url + 'principal/validar';
            //crear formData
            const data = new FormData(this);
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
                        timer: 4000
                    })
                    if (res.type == 'success') {
                        setTimeout(() => {
                            let timerInterval
                            Swal.fire({
                                title: res.msg,
                                html: 'Será redireccionado en <b></b> milliseconds.',
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location = base_url + 'admin';
                                }
                            })
                        }, 2000);
                    }
                }
            }
        }
    });
})