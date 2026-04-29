$(document).ready(function(){
	$("#asignarConsultar").click(function(){
		url= "index.php?accion=consultarPaciente&documento="+$("#asignarDocumento").val();
		$("#paciente").load(url);
	});


	$("#ingPaciente").click(function(){
		mostarFormulario();
	});

	$("#frmPaciente").dialog({
		autoOpen:false,
		height:310,
		width:400,
		modal:true,
		buttons:{
			"Insertar":insertarPaciente,
			"Cancelar":cancelar
		}
	});
		
	$("#pacNacimiento").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth:true,
		changeYear:true
	});
	$("#fecha").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth:true,
		changeYear:true
	});
});


function mostarFormulario(){
	var documento = $("#asignarDocumento").val();
	$("#pacDocumento").attr("value",documento);
	$("#frmPaciente").dialog('open');
}

function insertarPaciente(){
	$(this).dialog("close");
	var queryString = $("#agregarPaciente").serialize();
	url="index.php?accion=ingresarpaciente&"+queryString;
	$("#paciente").load(url);
}

function cancelar(){
	$(this).dialog("close");
}

function cargarHoras(){
	if($("#medico").val()=="-1" || $("#fecha").val()==""){
		$("#hora").html("<option value='-1' selected='selected'>- Seleccione la hora -</option>");
	}
	else{
		var queryString = "medico="+$("#medico").val()+"&fecha="+$("#fecha").val();
		var url = "index.php?accion=consultarHoras&"+queryString;
		$("#hora").load(url);
	}
}

function seleccionarHora(){
	if ($("#medico").val()=="-1") {
		alert("Debe seleccionar un medico");
	}

	else if($("#fecha").val()==""){
		alert("Debe seleccionar una fecha");
	}
}
