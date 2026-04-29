
				<?php 
					if($result->num_rows>0) {
				 ?>

			<table>
				<tr><th>Identificación</th> <th>Nombre</th> <th>Sexo</th></tr>


			<?php 
				$fila= $result->fetch_object();
			 ?>
				<tr>
					<td><?php echo $fila->PacIdentificacion; ?></td>
					<td><?php echo $fila->PacNombres." ".$fila->PacApellidos ?></td>
					<td><?php echo $fila->PacSexo; ?></td>
					<td>Ver</td>
				</tr>

			</table>

			<?php 
				}
				else{
			 ?>

			 El paciente no exite en la base de datos<br>
			 <input type="button" name="ingPaciente" value="Ingresar Paciente" id="ingPaciente" onclick="mostarFormulario()">

			 <?php 
			 	}
			  ?>