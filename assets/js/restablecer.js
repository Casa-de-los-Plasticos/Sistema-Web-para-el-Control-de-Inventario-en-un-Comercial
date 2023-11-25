const btnAccion = document.querySelector('#btnAccion');
const nueva_clave = document.querySelector('#nueva_clave');
const confirmar_clave = document.querySelector('#confirmar_clave');
const token = document.querySelector('#token');

document.addEventListener('DOMContentLoaded', function () {
    btnAccion.addEventListener('click', function () {
        if (nueva_clave.value == '' || confirmar_clave.value == '') {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'warning',
                title: 'TODO LOS CAMPOS CON * SON OBLIGATORIOS...',
                showConfirmButton: false,
                timer: 2000
            })
        } else {
            if (nueva_clave.value != confirmar_clave.value) {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'warning',
                    title: 'LAS CONTRASEÑAS NO COINCIDEN...',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                const url = base_url + 'principal/cambiarClave';
                //hacer una instancia del objeto XMLHttpRequest 
                const http = new XMLHttpRequest();
                //Abrir una Conexion - POST - GET
                http.open('POST', url, true);
                //Enviar Datos
                http.send(JSON.stringify({
                    nueva: nueva_clave.value,
                    confirmar: confirmar_clave.value,
                    token: token.value,
                }));
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
                            timer: 3000
                        })
                        if (res.type == 'success') {
                            setTimeout(() => {
                                window.location = base_url;
                            }, 3000);
                        }
                    }
                }
            }
        }
    })
})