<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro Citas</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="../css/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script src="../js/jquery.validate.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/citas.js"></script>
	<script src="../js/funciones.js"></script>
	<script src="../js/editar.js"></script>
	<script src="../js/eliminar.js"></script>
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
	    	font-size: 1.1em;
	    }
	    td{
	    	font-size: 1.1em;
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
      $(document).ready(function(){
      	// ver mas datos de los prestamos
      	//$('#info').show({html:true});
      	$('#infoFecha').tooltip('hide');
      	$('#infoFecha2').tooltip('hide');
      	$('#infoFechaEdit').tooltip('hide');
      	$('#infoFechaEdit2').tooltip('hide');
      	var menu = $('#bloque');
		var contenedor = $('#bloque-contenedor');
		var menu_offset = menu.offset();
		  // Cada vez que se haga scroll en la página
		  // haremos un chequeo del estado del menú
		  // y lo vamos a alternar entre 'fixed' y 'static'.
		  menu.css("display", "none");
		$(window).on('scroll', function() {
		    if($(window).scrollTop() > menu_offset.top) {
		      menu.addClass('bloqueFijo');
		      menu.css("display", "block");
		    } else {
		      menu.removeClass('bloqueFijo');
		      menu.css("display", "none");
		    }
		});

		/*____________________________________________________-*/
		$('#IrInicio').click(function () {
		    $('html, body').animate({
		           scrollTop: '0px'
		    },
		    1500);
		        $('#buscar').focus();
		       //return false;
		});

		/*______________________________________________*/
        $("#menuOpen").mouseout(function(){
            //$("#formMenu").removeClass('open');
	    }).mouseover(function(){
	        $("#formMenu").addClass('open');
	        $("#foco").focus();
        });

	    //buscador de los prestamos____________________________
	    $('#buscar').live('keyup',function(){
		  	var data = 'queryCitas='+$(this).val();
		  	console.log(data);
      	    if(data =='queryCitas=' ){
      	       	$.post('acciones.php',data , function(resp){
			  	   	//console.log(resp);
			  	   	$('#verCitas').empty();//limpiar los datos
			  	   	$('#verCitas').html(resp);
	      	    	//console.log('poraca paso joder....');
			  	},'html');
      	    }else{
      	       	$.post('acciones.php',data , function(resp){
			  	   	  //console.log(resp);
			  	   	$('.pagination').remove();
			  	   	$('#verCitas').empty();//limpiar los datos
			  	   	$('#verCitas').html(resp);
	      	    	//console.log(resp);
			  	},'html');
      	    }
		});

		/*_________________________________________*/
		$(window).scroll(function(){
		  	if($(window).scrollTop() >= $(document).height() - $(window).height()){
		  		if($('.pagination ul li.next a').length){
			  		$('#cargando').show();
			  		 /*_____________________________________*/
					$.ajax({
					  	type: 'GET',
					  	url: $('.pagination ul li.next a').attr('href'),
					  	success: function(html){
					  	 		//console.log(html);
					  	 	var nuevosGastos = $(html).find('table tbody'),
					  	 		nuevaPag     = $(html).find('.pagination'),
					  	 		tabla        = $('table');
					  	    tabla.find('tbody').append(nuevosGastos.html());
					  	 	tabla.after(nuevaPag.hide());
					  	 	$('#cargando').hide();
					  	}
					});
					  $('.pagination').remove();
				}
		  	}
		});

	  });/*fin del document------------------*/
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
					<a href="../menu.php" class="brand">Clinica San Diego</a>
					<div class="nav-collapse collapse">
						<ul class="nav" >
							<li class="divider-vertical"></li>
							<li><a href="../menu.php"><i class="icon-home icon-white"></i>Inicio</a></li>
							<li class="divider-vertical"></li>
							<li class="active"><a href="citas.php"><i class="icon-tags icon-white"></i> Citas</a></li>
							<li class="divider-vertical"></li>
							<li><a href="medicos.php"><i class="icon-user icon-white"></i> Medicos</a></li>
							<li class="divider-vertical"></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="icon-user icon-white"></i> <?php echo $user; ?> <!--Mostramoe el user logeado -->
								    <span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="registrarUsuario.php"><i class="icon-plus-sign"></i> Registrar Usuario</a></li>
									<li><a href="editarUsuario.php"><i class="icon-wrench"></i> Configuración de la cuenta</a></li>
									<li class="divider"></li>
									<li><a href="cerrar.php">Cerrar Sesion</a></li>
								</ul>
							</li>
							<?php 
								date_default_timezone_set('America/Bogota'); 
						        $fecha = date("Y-m-d");
						        echo '<li><a href="#" style="font-weight: bold;">Fecha: '.$fecha.'</a></li>';
					        ?>
						</ul>
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

	<div class="span2"> <div id="bloque"><aside class="well" id="bloque-contenedor" style="text-align: center; "><a href="#" id="IrInicio">Volver Arriba</a></aside></div></div> 

    <!--seccion principal de la pagina-->
	<section class="container well" id="fondo">
		<input type="text" name="buscar" id="buscar" class="search-query" placeholder="Buscar" autofocus>	
		<div class="row">
			<h1>Clinica San Diego</h1> <br>
			<div class="span4">
				<a class="btn btn-large btn-success" id="nuevo">Nueva Cita</a>
			</div>
			<div class="span12">
				<hr>
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<th>C.I</th>
							<th>Nombre</th>
							<th>Entidad</th>
							<th>Tipo</th>
							<th>Fecha Solicitud</th>
							<th>Fecha Asig Usuario</th>
							<th>Fecha Asig IPS</th>
							<th>Obs</th>
							<th>Medico</th>
						</tr>
					</thead>
					<tbody id="verCitas">
						<?php 
						   require_once('funciones.php');
						   $objeto = new funciones();
						   $objeto->verCitas();
						?>
					</tbody>
				</table>
				<div id="cargando" style="display: none;"><img src="../img/loader.gif" alt=""></div>
		        <div id="paginacion">
		    	 	 <?php 
		    	 	  require_once('funciones.php');
		    	 	  $objeto = new funciones();
		    	 	  $objeto->paginacionCitas();
			    	 ?>
		    	</div>
			</div>
		</div>
		<div class="row">
			
		</div>
	</section>

	<!--codigo para hacer un nueva cita-->
	<div class="hide" id="nuevaCita" title="Nueva Cita">
     	<form action="acciones.php" method="post" id="registrarCita" class="form-inline">
     			<div class="control-group">
	     			<label>Cedula:</label>
					<input type="text" name="cedula" required id="cedula" autofocus/>
	     			<label>Nombre:</label>
					<input type="text" name="nombre" required id="nombre"/>
					<label>Entidad</label>
					<input type="text" name="entidad" required id="entidad"><br>
				</div>
				<div class="control-group">
					<label>Tipo Cita</label>
					<input type="text" name="tipo" id="tipo"/>
					<label>
                         <a href="#" id="infoFecha" 
                                data-toggle="tooltip" title="FECHA  EN QUE  EL USUARIO SOLICITALA CITA ">
                                Fecha
                         </a>
					</label>
					<input type="date" name="fechaS" id="fechaS"/>
					<label>
						 <a href="#" id="infoFecha2" 
                                data-toggle="tooltip" title="FECHA DE CITA ASIGNADA POR LA IPS">
                                Fecha Asignada
                         </a>
					</label>
					<input type="date" name="fechaA" id="fechaA"/>
				</div>
				<div class="control-group">
					<label>Observaciones</label>
					<textarea name="observa" rows="2" cols="40"></textarea>
					<label>Medico:</label>
					<select id='medico' name='medico'>
						<?php
	                        require_once('funciones.php');
	                        $combo = new funciones();
	                        $combo->comboMedicos();
						?>
					</select>
					<input type="hidden" name="registrarCita">
					<button  class="btn btn-primary" type="submit" id="registrarCita">Guardar</button>
					<button  class="btn btn-danger" id="cancelar">Cancelar</button>
				</div>	
     	</form>
    </div>

    <!--codigo para editar los datos-->
	<div class="hide" id="editarCita" title="Editar Cita">
     	<form action="acciones.php" method="post" id="modificarCita" class="form-inline">
     		<input type="hidden" id="id_editar" name="id_editar" value="0"/>
     			<div class="control-group">
	     			<label>Cedula:</label>
					<input type="text" name="cedulaEdit" required id="cedulaEdit" autofocus />
	     			<label>Nombre:</label>
					<input type="text" name="nombreEdit" required id="nombreEdit"/>
					<label>Entidad</label>
					<input type="text" name="entidadEdit" required id="entidadEdit"><br>
				</div>
				<div class="control-group">
					<label>Tipo Cita</label>
					<input type="text" name="tipoEdit" id="tipoEdit"/>
					<label>
                         <a href="#" id="infoFechaEdit" 
                                data-toggle="tooltip" title="FECHA  EN QUE  EL USUARIO SOLICITALA CITA ">
                                Fecha
                         </a>
					</label>
					<input type="text" name="fechaSEdit" id="fechaSEdit"/>
					<label>
						 <a href="#" id="infoFechaEdit2" 
                                data-toggle="tooltip" title="FECHA DE CITA ASIGNADA POR LA IPS">
                                Fecha Asignada
                         </a>
					</label>
					<input type="text" name="fechaAEdit" id="fechaAEdit"/>
				</div>
				<div class="control-group">
					<label>Observaciones</label>
					<textarea name="observaEdit" id ="observaEdit" rows="2" cols="40"></textarea>
					<label>Medico:</label>
					<select id='medicoEdit' name='medicoEdit'>
						<?php
	                        require_once('funciones.php');
	                        $combo = new funciones();
	                        $combo->comboMedicosEdit();
						?>
					</select>
					<input type="hidden" name="modificarCita">
					<button  class="btn btn-primary" type="submit" id="modificarCita">Guardar</button>
					<button  class="btn btn-danger" id="cancelar">Cancelar</button>
				</div>	
     	</form>
    </div>

    <!--codigo para eliminar los datos-->
    <div class="hide" id="deleteReg" title="Eliminar Cita">
	    <form action="acciones.php" method="post">
	    	<fieldset id="datosOcultos">
	    		<input type="hidden" id="id_delete" name="id_delete" value="0"/>
	    	</fieldset>
	    	<div class="control-group">
	    		<label for="activoElim" class="alert alert-danger">
	    		    <strong>Esta seguro de Eliminar esta Cita</strong><br>
	    		</label>
	    		<input type="hidden" name="deleteCita"/> 
			    <button type="submit" class="btn btn-success" id="deleteCita">Aceptar</button>
			    <button id="cancelar" name="cancelar" class="btn btn-danger">Cancelar</button>
	    	</div>
	    </form>
	</div>

	<footer>
		<h2 id="pie"><img src="../img/copyright.png"> Clinica San Diego - 2014</h2>
		<!-- <h2 id="pie"><img src="img/copyright.png" alt="Autor"> JA Serrano</h2> -->
		<div> <br>
			<p id="pie">Asignacion de Citas 1.0</p>
		</div>
	</footer>
</body>
</html>