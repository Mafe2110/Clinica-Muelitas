<?php 

	require_once 'controlador/controlador.php';
	require_once 'modelo/GestorCita.php';
	require_once 'modelo/cita.php';
	require_once 'modelo/paciente.php';
	require_once 'modelo/conexion.php';


	//Creación de la instancia de la clase controlador

	$controlador= new Controlador();

	if(isset($_GET["accion"])){

		// Botones para las rutas
		if($_GET["accion"]=="asignar"){
			$controlador->cargarAsignar();
		}

		elseif($_GET["accion"]=="consultar"){
			$controlador->verPagina('vista/html/consultar.php');
		}

		elseif($_GET["accion"]=="cancelar"){
			$controlador->verPagina('vista/html/cancelar.php');
		}

		// Botones para el crud

		elseif($_GET["accion"]=="guardarCita"){
			$controlador->agregarCita($_POST["asignarDocumento"],$_POST["medico"],
				$_POST["fecha"],$_POST["hora"],$_POST["consultorio"]);
		}

		elseif ($_GET["accion"] == "consultarCita") {
			$controlador->consultarCitas($_GET["consultarDocumento"]);
		}

		elseif ($_GET["accion"] == "cancelarCita") {
			$controlador->cancelarCitas($_GET["cancelarDocumento"]);
		}

		elseif($_GET["accion"]=="consultarPaciente"){
			$controlador->consultarPaciente($_GET["documento"]);
		}

		elseif($_GET["accion"]=="ingresarpaciente"){
			$controlador->agregarPaciente($_GET["pacDocumento"],$_GET["pacNombres"],$_GET["pacApellidos"],$_GET["pacNacimiento"],$_GET["pacSexo"]);
		}

		elseif($_GET["accion"]=="consultarHoras"){
			$controlador->consultarHorasDisponibles($_GET["medico"],$_GET["fecha"]);
		}

		elseif($_GET["accion"]=="verCita"){
			$controlador->verCita($_GET["numero"]);
		}

		elseif($_GET["accion"]=="confirmarCancelar"){
			$controlador->confirmarcancelarCita($_GET["numero"]);
		}

		elseif($_GET["accion"]=="reporte"){
			$controlador->generarReporte();
		}

	}

	else{
		$controlador->verPagina('vista/html/inicio.php');
	}

	

 ?>

