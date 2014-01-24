<!DOCTYPE HTML>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Medicos</title>
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
      $(document).ready(function(){
      	// ver mas datos de los prestamos
      	$('[data-toggle=popover]').popover({html:true});

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
		  	var data = 'queryPrestamo='+$(this).val();
		  	//console.log(data);
      	    if(data =='queryPrestamo=' ){
      	       	$.post('acciones.php',data , function(resp){
			  	   	//console.log(resp);
			  	   	$('#verPrestamos').empty();//limpiar los datos
			  	   	$('#verPrestamos').html(resp);
	      	    	//console.log('poraca paso joder....');
	      	    	$('[data-toggle=popover]').popover({html:true});
			  	},'html');
      	    }else{
      	       	$.post('acciones.php',data , function(resp){
			  	   	  //console.log(resp);
			  	   	$('.pagination').remove();
			  	   	$('#verPrestamos').empty();//limpiar los datos
			  	   	$('#verPrestamos').html(resp);
	      	    	//console.log(resp);
	      	    	$('[data-toggle=popover]').popover({html:true});
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
					  	 	$('[data-toggle=popover]').popover({html:true});
					  	}
					});
					  $('.pagination').remove();
				}
		  	}
		});

		// calculo para sacar los meses
		$('#quin').keyup(function(){
    			var quin = $(this).val();
    			var meses = quin/2;
    			$('#meses').val(meses);
    	}).keyup();


	  });/*fin del document------------------*/
		
		function calculo(){
    		//var contador = document.getElementById("totalDia");
    		for(i=0;i<document.formu.tipo.length;i++){
				if(document.formu.tipo[i].checked) {
					marcado=i;
				}
			}
			//alert("El valor seleccionado es: "+document.formu.tipo[marcado].value);
    		//var valor = document.getElementById("tipo").value;
    		if(document.formu.tipo[marcado].value == 'm'){
    			var quin = $('#quin').val();
	    		var prestamo = $('#prestamo').val();
	    		var porc = $('#porc').val();
	    		var resuPorce = (prestamo*porc)/100;
	    		var div = resuPorce/2;
	    		var interes = div * quin;
	    		var meses = quin/2;
	    		var cuota = (parseInt(prestamo) + parseInt(interes))/meses;

	    		$("#vcuota").val(Math.round(cuota));
	    		$("#interes").val(interes);
    		}else{
    			var quin = $('#quin').val();
	    		var prestamo = $('#prestamo').val();
	    		var porc = $('#porc').val();
	    		var resuPorce = (prestamo*porc)/100;
	    		var div = resuPorce/2;
	    		var interes = div * quin;
	    		var cuota = (parseInt(prestamo) + parseInt(interes))/quin;

	    		$("#vcuota").val(Math.round(cuota));
	    		$("#interes").val(interes);
    		}
    		
    	}//cierre funcion
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
							<li ><a href="citas.php"><i class="icon-tags icon-white"></i> Citas</a></li>
							<li class="divider-vertical"></li>
							<li class="active"><a href="medicos.php"><i class="icon-user icon-white"></i> Medicos</a></li>
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
									<li><a href="includes/cerrar.php">Cerrar Sesion</a></li>
								</ul>
							</li>
							<?php 
								date_default_timezone_set('America/Bogota'); 
						        $fecha = date("Y-m-d");
						        echo '<li><a href="#" style="font-weight: bold;">Fecha: '.$fecha.'</a></li>';
					        ?>
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
		<input type="text" name="buscar" id="buscar" class="search-query" placeholder="Buscar Nombre" autofocus>	
		<div class="row">
			<h1>Clinica San Diego</h1> <br>
			<div class="span4">
				<a class="btn btn-large btn-success" id="nuevo">Nuevo Medico</a>
			</div>
			<div class="span12">
				<hr>
				<table class="table table-hover table-bordered table-condensed">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre</th>
						</tr>
					</thead>
					<tbody id="verMedicos">
						<?php 
						   require_once('funciones.php');
						   $objeto = new funciones();
						   $objeto->verMedicos();
						?>
					</tbody>
				</table>
				<div id="cargando" style="display: none;"><img src="../img/loader.gif" alt=""></div>
		        <div id="paginacion">
		    	 	 <?php 
		    	 	  require_once('funciones.php');
		    	 	  $objeto = new funciones();
		    	 	  //$objeto->paginacionPrestamos();
			    	 ?>
		    	</div>
			</div>
		</div>
		<div class="row">
			
		</div>
	</section>

	<!--codigo para hacer un nuevo prestamo-->
	<div class="hide" id="nuevoMedico" title="Nuevo Medico">
     	<form action="acciones.php" method="post" id="registrarMedico" class="limpiar">
     			<div class="control-group">
	     			<label>Nombre:</label>
					<input type="text" name="nombre" required id="nombre"/>
					<input type="hidden" name="registrarMedico"> <br>
					<button  class="btn btn-primary" type="submit" id="registrarMedico">Guardar</button>
					<button  class="btn btn-danger" id="cancelar">Cancelar</button>
				</div>
     	</form>
    </div>

    <!--codigo para modificar los campos personales-->
	<div class="hide" id="editarDatos" title="Editar Medico">
     	<form action="acciones.php" method="post">
     		<input type="hidden" id="id_registro" name="id_registro" value="0">
     			<label>Nombre:</label>
				<input type="text" name="nombreEditar" id="nombreEditar"/>
				<input type="hidden" name="modificarDatos">
				<button type="submit" id="modificarDatos" class="btn btn-success">Aceptar</button>
				<button id="cancelar" class="btn btn-danger">Cancelar</button>
     	</form>
    </div>

	<footer>
		<h2 id="pie"><img src="../img/copyright.png">  Clinica San Diego - 2014</h2>
		<!-- <h2 id="pie"><img src="img/copyright.png" alt="Autor"> JA Serrano</h2> -->
		<div> <br>
			<p id="pie">Asignacion de Citas 1.0</p>
		</div>
	</footer>
</body>
</html>