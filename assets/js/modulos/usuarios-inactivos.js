let tblUsuarios;
document.addEventListener("DOMContentLoaded", function () {
    // CARGAR DATOS CON EL PULGIN DATATABLES
    tblUsuarios = $("#tblUsuarios").DataTable({
        ajax: {
        url: base_url + "usuarios/listarInactivos",
        dataSrc: "",
        },
        columns: [
        { data: "nombres" },
        { data: "correo" },
        { data: "telefono" },
        { data: "direccion" },
        { data: "rol" },
        { data: "acciones" },
        ],
        language: {
        url: base_url + "assets/js/espanol.json",
        },
        dom,
        buttons,
        responsive: true,
        order: [[0, "asc"]],
    });
})

// FUNCIÓN PARA RESTAURAR EL USUARIO
function restaurarUsuario(idUsuario) {
    const url = base_url + "usuarios/restaurar/" + idUsuario;
    restaurarRegistros(url, tblUsuarios);
}