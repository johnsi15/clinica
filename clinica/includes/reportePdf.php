<?php 
	require_once("pdf/dompdf_config.inc.php");
	class funciones{
	     private $bd;
	     function __construct(){
	         require_once('config.php');
	         $bd = new conexion();
	         $bd->conectar();
	     }

	   public function listado($palabra){
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
		     						<table rules="rows" border="1">
		     								<thead>
		     									<tr>
		     										<th>T.D</th>
													<th>N°</th>
													<th>NOMBRE</th>
													<th>ENTIDAD</th>
													<th>TIPO</th>
													<th>FECHA SOLICITUD</th>
													<th>FECHA ASIGNADA USUARIO</th>
													<th>FECHA ASIGNADA IPS</th>
													<th>MEDICO</th>
													<th>OPRT</th>
		     									</tr>';
		     									$consulta = mysql_query("SELECT * FROM citas,medicos WHERE (citas.doctor=medicos.idMedico AND idMedico='$palabra')
                                               				 OR (citas.doctor=medicos.idMedico AND entidad='$palabra')");
											    while($fila=mysql_fetch_array($consulta)){
											    	$diaSolicitud = substr($fila['fechaSolicitud'],8,10);
											    	$diaIps = substr($fila['fechaAsignacionSistema'],8,10);
											    	$oportunidad = $diaIps - $diaSolicitud;
											$codigoHTML.='
		     								</thead>
		     								<tbody>
											      <tr>
											      	<td>'.$fila['documento'].'</td>
											        <td>'.$fila['numero'].'</td>
											        <td>'.$fila['nombre'].'</td>
								                    <td>'.$fila['entidad'].'</td>
								                    <td>'.$fila['tipo'].'</td>
								                    <td>'.$fila['fechaSolicitud'].'</td>
								                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
								                    <td>'.$fila['fechaAsignacionSistema'].'</td>
								                    <td>'.$fila['nombreMedico'].'</td>
								                    <td>'.$oportunidad.'</td>
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
				$exit(0);
	   	   
	    }//fin metodo
 	}//fin clase
 	$opcion = $_POST['opcion'];
	if($opcion == 1){
		$palabra = $_POST['nombre'];
	}else{
		$palabra = $_POST['entidad'];
	}
 	//echo $palabra;
 	$ejecutar = new funciones();
 	$ejecutar->listado($palabra);
?>
