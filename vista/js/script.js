$(document).ready(function () {
    $("#asignarConsultar").click(function () {
        var url = "index.php?accion=consultarPaciente&documento=" + $("#asignarDocumento").val();
        $("#paciente").load(url);
    });

    $("#fecha").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });

    $("#pacNacimiento").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});

function cargarHoras() {
    if ($("#medico").val() === "-1" || $("#fecha").val() === "") {
        $("#hora").html("<option value='-1'>- Seleccione la hora -</option>");
    } else {
        var queryString = "medico=" + $("#medico").val() + "&fecha=" + $("#fecha").val();
        var url = "index.php?accion=consultarHoras&" + queryString;
        $("#hora").load(url);
    }
}

function seleccionarHora() {
    if ($("#medico").val() === "-1") {
        alert("Debe seleccionar un medico");
    } else if ($("#fecha").val() === "") {
        alert("Debe seleccionar una fecha");
    }
}

$(document).on("click", "#btnConsultar", function () {
    var url = "index.php?accion=consultarCita&consultarDocumento=" + $("#consultarDocumento").val();
    $("#paciente2").load(url);
});

$(document).on("click", "#btnCancelar", function () {
    cancelarConsultar();
});

function cancelarConsultar() {
    var url = "index.php?accion=cancelarCita&cancelarDocumento=" + $("#cancelarDocumento").val();
    $("#paciente3").load(url);
}

$(document).on("click", ".btnConfirmar", function (e) {
    e.preventDefault();

    var numero = $(this).data("id");

    if (confirm("¿Está seguro que desea cancelar la cita " + numero + "?")) {
        $.get("index.php", { accion: "confirmarCancelar", numero: numero }, function (mensaje) {
            alert(mensaje);
            cancelarConsultar();
        });
    }
});