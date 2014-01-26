<?php 
	require_once("pdf/dompdf_config.inc.php");
	class funciones{
	     private $bd;
	     function __construct(){
	         require_once('config.php');
	         $bd = new conexion();
	         $bd->conectar();
	     }

	     public function listado(){
	     	$codigoHTML='<!DOCTYPE>
	     				<html lang="es">
	     				<head>
	     				    <title></title>
	     				    <meta charset="UTF-8"/>
	     				</head>
	     					<body>
	     						<h1 align="center"> Reporte de Citas </h1>
	     						<hr>
	     						<div align="center">
		     						<table width="100%" rules="rows" border="1">
		     								<thead>
		     									<tr>
		     										<th>C.I</th>
		     										<th>Nombre</th>
		     										<th>Entidad</th>
		     										<th>Tipo</th>
		     										<th>Fecha Solicitud</th>
		     										<th>Fecha Asignada Usuario</th>
		     										<th>Fecha Asignada IPS</th>
		     										<th>Medico</th>
		     									</tr>';
		     									 $consulta=mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC");
											    while($fila=mysql_fetch_array($consulta)){
											$codigoHTML.='
		     								</thead>
		     								<tbody>
											      <tr>
											        <td>'.$fila['cedula'].'</td>
											        <td>'.$fila['nombre'].'</td>
								                    <td>'.$fila['entidad'].'</td>
								                    <td>'.$fila['tipo'].'</td>
								                    <td>'.$fila['fechaSolicitud'].'</td>
								                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
								                    <td>'.$fila['fechaAsignacionSistema'].'</td>
								                    <td>'.$fila['nombreMedico'].'</td>
											      </tr>';
											      } 
											$codigoHTML.='
		     								</tbody>
		     						</table>
		     					</div>
	     					</body>
	     				</html>';
	     				$codigoHTML=utf8_decode($codigoHTML);
						$dompdf=new DOMPDF();
						$dompdf->load_html($codigoHTML);
						ini_set("memory_limit","128M");
						$dompdf->render();
						$dompdf->stream("ReporteCitas.pdf");
	     }
 	}
 	$ejecutar = new funciones();
 	$ejecutar->listado();
?>
