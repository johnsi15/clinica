<?php
    require_once('funciones.php');
    $objeto = new funciones();
    $refres = new funciones();

   //login de usuarios
   if(isset($_POST['clave'])){
        $user = $_POST['nombre'];
        $pass = $_POST['clave'];
		//sleep(1);
        if($objeto->login($user,$pass)){
            echo "Bien";
            //header('Location: ../menu.php');
        }else{
        	echo "Error";
        }
   }

   /*registramos las citas*/
   if(isset($_POST['registrarCita'])){
        $codigo = $_POST['cedula'];
        $nom = $_POST['nombre'];
        $entidad = $_POST['entidad'];
        $tipo = $_POST['tipo'];
        date_default_timezone_set('America/Bogota'); 
        $fechaI = date("Y-m-d");//fecha en que el usuario solicita la cita
        $fechaS = $_POST['fechaS'];//fecha en la que el usuaro quiere la cita
        $fechaA = $_POST['fechaA'];//fecha que asigna por la IPS
        $observa = $_POST['observa'];
        $medico = $_POST['medico'];
        $objeto->registrarCita($codigo,$nom,$entidad,$tipo,$fechaI,$fechaS,$fechaA,$observa,$medico);
        $objeto->paginacionCitas();
        $objeto->verCitas();
   }

   /*modificar citas*/
   if(isset($_POST['modificarCita'])){
        $codigo = $_POST['id_editar'];
        $cedula = $_POST['cedulaEdit'];
        $nom = $_POST['nombreEdit'];
        $entidad = $_POST['entidadEdit'];
        $tipo = $_POST['tipoEdit'];
       
        $fechaS = $_POST['fechaSEdit'];//fecha en la que el usuaro quiere la cita
        $fechaA = $_POST['fechaAEdit'];//fecha que asigna por la IPS
        $observa = $_POST['observaEdit'];
        $medico = $_POST['medicoEdit'];
        $objeto->modificarCita($cedula,$codigo,$nom,$entidad,$tipo,$fechaS,$fechaA,$observa,$medico);
        $objeto->paginacionCitas();
        $objeto->verCitas();
   }

   /*registramos los medicos */
   if(isset($_POST['registrarMedico'])){
        $nombre = $_POST['nombre'];
        $objeto->registrarMedico($nombre);
        $objeto->paginacionMedicos();
        $objeto->verMedicos();
   }

/*aca comienzo para modificar el nombre*/
   if(isset($_POST['modificarDatos'])){
        $cod = $_POST['id_registro'];
        $nombre = $_POST['nombreEditar'];
        $objeto->modificarMedico($cod,$nombre);
        $objeto->paginacionMedicos();
        $objeto->verMedicos();
   }

   /*eliminamos la cita */
   if(isset($_POST['deleteCita'])){
       $cod = $_POST['id_delete'];
       $objeto->eliminarCita($cod);
       $objeto->paginacionCitas();
       $objeto->verCitas();
   }

   if(isset($_POST['deleteEstudianteMenu'])){
       $cod = $_POST['id_delete'];
       $objeto->eliminarEstudiante($cod);
       $objeto->verEstudiantes();
   }

   if(isset($_POST['deleteEstudianteTiempo'])){
       $cod = $_POST['id_delete'];
       $objeto->eliminarEstudiante($cod);
       $objeto->paginacionActulizarTiempo();
       $objeto->verActualizarTiempo();
   }

   /*buscador en tiempo real para modificar los datos personales de los estudiantes*/
   if(isset($_POST['queryCitas'])){
       $palabra = $_POST['queryCitas'];
       $objeto->buscarCitas($palabra);
   }


   /*buscador en tiempo real para los estudiantes que estan pagos y van a renovar el tiempo de uso del gim*/
   if(isset($_POST['queryMedicos'])){
       $palabra = $_POST['queryMedicos'];
       $objeto->buscarMedicos($palabra);
   }
  /*buscador en tiempo real para buscar los clientes en el menu principal de todas las condiciones de pago*/
  if(isset($_POST['queryMenu'])){
      $palabra = $_POST['queryMenu'];
      $objeto->buscarCitasInicio($palabra);
  }

   /*MODIFICAR DATOS DEL USURIOO Y CREAR USUARIO*/
   if(isset($_POST['editNomUser'])){
     $nom = $_POST['nombre'];
     $cod = $_POST['id_registro'];
     $objeto->editarNombreUser($nom,$cod);
   }

   if(isset($_POST['UserModificarContra'])){
     $conA = $_POST['contraseñaA'];
     $conN = $_POST['contraseñaN'];
     $cod = $_POST['id_registro'];
     $objeto->cambiarClave($conA,$conN,$cod);
   }

   if(isset($_POST['registrarUser'])){
      $nom = $_POST['nombre'];
      $clave = $_POST['contraseña'];
      $objeto->registrarUser($nom,$clave);
   }

?>