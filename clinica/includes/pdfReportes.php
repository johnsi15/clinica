<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reportes</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script src="../js/jquery.validate.js"></script>
	<script src="../js/funciones.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/medicos.js"></script>
	<script src="../js/editar.js"></script>
	<?php
      session_start();
      if(isset($_SESSION['id_user'])){
           $user = $_SESSION['nombre'];
      }else{
      	header('Location: ../index.php');
      }
	?>
	<style>
		h1{
			text-align: center;
		}
		label.error{
			float: none; 
			color: red; 
			padding-left: .5em;
		    vertical-align: middle;
		    font-size: 12px;
		}
		th{
	    	font-size: 1.8em;
	    }
	    td{
	    	font-size: 1.3em;
	    }
		p{
	    	color: #df0024;
	    	font-size: 20px;
	    }
		#fondo{
			background: #feffff;
		}
		#mensaje{
	        float: left;
	    	margin-left: 45%;
	    	position: fixed;
	    	top: 18%;
	    	display: block;
       	}
       	#mensajeError{
       		float: left;
	    	margin-left: 45%;
	    	position: fixed;
	    	top: 18%;
	    	display: block;
       	}
       	.hero-unit{
        	margin-top: 5%;
        	text-align: center;
        	background-image: url('../img/foto1.jpg');
        }
	</style>	
	<script>
      
	</script>
</head>
<body>
	<header>
		<div class="navbar navbar-fixed-top navbar-inverse">
			<div class="navbar-inner">
				<div class="container" >
					<a  class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a href="../menu.php" class="brand">Clinica de Oftalmologia San Diego</a>
					<div class="nav-collapse collapse">
							<ul class="nav" >
							<li class="divider-vertical"></li>
							<li><a href="../menu.php"><i class="icon-home icon-white"></i>Inicio</a></li>
							<li class="divider-vertical"></li>
							<li ><a href="citas.php"><i class="icon-tags icon-white"></i> Citas</a></li>
							<li class="divider-vertical"></li>
							<li><a href="medicos.php"><i class="icon-user icon-white"></i> Medicos</a></li>
							<li class="divider-vertical"></li>
							<li class="active"><a href="pdfReportes.php"><i class="icon-book icon-white"></i> Reportes</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-user icon-white"></i> <?php echo $user; ?> <!--Mostramoe el user logeado -->
								    <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<!-- <li><a href="registrarUsuario.php"><i class="icon-plus-sign"></i> Registrar Usuario</a></li> -->
									<li><a href="editarUsuario.php"><i class="icon-wrench"></i> Configuración de la cuenta</a></li>
									<li class="divider"></li>
									<li><a href="cerrar.php">Cerrar Sesion</a></li>
								</ul>
							</li>
					</div>
				</div>
			</div>
		</div>
	</header>
	<aside id="mensaje"></aside><!--menssaje de exito del registro o de error-->
	<aside id="mensajeError"></aside><!--menssaje de exito del registro o de error-->
	<section>
		<div class="container">
			<div class="hero-unit">
				<br><br><br><br><br><br><br>
			</div>
		</div>
	</section>

<!-- 	<div class="span2"> <div id="bloque"><aside class="well" id="bloque-contenedor" style="text-align: center; "><a href="#" id="IrInicio">Volver Arriba</a></aside></div></div> 
 -->
    <!--seccion principal de la pagina-->
	<section class="container well" id="fondo">
		<div class="row">
			<h1>Clinica de Oftalmologia San Diego</h1> <br>
			<div class="span12">
				<hr>
				<form action="reportePdf.php" method="post" class="form-inline">
					<label>Medico: </label>
					<select name='nombre'>
						<?php
	                        require_once('funciones.php');
	                        $combo = new funciones();
	                        $combo->comboMedicos();
						?>
					</select>
					<label>Entidad: </label>
					<select name="entidad">
						<option value="ECOPETROL">ECOPETROL</option>
						<option value="UNIDAD SALUD ARAUCA">UNIDAD SALUD ARAUCA</option>
						<option value="QBE SEGUROS SOAT">QBE SEGUROS SOAT</option>
						<option value="ALLIANZ COLSEGUROS">ALLIANZ COLSEGUROS</option>
						<option value="CAFESALUD SUBSIDIADA">CAFESALUD SUBSIDIADA</option>
						<option value="CAFESALUD EPS">CAFESALUD EPS</option>
						<option value="MEDPLUS">MEDPLUS</option>
						<option value="CAPRECOM ARAUCA">CAPRECOM ARAUCA</option>
						<option value="CAPRECOM INPEC">CAPRECOM INPEC</option>
						<option value="CAPRECOM CUCUTA">CAPRECOM CUCUTA</option>
						<option value="COMFAORIENTE EN LIQUIDACION">COMFAORIENTE EN LIQUIDACION</option>
						<option value="COMPENSAR">COMPENSAR</option>
						<option value="COOMEVA EPS">COOMEVA EPS</option>
						<option value="COOMEVA M.P.">COOMEVA M.P.</option>
						<option value="COOSALUD">COOSALUD</option>
						<option value="COLMEDICA M.P.">COLMEDICA M.P.</option>
						<option value="COLSANITAS S.A.">COLSANITAS S.A.</option>
						<option value="DUSAKAWI">DUSAKAWI</option>
						<option value="EFISALUD">EFISALUD</option>
						<option value="EPS SANITAS">EPS SANITAS</option>
						<option value="ECOOPSOS EPSS">ECOOPSOS EPSS</option>
						<option value="FAMISALUD COMFANORTE">FAMISALUD COMFANORTE</option>
						<option value="FUNDACION MEDICO PREVENTIVA">FUNDACION MEDICO PREVENTIVA</option>
						<option value="FUNDACION VIRGILIO BARCO">FUNDACION VIRGILIO BARCO</option>
						<option value="GOLDEN GROUP">GOLDEN GROUP</option>
						<option value="INSTITUTO DEPARTAMENTAL DE SALUD">INSTITUTO DEPARTAMENTAL DE SALUD</option>
						<option value="LA PREVISORA">LA PREVISORA</option>
						<option value="LIBERTY SEGUROS">LIBERTY SEGUROS</option>
						<option value="MAPFRE">MAPFRE</option>
						<option value="MULTIMEDICAS">MULTIMEDICAS</option>
						<option value="POLICIA NACIONAL">POLICIA NACIONAL</option>
						<option value="POSITIVA ARL">POSITIVA ARL</option>
						<option value="SALUDCOOP EPS">SALUDCOOP EPS</option>
						<option value="SANATY">SANATY</option>
						<option value="SEGUROS COLPATRIA">SEGUROS COLPATRIA</option>
						<option value="SALUDVIDA EPSS">SALUDVIDA EPSS</option>
						<option value="SEGUROS BOLIVAR">SEGUROS BOLIVAR</option>
						<option value="SENA">SENA</option>
						<option value="SURAMERICANA">SURAMERICANA</option>
						<option value="SEGUROS GENERALES SURA">SEGUROS GENERALES SURA</option>
						<option value="CDI">CDI</option>
						<option value="RENTABIEN">RENTABIEN</option>
						<option value="SEGUROS DEL ESTADO">SEGUROS DEL ESTADO</option>
					</select>
					<label class="radio">
					 	<input type="radio" name="opcion" id="optionsRadios1" value="1" checked>
					 	Medico
					</label>
					<label class="radio">
					 	<input type="radio" name="opcion" id="optionsRadios1" value="2">
					 	Entidad
					</label>
					<button type="submit" class="btn btn-primary">Generar Descargar</button>	
				</form>
			</div>
		</div>
	</section>

	<footer>
		<h2 id="pie"><img src="../img/copyright.png">  Clinica de Oftalmologia San Diego - 2014</h2>
		<!-- <h2 id="pie"><img src="img/copyright.png" alt="Autor"> JA Serrano</h2> -->
		<div> <br>
			<p id="pie">Asignacion de Citas 1.0</p>
		</div>
	</footer>
</body>
</html>