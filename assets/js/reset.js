const btnAccion = document.querySelector('#btnAccion');
const correo = document.querySelector('#correo');
document.addEventListener('DOMContentLoaded', function(){
    btnAccion.addEventListener('click', function(){
        if (correo.value == '') {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'warning',
                title: 'EL CORREO ES OBLIGATPRIO...',
                showConfirmButton: false,
                timer: 2000
            })
        }else{
            const url = base_url + 'principal/enviarCorreo/' + correo.value;
            //hacer una instancia del objeto XMLHttpRequest 
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open('GET', url, true);
            //Enviar Datos
            http.send();
            //verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: res.type,
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 4000
                    })
                }
            }
        }
    })
})
