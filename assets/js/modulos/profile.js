const nombre = document.querySelector('#nombrePerfil');
const apellido = document.querySelector('#apellidoPerfil');
const correo = document.querySelector('#correoPerfil');
const telefono = document.querySelector('#telefonoPerfil');
const direccion = document.querySelector('#direccionPerfil');
const btnAccion = document.querySelector('#btnGuardarCambios');
const formularioPerfil = document.querySelector('#formularioPerfil');

document.addEventListener('DOMContentLoaded', function () {
    formularioPerfil.addEventListener('submit', function (e) {
        e.preventDefault();
        if (nombre.value == '') {
            alertaPersonalizada('warning', 'EL NOMBRE ES OBLIGATORIO...');
        } else if (apellido.value == '') {
            alertaPersonalizada('warning', 'EL APELLIDO ES OBLIGATORIO...');
        } else if (correo.value == '') {
            alertaPersonalizada('warning', 'EL CORREO ES OBLIGATORIO...');
        } else if (telefono.value == '') {
            alertaPersonalizada('warning', 'EL TELEFONO ES OBLIGATORIO...');
        } else if (direccion.value == '') {
            alertaPersonalizada('warning', 'LA DIRECCION ES OBLIGATORIO...');
        } else {
            const url = base_url + 'usuarios/modificarDatos';
            //hacer una instancia del objeto XMLHttpRequest 
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open('POST', url, true);
            //Enviar Datos
            http.send(new FormData(this));
            //verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.type, res.msg);
                    if (res.clave) {
                        setTimeout(() => {
                            window.location = base_url + 'usuarios/salir';
                        }, 2000);   
                    }
                    
                }
            }
        }
    })
})