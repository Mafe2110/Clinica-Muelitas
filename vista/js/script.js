$(document).ready(function () {
    if ($("#asignarConsultar").length) {
        $("#asignarConsultar").on("click", function () {
            var url = "index.php?accion=consultarPaciente&documento=" + $("#asignarDocumento").val();
            $("#paciente").load(url);
        });
    }

    if ($("#frmPaciente").length && $.fn.dialog) {
        $("#frmPaciente").dialog({
            autoOpen: false,
            height: 310,
            width: 400,
            modal: true,
            buttons: {
                "Insertar": insertarPaciente,
                "Cancelar": cerrarPaciente
            }
        });
    }

    if ($("#pacNacimiento").length && $.fn.datepicker) {
        $("#pacNacimiento").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    }

    if ($("#fecha").length && $.fn.datepicker) {
        $("#fecha").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    }
});

function mostrarFormulario() {
    var documento = $("#asignarDocumento").val();
    $("#pacDocumento").val(documento);
    $("#frmPaciente").dialog("open");
}

function insertarPaciente() {
    var queryString = $("#agregarPaciente").serialize();
    var url = "index.php?accion=ingresarpaciente&" + queryString;

    $.get(url, function (respuesta) {
        $("#paciente").html(respuesta);
        $("#frmPaciente").dialog("close");
    });
}

function cerrarPaciente() {
    $("#frmPaciente").dialog("close");
}

function cargarHoras() {
    if ($("#medico").val() === "-1" || $("#fecha").val() === "") {
        $("#hora").html("<option value='-1' selected='selected'>- Seleccione la hora -</option>");
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

function consultarConsultar() {
    var url = "index.php?accion=consultarCita&consultarDocumento=" + $("#consultarDocumento").val();
    $("#paciente2").load(url);
}

function cancelarConsultar() {
    var url = "index.php?accion=cancelarCita&cancelarDocumento=" + $("#cancelarDocumento").val();
    $("#paciente3").load(url);
}

function confirmarCancelar(numero) {
    if (confirm("Esta seguro que desea cancelar la cita " + numero)) {
        $.get("index.php", { accion: "confirmarCancelar", numero: numero }, function (mensaje) {
            alert(mensaje);
            cancelarConsultar();
        });
    }
}