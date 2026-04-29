
<?php 

	class GestorCita{

		public function agregarCita($cita){
			$conexion= new Conexion();
			$conexion->abrir();
			$fecha= $cita->obtenerFecha();
			$hora= $cita->obtenerHora();
			$paciente= $cita->obtenerPaciente();
			$medico= $cita->obtenerMedico();
			$consultorio= $cita->obtenerConsultorio();
			$estado= $cita->obtenerEstado();
			$observaciones= $cita->obtenerObservaciones();

			$sql= "INSERT INTO citas (CitFecha,CitHora,CitPaciente,CitMedico,CitConsultorio,CitEstado,CitObservaciones)
			 VALUES ('$fecha','$hora','$paciente','$medico','$consultorio','$estado','$observaciones')";

			$conexion->consulta($sql);
			$citaId= $conexion-> obtenerCitaId();
			$conexion->cerrar();
			return $citaId;

		}

		public function consultarCitaPorId($id){
			$conexion = new Conexion();
			$conexion->abrir();
			$sql= "SELECT pacientes.*, medicos.*, consultorios.*, citas.*
			 FROM pacientes, medicos, consultorios, citas 
			 WHERE citas.CitPaciente= pacientes.PacIdentificacion 
			 AND citas.CitMedico= medicos.MedIdentificacion 
			 AND citas.CitConsultorio= consultorios.ConNumero
			 AND citas.CitNumero= $id";

			$conexion->consulta($sql);
			$result= $conexion->obtenerResult();
			$conexion->cerrar();
			return $result;

		}

		public function consultarCitaPorDocumento($doc){
			$conexion = new Conexion();
			$conexion->abrir();

			$sql= "SELECT * 
			FROM citas 
			WHERE CitPaciente= '$doc'
			AND CitEstado = 'Solicitada' ";

			$conexion->consulta($sql);
			$result= $conexion->obtenerResult();
			$conexion->cerrar();
			return $result;
		}


		public function consultarPaciente($doc){
			$conexion= new Conexion();
			$conexion-> abrir();
			$sql= "SELECT * FROM pacientes WHERE PacIdentificacion = '$doc' ";
			$conexion->consulta($sql);
			$result= $conexion->obtenerResult();
			$conexion->cerrar();
			return $result;
		}

		public function agregarPaciente($paciente){
			$conexion= new Conexion();
			$conexion->abrir();
			$identificacion = $paciente->obtenerIdentificacion();
			$nombres = $paciente->obtenerNombres();
			$apellidos = $paciente->obtenerApellidos();
			$fechaNacimiento = $paciente->obtenerFechaNacimiento();
			$sexo = $paciente->obtenerSexo();
			$sql= "INSERT INTO pacientes VALUES ('$identificacion','$nombres', '$apellidos', '$fechaNacimiento', '$sexo')";
			$conexion->consulta($sql);
			$filasAfectadas= $conexion-> obtenerFilasAfectadas();
			$conexion->cerrar();
			return $filasAfectadas;
		}

		public function consultarMedicos(){
			$conexion= new Conexion();
			$conexion->abrir();
			$sql= "SELECT * FROM medicos";
			$conexion->consulta($sql);
			$result= $conexion->obtenerResult();
			$conexion->cerrar();
			return $result;
		}

		public function consultarConsultorios(){
			$conexion= new Conexion();
			$conexion->abrir();
			$sql= "SELECT * FROM consultorios";
			$conexion->consulta($sql);
			$result= $conexion->obtenerResult();
			$conexion->cerrar();
			return $result;
		}

		public function consultarHorasDisponibles($med, $fech){
			$conexion= new Conexion();
			$conexion->abrir();
			$sql= "SELECT hora FROM horas WHERE hora NOT IN(SELECT CitHora FROM citas WHERE CitMedico = '$med' AND CitFecha = '$fech' AND CitEstado = 'Solicitada')";
			$conexion->consulta($sql);
			$result= $conexion->obtenerResult();
			$conexion->cerrar();
			return $result;
		}

		public function cancelarCita($cita){
			$conexion= new Conexion();
			$conexion->abrir();
			$sql= "UPDATE citas SET CitEstado='Cancelada' WHERE CitNumero = $cita";
			$conexion->consulta($sql);
			$filasAfectadas = $conexion->obtenerFilasAfectadas();
			$conexion->cerrar();
			return $filasAfectadas;
		}

	}

 ?>