const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');

const ruc = document.querySelector('#ruc');
const nombre = document.querySelector('#nombre');
const correo = document.querySelector('#correo');
const telefono = document.querySelector('#telefono');
const direccion = document.querySelector('#direccion');
const foto = document.querySelector('#foto');
const containerPreview = document.querySelector("#containerPreview");

const errorRuc = document.querySelector('#errorRuc');
const errorNombre = document.querySelector('#errorNombre');
const errorTelefono = document.querySelector('#errorTelefono');
const errorCorreo = document.querySelector('#errorCorreo');
const errorDireccion = document.querySelector('#errorDireccion');

document.addEventListener('DOMContentLoaded', function () {
    //Inicializar un Editor
    ClassicEditor
        .create(document.querySelector('#mensaje'), {
            toolbar: {
                items: [
                    'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    'alignment', '|',
                    'link', 'blockQuote', 'insertTable', 'mediaEmbed'
                ],
                shouldNotGroupWhenFull: true
            },
        })
        .catch(error => {
            console.error(error);
        });

    // VISTA PREVIA
    foto.addEventListener("change", function (e) {
        e.preventDefault();
        if (
        e.target.files[0].type == "image/png") {
        const url = e.target.files[0];
        const tmpUrl = URL.createObjectURL(url);
        containerPreview.innerHTML = `<img class="img-thumbnail" src="${tmpUrl}" alt="" width="200"><button class="btn btn-danger" type="button" onclick="deleteImg()"><i class="fas fa-trash"></i> </button>`;
        } else {
            foto.value = '';
        alertaPersonalizada(
            "warning",
            "SÓLO SE PERMITEN IMÁGENES DE TIPO PNG..."
        );
        }
    });

    //actualizar datos
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorRuc.textContent = '';
        errorNombre.textContent = '';
        errorTelefono.textContent = '';
        errorCorreo.textContent = '';
        errorDireccion.textContent = '';
        if (ruc.value == '') {
            errorRuc.textContent = 'EL RUC ES OBLIGATORIO...';
        } else if (nombre.value == '') {
            errorNombre.textContent = 'EL NOMBRE ES OBLIGATORIO...';
        } else if (correo.value == '') {
            errorCorreo.textContent = 'EL CORREO ES OBLIGATORIO...';
        } else if (telefono.value == '') {
            errorTelefono.textContent = 'EL TELEFONO ES OBLIGATORIO...';
        } else if (direccion.value == '') {
            errorDireccion.textContent = 'LA DIRECCIÓN ES OBLIGATORIO...';
        } else {
            const url = base_url + 'admin/modificar';
            insertarRegistros(url, this, null, btnAccion, false);
        }

    })

    function deleteImg() {
        foto.value = '';
        containerPreview.innerHTML = '';
    }
})