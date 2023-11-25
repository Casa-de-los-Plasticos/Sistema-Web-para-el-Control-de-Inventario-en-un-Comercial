let tblMesas, editorDireccion, editorDireccionDos;

const formulario = document.querySelector('#formulario');
const btnAccion = document.querySelector('#btnAccion');

const titulo = document.querySelector('#mesaTitle');

const modalMesaUno = new bootstrap.Modal('#modalMesaUno');

// RECUPERAR DATOS DEL CLIENTE DENTRO DEL MODAL MESA UNO
const tiempo = document.querySelector('#tiempo');
const monto = document.querySelector('#monto');
const id = document.querySelector('#id');
const idCliente = document.querySelector('#idCliente');
const cliente = document.querySelector('#buscarCliente');
const fecha = document.querySelector('#fecha');
const mesa = document.querySelector('#mesa');
const telefonoCliente = document.querySelector('#telefonoCliente');
const direccionCliente = document.querySelector('#direccionCliente');
// FIN CÓDIGO RECUPERAR DATOS DEL CLIENTE DENTRO DEL MODAL MESA UNO

// MOSTRAR ERROR AL ENCONTRAR CAMPOS VACÍOS MESA UNO
const errorCliente = document.querySelector('#errorCliente');
const errorMonto = document.querySelector('#errorMonto');
const errorTiempo = document.querySelector('#errorTiempo');

document.addEventListener('DOMContentLoaded', function () {
    if($("#comprobarMesaUno").html()=="") {
        alert("La MESA Uno se Encuentra vacío");
    } else {
        // INICIO CÓDIGO TEMPORIZADOR MESA UNO
    var start = document.getElementById('start');
    var reset = document.getElementById('reset');
    var pause = document.getElementById('pause');
    var h = document.getElementById("hour");
    var m = document.getElementById("minute");
    var s = document.getElementById("sec");
    // Select timeout Audio element
    const timeoutAudio = document.getElementById("timeout_audio");
    //store a reference to the startTimer variable
    // clearInterval(startTimer);
    // localStorage.getItem('islog');

    if (localStorage.getItem('Hora') != null) {
        h.value = JSON.parse(localStorage.getItem('Hora'));
    }
    if (localStorage.getItem('Minuto') != null) {
        m.value = JSON.parse(localStorage.getItem('Minuto'));
    }
    if (localStorage.getItem('Segundo') != null) {
        s.value = JSON.parse(localStorage.getItem('Segundo'));
    }
    var startTimer = null;
    start.addEventListener('click', function () {
        function startInterval() {
            startTimer = setInterval(function () {
                timer();
            }, 1000);
        }
        ocultarElemento(start);
        mostrarElemento(pause);
        startInterval();
    })

    reset.addEventListener('click', function () {
        h.value = 0;
        m.value = 0;
        s.value = 0;
        //stop the timer after pressing "reset"
        stopInterval(timeoutAudio);
        mostrarElemento(start);
        localStorage.clear();
        timeoutAudio.pause();
        // document.getElementById("timeout_audio").setAttribute("src", "");
        // document.getElementById("timeout_audio").setAttribute("src", "views/mesas/inspirational.mp3");
        // document.getElementById("timeout_audio").removeAttribute("src");
    })

    pause.addEventListener('click', function () {
        clearInterval(startTimer);
        mostrarElemento(start);
        ocultarElemento(pause);
        timeoutAudio.pause(); // PAUSAR EL SONIDO DE LA MÚSICA
    })

    const ocultarElemento = (elemento) => {
        elemento.style.display = "none";
    };

    const mostrarElemento = (elemento) => {
        elemento.style.display = "";
    };
    // timeoutAudio.src = "http://soundbible.com/grab.php?id=1252&type=mp3";
    // timeoutAudio.src = "http://soundbible.com/grab.php?id=1252&type=mp3";
    // timeoutAudio.src = "http://soundbible.com/grab.php?id=2049&type=mp3";
    // timeoutAudio.src = "http://soundbible.com/grab.php?id=2197&type=mp3";
    timeoutAudio.load();
    function timer() {
        if (h.value == 0 && m.value == 0 && s.value == 0) {
            h.value = 0;
            m.value = 0;
            s.value = 0;
            stopInterval();
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'success',
                title: 'Tiempo Completado Mesa 1...',
                showConfirmButton: false,
                timer: 4000
            })
        } else if (s.value != 0) {
            s.value--;
        } else if (m.value != 0 && s.value == 0) {
            s.value = 59;
            m.value--;
        } else if (h.value != 0 && m.value == 0) {
            m.value = 60;
            h.value--;
        }

        console.log(localStorage.getItem('Hora'))
        console.log(localStorage.getItem('Minuto'))
        console.log(localStorage.getItem('Segundo'))

        localStorage.setItem('Hora', JSON.parse(h.value));
        localStorage.setItem('Minuto', JSON.parse(m.value));
        localStorage.setItem('Segundo', JSON.parse(s.value));
        // localStorage.setItem('offT', (new Date()).getTime());

        // const horas = localStorage.getItem('Hora', 'Minuto', 'Segundo');
        // localStorage.innerHTML = horas;
        if (h.value == 0 && m.value == 0 && s.value == 0) {
            localStorage.clear();
            // localStorage.removeItem('Hora');
            // localStorage.removeItem('Minuto');
            // localStorage.removeItem('Segundo');
        }
        return;
    }

    //stop the function after pressing the reset button, 
    //so the time wont go down when selecting a new time after pressing reset
    function stopInterval() {
        timeoutAudio.play();
        clearInterval(startTimer);
    };
    // FIN CÓDIGO TEMPORIZADOR MESA UNO
    } if ($("#comprobarMesaDos").html()=="") {
        alert("La MESA Dos se Encuentra vacío");
    } else {
        // INICIO CÓDIGO TEMPORIZADOR MESA DOS
        var startDos = document.getElementById('startDos');
        var resetDos = document.getElementById('resetDos');
        var pauseDos = document.getElementById('pauseDos');
        var hDos = document.getElementById("hourDos");
        var mDos = document.getElementById("minuteDos");
        var sDos = document.getElementById("secDos");
        // Select timeout Audio element
        const timeoutAudioDos = document.getElementById("timeout_audioDos");

        if (localStorage.getItem('HoraDos') != null) {
            hDos.value = JSON.parse(localStorage.getItem('HoraDos'));
        }
        if (localStorage.getItem('MinutoDos') != null) {
            mDos.value = JSON.parse(localStorage.getItem('MinutoDos'));
        }
        if (localStorage.getItem('SegundoDos') != null) {
            sDos.value = JSON.parse(localStorage.getItem('SegundoDos'));
        }
        var startTimerDos = null;
        startDos.addEventListener('click', function () {
            function startInterval() {
                startTimerDos = setInterval(function () {
                    timer();
                }, 1000);
            }
            ocultarElementoDos(startDos);
            mostrarElementoDos(pauseDos);
            startInterval();
        })

        resetDos.addEventListener('click', function () {
            hDos.value = 0;
            mDos.value = 0;
            sDos.value = 0;
            //stop the timer after pressing "reset"
            stopInterval(timeoutAudioDos);
            mostrarElementoDos(startDos);
            localStorage.clear();
            timeoutAudioDos.pause();
        })

        pauseDos.addEventListener('click', function () {
            clearInterval(startTimerDos);
            mostrarElementoDos(startDos);
            ocultarElementoDos(pauseDos);
            timeoutAudioDos.pause(); // PAUSAR EL SONIDO DE LA MÚSICA
        })

        const ocultarElementoDos = (elemento) => {
            elemento.style.display = "none";
        };

        const mostrarElementoDos = (elemento) => {
            elemento.style.display = "";
        };
        timeoutAudioDos.load();
        function timer() {
            if (hDos.value == 0 && mDos.value == 0 && sDos.value == 0) {
                hDos.value = 0;
                mDos.value = 0;
                sDos.value = 0;
                stopInterval();
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'success',
                    title: 'Tiempo Completado Mesa 2...',
                    showConfirmButton: false,
                    timer: 10000
                })
            } else if (sDos.value != 0) {
                sDos.value--;
            } else if (mDos.value != 0 && sDos.value == 0) {
                sDos.value = 59;
                mDos.value--;
            } else if (hDos.value != 0 && mDos.value == 0) {
                mDos.value = 60;
                hDos.value--;
            }

            console.log(localStorage.getItem('HoraDos'))
            console.log(localStorage.getItem('MinutoDos'))
            console.log(localStorage.getItem('SegundoDos'))

            localStorage.setItem('HoraDos', JSON.parse(hDos.value));
            localStorage.setItem('MinutoDos', JSON.parse(mDos.value));
            localStorage.setItem('SegundoDos', JSON.parse(sDos.value));
            
            if (hDos.value == 0 && mDos.value == 0 && sDos.value == 0) {
                localStorage.clear();
            }
            return;
        }
        //stop the function after pressing the reset button, 
        //so the time wont go down when selecting a new time after pressing reset
        function stopInterval() {
            timeoutAudioDos.play();
            clearInterval(startTimerDos);
        };
        // FIN CÓDIGO TEMPORIZADOR MESA DOS
    } if($("#comprobarMesaTres").html()=="") {
        alert("La MESA Tres se Encuentra vacío");
    } else {
        // INICIO CÓDIGO TEMPORIZADOR MESA TRES
        var startTres = document.getElementById('startTres');
        var resetTres = document.getElementById('resetTres');
        var pauseTres = document.getElementById('pauseTres');
        var hTres = document.getElementById("hourTres");
        var mTres = document.getElementById("minuteTres");
        var sTres = document.getElementById("secTres");
        // Select timeout Audio element
        const timeoutAudioTres = document.getElementById("timeout_audioTres");

        if (localStorage.getItem('HoraTres') != null) {
            hTres.value = JSON.parse(localStorage.getItem('HoraTres'));
        }
        if (localStorage.getItem('MinutoTres') != null) {
            mTres.value = JSON.parse(localStorage.getItem('MinutoTres'));
        }
        if (localStorage.getItem('SegundoTres') != null) {
            sTres.value = JSON.parse(localStorage.getItem('SegundoTres'));
        }
        var startTimerTres = null;
        startTres.addEventListener('click', function () {
            function startInterval() {
                startTimerTres = setInterval(function () {
                    timer();
                }, 1000);
            }
            ocultarElementoTres(startTres);
            mostrarElementoTres(pauseTres);
            startInterval();
        })

        resetTres.addEventListener('click', function () {
            hTres.value = 0;
            mTres.value = 0;
            sTres.value = 0;
            //stop the timer after pressing "reset"
            stopInterval(timeoutAudioTres);
            mostrarElementoTres(startTres);
            localStorage.clear();
            timeoutAudioTres.pause();
        })

        pauseTres.addEventListener('click', function () {
            clearInterval(startTimerTres);
            mostrarElementoTres(startTres);
            ocultarElementoTres(pauseTres);
            timeoutAudioTres.pause(); // PAUSAR EL SONIDO DE LA MÚSICA
        })

        const ocultarElementoTres = (elemento) => {
            elemento.style.display = "none";
        };

        const mostrarElementoTres = (elemento) => {
            elemento.style.display = "";
        };
        
        timeoutAudioTres.load();
        function timer() {
            if (hTres.value == 0 && mTres.value == 0 && sTres.value == 0) {
                hTres.value = 0;
                mTres.value = 0;
                sTres.value = 0;
                stopInterval();
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'success',
                    title: 'Tiempo Completado Mesa 3...',
                    showConfirmButton: false,
                    timer: 10000
                })
            } else if (sTres.value != 0) {
                sTres.value--;
            } else if (mTres.value != 0 && sTres.value == 0) {
                sTres.value = 59;
                mTres.value--;
            } else if (hTres.value != 0 && mTres.value == 0) {
                mTres.value = 60;
                hTres.value--;
            }

            console.log(localStorage.getItem('HoraTres'))
            console.log(localStorage.getItem('MinutoTres'))
            console.log(localStorage.getItem('SegundoTres'))

            localStorage.setItem('HoraTres', JSON.parse(hTres.value));
            localStorage.setItem('MinutoTres', JSON.parse(mTres.value));
            localStorage.setItem('SegundoTres', JSON.parse(sTres.value));

            if (hTres.value == 0 && mTres.value == 0 && sTres.value == 0) {
                localStorage.clear();
            }
            return;
        }
        //stop the function after pressing the reset button, 
        //so the time wont go down when selecting a new time after pressing reset
        function stopInterval() {
            timeoutAudioTres.play();
            clearInterval(startTimerTres);
        };
        // FIN CÓDIGO TEMPORIZADOR MESA TRES
    } if($("#comprobarMesaCuatro").html()=="") {
        alert("La MESA Cuatro se Encuentra vacío");
    } else {
        // INICIO CÓDIGO TEMPORIZADOR MESA CUATRO
        var startCuatro = document.getElementById('startCuatro');
        var resetCuatro = document.getElementById('resetCuatro');
        var pauseCuatro = document.getElementById('pauseCuatro');
        var hCuatro = document.getElementById("hourCuatro");
        var mCuatro = document.getElementById("minuteCuatro");
        var sCuatro = document.getElementById("secCuatro");
        // Select timeout Audio element
        const timeoutAudioCuatro = document.getElementById("timeout_audioCuatro");

        if (localStorage.getItem('HoraCuatro') != null) {
            hCuatro.value = JSON.parse(localStorage.getItem('HoraCuatro'));
        }
        if (localStorage.getItem('MinutoCuatro') != null) {
            mCuatro.value = JSON.parse(localStorage.getItem('MinutoCuatro'));
        }
        if (localStorage.getItem('SegundoCuatro') != null) {
            sCuatro.value = JSON.parse(localStorage.getItem('SegundoCuatro'));
        }
        var startTimerCuatro = null;
        startCuatro.addEventListener('click', function () {
            function startInterval() {
                startTimerCuatro = setInterval(function () {
                    timer();
                }, 1000);
            }
            ocultarElementoCuatro(startCuatro);
            mostrarElementoCuatro(pauseCuatro);
            startInterval();
        })

        resetCuatro.addEventListener('click', function () {
            hCuatro.value = 0;
            mCuatro.value = 0;
            sCuatro.value = 0;
            //stop the timer after pressing "reset"
            stopInterval(timeoutAudioCuatro);
            mostrarElementoCuatro(startCuatro);
            localStorage.clear();
            timeoutAudioCuatro.pause();
        })

        pauseCuatro.addEventListener('click', function () {
            clearInterval(startTimerCuatro);
            mostrarElementoCuatro(startCuatro);
            ocultarElementoCuatro(pauseCuatro);
            timeoutAudioCuatro.pause(); // PAUSAR EL SONIDO DE LA MÚSICA
        })

        const ocultarElementoCuatro = (elemento) => {
            elemento.style.display = "none";
        };

        const mostrarElementoCuatro = (elemento) => {
            elemento.style.display = "";
        };
        timeoutAudioCuatro.load();
        function timer() {
            if (hCuatro.value == 0 && mCuatro.value == 0 && sCuatro.value == 0) {
                hCuatro.value = 0;
                mCuatro.value = 0;
                sCuatro.value = 0;
                stopInterval();
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'success',
                    title: 'Tiempo Completado Mesa 4...',
                    showConfirmButton: false,
                    timer: 10000
                })
            } else if (sCuatro.value != 0) {
                sCuatro.value--;
            } else if (mCuatro.value != 0 && sCuatro.value == 0) {
                sCuatro.value = 59;
                mCuatro.value--;
            } else if (hCuatro.value != 0 && mCuatro.value == 0) {
                mCuatro.value = 60;
                hCuatro.value--;
            }

            console.log(localStorage.getItem('HoraCuatro'))
            console.log(localStorage.getItem('MinutoCuatro'))
            console.log(localStorage.getItem('SegundoCuatro'))

            localStorage.setItem('HoraCuatro', JSON.parse(hCuatro.value));
            localStorage.setItem('MinutoCuatro', JSON.parse(mCuatro.value));
            localStorage.setItem('SegundoCuatro', JSON.parse(sCuatro.value));

            if (hCuatro.value == 0 && mCuatro.value == 0 && sCuatro.value == 0) {
                localStorage.clear();
            }
            return;
        }
        //stop the function after pressing the reset button, 
        //so the time wont go down when selecting a new time after pressing reset
        function stopInterval() {
            timeoutAudioCuatro.play();
            clearInterval(startTimerCuatro);
        };
        // FIN CÓDIGO TEMPORIZADOR MESA CUATRO
    }
    //cargar datos con el plugin datatables

    tblMesas = $('#tblMesas').DataTable({
        ajax: {
            url: base_url + 'mesas/listar',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'tiempo' },
            { data: 'monto' },
            { data: 'cliente' },
            { data: 'fecha' },
            { data: 'mesa' },
            { data: 'acciones' }
        ],
        language: {
            url: base_url + 'assets/js/espanol.json'
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, 'asc']],
    });
    // Inicializar un Editor
    ClassicEditor
        .create(document.querySelector('#direccionCliente'), {
            placeholder: 'Ingrese la Dirección...',
            toolbar: {
                items: [
                    'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic',
                    'undo', 'redo'
                ],
                shouldNotGroupWhenFull: true
            },
        })
        .then(editor => {
            editorDireccion = editor
        })
        .catch(error => {
            console.error(error);
        });

    //limpiar campos
    btnMesaUno.addEventListener('click', function () {
        modalMesaUno.show();
        titulo.textContent = 'MESA UNO';
        id.value = '';
        btnAccion.textContent = 'Separar';
        editorDireccion.setData('');
        formulario.reset();
        limpiarCampos();
        $('#mesa > option[value="MESA 1"]').removeAttr('disabled', 'disabled');
        $('#mesa > option[value="MESA 2"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 3"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 4"]').attr('disabled', 'disabled');
    })
    btnMesaDos.addEventListener('click', function () {
        modalMesaUno.show();
        titulo.textContent = 'MESA DOS';
        id.value = '';
        btnAccion.textContent = 'Separar';
        editorDireccion.setData('');
        formulario.reset();
        limpiarCampos();
        $('#mesa > option[value="MESA 1"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 3"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 4"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 2"]').removeAttr('disabled', 'disabled');
    })
    btnMesaTres.addEventListener('click', function () {
        modalMesaUno.show();
        titulo.textContent = 'MESA TRES';
        id.value = '';
        btnAccion.textContent = 'Separar';
        editorDireccion.setData('');
        formulario.reset();
        limpiarCampos();
        $('#mesa > option[value="MESA 1"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 2"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 4"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 3"]').removeAttr('disabled', 'disabled');
    })
    btnMesaCuatro.addEventListener('click', function () {
        modalMesaUno.show();
        titulo.textContent = 'MESA CUATRO';
        id.value = '';
        btnAccion.textContent = 'Separar';
        editorDireccion.setData('');
        formulario.reset();
        limpiarCampos();
        $('#mesa > option[value="MESA 1"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 2"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 3"]').attr('disabled', 'disabled');
        $('#mesa > option[value="MESA 4"]').removeAttr('disabled', 'disabled');
    })

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
        minLength: 1,
        select: function (event, ui) {
            telefonoCliente.value = ui.item.telefono;
            //   direccionCliente.innerHTML = ui.item.direccion;
            editorDireccion.setData(ui.item.direccion);
            idCliente.value = ui.item.id;
        }
    });

    //Registrar Mesa Uno
    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        errorMonto.textContent = '';
        errorTiempo.textContent = '';
        if (idCliente.value == '') {
            errorCliente.textContent = 'EL CLIENTE ES OBLIGATORIO...';
        } else if (monto.value == '') {
            errorMonto.textContent = 'EL MONTO ES OBLIGATORIO...';
        } else if (tiempo.value == '') {
            errorTiempo.textContent = 'EL TIEMPO ES OBLIGATORIO...';
        } else {
            //crear formData
            let data = new FormData(this);
            const url = base_url + 'mesas/registrar';
            //hacer una instancia del objeto XMLHttpRequest 
            const http = new XMLHttpRequest();
            //Abrir una Conexion - POST - GET
            http.open('POST', url, true);
            //Enviar Datos
            http.send(data);
            //verificar estados
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertaPersonalizada(res.type, res.msg);
                    formulario.reset();
                    tblMesas.ajax.reload();
                    primerTab.show();
                    limpiarCampos();
                    modalMesaUno.hide();
                }
            }
        }

    })
})

// INICIO DEL CÓDIGO PARA TRAER DATOS SEGÚN LO SELECCIONADO

function selectNit(e) {
    var nit = e.target.selectedOptions[0].getAttribute("data-nit")
    document.getElementById("monto").value = nit;
}

// function buttonsClick(btn) {
//     if (btn.getAttribute('data-attr') === "start") {
//         //    startInterval();
//     } else if (btn.getAttribute('data-attr') === "startDos") {

//     } else if (btn.getAttribute('data-attr') === "startTres"){

//     }
// }

// FIN DEL CÓDIGO PARA TRAER DATOS SEGÚN LO SELECCIONADO

function editarMesa(idMesa) {
    limpiarCampos();
    const url = base_url + 'mesas/editar/' + idMesa;
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
            id.value = res.id;
            idCliente.value = res.id;
            tiempo.value = res.tiempo;
            monto.value = res.monto;
            cliente.value = res.nombre;
            fecha.value = res.fecha;
            mesa.value = res.mesa;
            telefonoCliente.value = res.telefono;
            // direccionCliente.value = res.direccion;
            editorDireccion.setData(res.direccion);

            btnAccion.textContent = 'Actualizar';
            modalMesaUno.show();

        }
    }
}

function eliminarMesa(idMesa) {
    const url = base_url + 'mesas/eliminar/' + idMesa;
    eliminarRegistros(url, tblMesas);
}

function limpiarCampos() {
    errorCliente.textContent = '';
    errorMonto.textContent = '';
    errorTiempo.textContent = '';

    // tiempo.textContent = '';
    monto.textContent = '';
    cliente.textContent = '';
    telefonoCliente.textContent = '';
    direccionCliente.textContent = '';
    // direccionCliente.textContent = '';
}