<?php 
	//require_once("pdf/dompdf_config.inc.php");
	require_once 'excel/PHPExcel.php';
	class funciones{
	     private $bd;
	     function __construct(){
	         require_once('config.php');
	         $bd = new conexion();
	         $bd->conectar();
	     }

	    public function listado($palabra){
	   	   	$objPHPExcel = new PHPExcel();
	     	// Se asignan las propiedades del libro
			$objPHPExcel->getProperties()->setCreator("ClinicaSandiego") // Nombre del autor
			    ->setLastModifiedBy("ClinicaSandiego") //Ultimo usuario que lo modificó
			    ->setTitle("Reporte de Citas Clinica Sandiego") // Titulo
			    ->setSubject("Reporte de Citas") //Asunto
			    ->setDescription("Reporte de Citas") //Descripción
			    ->setKeywords("reporte") //Etiquetas
			    ->setCategory("Reporte excel"); //Categorias

			$tituloReporte = "Reporte de Citas";
			$titulosColumnas = array('T.D', 'NUMERO', 'NOMBRE', 'ENTIDAD', 'TIPO', 'FECHA SOLICITUD', 'FECHA ASIGNADA USUARIO','FECHA ASIGNADA IPS', 'MEDICO', 'OPRT');
	    	
	    	// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
			$objPHPExcel->setActiveSheetIndex(0)
			    ->mergeCells('A1:D1');
			 
			// Se agregan los titulos del reporte
			$objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A1',$tituloReporte) // Titulo del reporte
			    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
			    ->setCellValue('B3',  $titulosColumnas[1])
			    ->setCellValue('C3',  $titulosColumnas[2])
			    ->setCellValue('D3',  $titulosColumnas[3])
			    ->setCellValue('E3',  $titulosColumnas[4])
			    ->setCellValue('F3',  $titulosColumnas[5])
			    ->setCellValue('G3',  $titulosColumnas[6])
			    ->setCellValue('H3',  $titulosColumnas[7])
			    ->setCellValue('I3',  $titulosColumnas[8])
			    ->setCellValue('J3',  $titulosColumnas[9]);
			    //Se agregan los datos de los alumnos
		     	$consulta = mysql_query("SELECT * FROM citas,medicos WHERE (citas.doctor=medicos.idMedico AND idMedico='$palabra')
                                               OR (citas.doctor=medicos.idMedico AND entidad='$palabra')");
											  
		    $i = 4; //Numero de fila donde se va a comenzar a rellenar
			while($fila = mysql_fetch_array($consulta)) {
						$diaSolicitud = substr($fila['fechaSolicitud'],8,10);
						$diaIps = substr($fila['fechaAsignacionSistema'],8,10);
						$oportunidad = $diaIps - $diaSolicitud;

			     $objPHPExcel->setActiveSheetIndex(0)
			         ->setCellValue('A'.$i, $fila['documento'])
			         ->setCellValue('B'.$i, $fila['numero'])
			         ->setCellValue('C'.$i, $fila['nombre'])
			         ->setCellValue('D'.$i, $fila['entidad'])
			         ->setCellValue('E'.$i, $fila['tipo'])
			         ->setCellValue('F'.$i, $fila['fechaSolicitud'])
			         ->setCellValue('G'.$i, $fila['fechaAsignacionPaciente'])
			         ->setCellValue('H'.$i, $fila['fechaAsignacionSistema'])
			         ->setCellValue('I'.$i, $fila['nombreMedico'])
			         ->setCellValue('J'.$i, $oportunidad);
			     $i++;
			}

			$estiloTituloReporte = array(
			    'font' => array(
			        'name'      => 'Verdana',
			        'bold'      => true,
			        'italic'    => false,
			        'strike'    => false,
			        'size' =>16,
			        'color'     => array(
			            'rgb' => '000000'
			        )
			    ),
			    'fill' => array(
			        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			        'color' => array(
			            'argb' => 'F8F8FF')
			    ),
			    'borders' => array(
			        'allborders' => array(
			            'style' => PHPExcel_Style_Border::BORDER_NONE
			        )
			    ),
			    'alignment' => array(
			        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			        'rotation' => 0,
			        'wrap' => TRUE
			    )
			);
			 
			$estiloTituloColumnas = array(
			    'font' => array(
			        'name'  => 'Arial',
			        'bold'  => true,
			        'color' => array(
			            'rgb' => '000000'
			        )
			    ),
			    'fill' => array(
			        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			    'rotation'   => 90,
			        'startcolor' => array(
			            'rgb' => 'F8F8FF'
			        ),
			        'endcolor' => array(
			            'argb' => 'F8F8FF'
			        )
			    ),
			    'borders' => array(
			        'top' => array(
			            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
			            'color' => array(
			                'rgb' => '143860'
			            )
			        ),
			        'bottom' => array(
			            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
			            'color' => array(
			                'rgb' => '143860'
			            )
			        )
			    ),
			    'alignment' =>  array(
			        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			        'wrap'      => TRUE
			    )
			);
			 
			$estiloInformacion = new PHPExcel_Style();
			$estiloInformacion->applyFromArray( array(
			    'font' => array(
			        'name'  => 'Arial',
			        'color' => array(
			            'rgb' => '000000'
			        )
			    ),
			    'fill' => array(
			    'type'  => PHPExcel_Style_Fill::FILL_SOLID,
			    'color' => array(
			            'argb' => 'F8F8FF')
			    ),
			    'borders' => array(
			        'left' => array(
			            'style' => PHPExcel_Style_Border::BORDER_THIN ,
			        'color' => array(
			                'rgb' => '3a2a47'
			            )
			        )
			    )
			));

			$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($estiloTituloReporte);
			$objPHPExcel->getActiveSheet()->getStyle('A3:J3')->applyFromArray($estiloTituloColumnas);
			$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:J".($i-1));
			/*ancho de las columnas de forma automatica*/
			for($i = 'A'; $i <= 'D'; $i++){
			    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
			}

			// Se asigna el nombre a la hoja
			$objPHPExcel->getActiveSheet()->setTitle('Citas');
			 
			// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
			$objPHPExcel->setActiveSheetIndex(0);
			 
			// Inmovilizar paneles
			//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
			$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

			// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="ReporteCitas.xlsx"');
			header('Cache-Control: max-age=0');
			 
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;

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
