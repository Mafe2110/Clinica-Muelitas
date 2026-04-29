function consultarConsultar(){
	var url = "index.php?accion=consultarCita&consultarDocumento="+$("#consultarDocumento").val();
	$("#paciente2").load(url);
}

function cancelarConsultar(){
	var url = "index.php?accion=cancelarCita&cancelarDocumento="+$("#cancelarDocumento").val();
	$("#paciente3").load(url);
}

function confirmarCancelar(numero){
	if (confirm("Esta seguro que desea cancelar la cita "+numero)) {
		$.get("index.php",{accion:'confirmarCancelar',numero:numero},function(mensaje){
			alert(mensaje);
		});
	}
}