<?php
  class funciones{
     private $bd;
     function __construct(){
         require_once('config.php');
         $bd = new conexion();
         $bd->conectar();
     }

    public function login($user,$pass){
         session_start();
         $truco=sha1($pass);
         $resultado = mysql_query("SELECT * FROM usuarios WHERE nombre='$user' AND clave='$truco'");
         $fila = mysql_fetch_array($resultado);
         if($fila>0){
         	$id_user=$fila['id'];
            $user = $fila['nombre'];
         	$_SESSION['id_user']=$id_user;
            $_SESSION['nombre'] = $user;
         	return true;
         }else{
         	return false;
         }
    }

    /*funcion para registrar las citas */
    public function registrarCita($documento,$codigo,$nom,$entidad,$tipo,$fechaI,$fechaS,$fechaA,$observa,$medico){/**/
        if($fechaS == ''){
            $fechaS = '0000-00-00';
        }else{
            if($fechaA == ''){
                $fechaA = '0000-00-00';
            }
        }
        mysql_query("INSERT INTO citas (documento,numero,nombre,entidad,tipo,fechaSolicitud,fechaAsignacionPaciente,fechaAsignacionSistema,observaciones,doctor)
                                      VALUES ( '$documento', '$codigo', '$nom', '$entidad', '$tipo', '$fechaI', '$fechaS', '$fechaA', '$observa', '$medico')")
                                      or die ("Error");
    }

    /*funcion para registrar prestamo */
    public function registrarMedico($nombre){
        mysql_query("INSERT INTO medicos (nombreMedico)
                                        VALUES ('$nombre')")
                                or die ("Error");
    }

    /*public function saldoCero(){
        $resultado = mysql_query("SELECT * FROM prestamos WHERE saldo='0'");
        while($fila = mysql_fetch_array($resultado)){
            return true;
        }
    }*/

    /*ver todas las citas */
    public function verCitasInicio(){
        $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

        if(isset($_GET["pagina"])){
            $num_pag = $_GET["pagina"];//numero de la pagina
        }else{
            $num_pag = 1;
        }

        if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
            $inicio = 0;
            $num_pag = 1;
        }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
            $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
        }

        $resultado = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC LIMIT $inicio,$cant_reg");
        while($fila = mysql_fetch_array($resultado)){
            echo '<tr>
                    <td>'.$fila['documento'].'</td>  
                    <td>'.$fila['numero'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['entidad'].'</td>
                    <td>'.$fila['tipo'].'</td>
                    <td>'.$fila['fechaSolicitud'].'</td>
                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
                    <td>'.$fila['fechaAsignacionSistema'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                </tr>';
        }
    }

    /*paginacion citas inicio*/
    public function paginacionCitasInicio(){
            $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

            if(isset($_GET["pagina"])){
                $num_pag = $_GET["pagina"];//numero de la pagina
            }else{
                $num_pag = 1;
            }

            if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
                $inicio = 0;
                $num_pag = 1;

            }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
                $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
            }
            $result = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC");///hacemos una consulta de todos los datos de cinternet
           
            $total_registros=mysql_num_rows($result);//obtenesmos el numero de datos que nos devuelve la consulta

            $total_paginas = ceil($total_registros/$cant_reg);

            echo '<div class="pagination" style="display: none;">
                    ';
            if(($num_pag+1)<=$total_paginas){//preguntamos si el numero de la pagina es menor o = al total de paginas para que aparesca el siguiente
                
                echo "<ul><li class='next'> <a href='menu.php?pagina=".($num_pag+1)."'> Next </a></li></ul>";
            } ;echo '
                   </div>';
    }/*fin*/

    /*buscador en tiempo real de las citas en inicio */
    public function buscarCitasInicio($palabra){
        if($palabra == ''){
            $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

            if(isset($_GET["pagina"])){
                $num_pag = $_GET["pagina"];//numero de la pagina
            }else{
                $num_pag = 1;
            }

            if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
                $inicio = 0;
                $num_pag = 1;
            }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
                $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
            }

            $result = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC");///hacemos una consulta de todos los datos de cinternet
           
            $total_registros=mysql_num_rows($result);//obtenesmos el numero de datos que nos devuelve la consulta

            $total_paginas = ceil($total_registros/$cant_reg);

            echo '<div class="pagination" style="display: none;">
                    ';
            if(($num_pag+1)<=$total_paginas){//preguntamos si el numero de la pagina es menor o = al total de paginas para que aparesca el siguiente
                
                echo "<ul><li class='next'> <a href='menu.php?pagina=".($num_pag+1)."'> Next </a></li></ul>";
            } ;echo '
                   </div>';

           $resultado = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC LIMIT $inicio,$cant_reg");//obtenemos los datos ordenados limitado con la variable inicio hasta la variable cant_reg
            while($fila = mysql_fetch_array($resultado)){
                 echo '<tr>
                    <td>'.$fila['documento'].'</td>  
                    <td>'.$fila['numero'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['entidad'].'</td>
                    <td>'.$fila['tipo'].'</td>
                    <td>'.$fila['fechaSolicitud'].'</td>
                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
                    <td>'.$fila['fechaAsignacionSistema'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                </tr>';
            }/*cierre del while*/
        }else{
            $resultado = mysql_query("SELECT * FROM citas,medicos WHERE (citas.doctor=medicos.idMedico AND nombreMedico LIKE'%$palabra%')
                                                OR (citas.doctor=medicos.idMedico AND entidad LIKE'%$palabra%') OR (citas.doctor=medicos.idMedico AND fechaSolicitud LIKE'%$palabra%') 
                                                OR (citas.doctor=medicos.idMedico AND nombre LIKE'%$palabra%')");
            //echo json_encode($resultado);
            while($fila = mysql_fetch_array($resultado)){
                echo '<tr>
                    <td>'.$fila['documento'].'</td> 
                    <td>'.$fila['numero'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['entidad'].'</td>
                    <td>'.$fila['tipo'].'</td>
                    <td>'.$fila['fechaSolicitud'].'</td>
                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
                    <td>'.$fila['fechaAsignacionSistema'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                </tr>';
            }/*cierre del while*/
        }
    }/*fin*/

    /*ver todas las citas */
    public function verCitas(){
        $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

        if(isset($_GET["pagina"])){
            $num_pag = $_GET["pagina"];//numero de la pagina
        }else{
            $num_pag = 1;
        }

        if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
            $inicio = 0;
            $num_pag = 1;
        }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
            $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
        }

        $resultado = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC LIMIT $inicio,$cant_reg");
        while($fila = mysql_fetch_array($resultado)){
            echo '<tr>
                    <td>'.$fila['documento'].'</td> 
                    <td>'.$fila['numero'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['entidad'].'</td>
                    <td>'.$fila['tipo'].'</td>
                    <td>'.$fila['fechaSolicitud'].'</td>
                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
                    <td>'.$fila['fechaAsignacionSistema'].'</td>
                    <td>'.$fila['observaciones'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                    <td><a id="editar" class="btn btn-mini btn-info" href="'.$fila['id'].'"><i class="icon-eye-open"></i></a></td>
                    <td><a id="delete" class="btn btn-mini btn-danger" href="'.$fila['id'].'"><i class="icon-remove-sign"></i></a></td>
                </tr>';
        }
    }

    /*paginacion citas*/
    public function paginacionCitas(){
            $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

            if(isset($_GET["pagina"])){
                $num_pag = $_GET["pagina"];//numero de la pagina
            }else{
                $num_pag = 1;
            }

            if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
                $inicio = 0;
                $num_pag = 1;

            }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
                $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
            }
            $result = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC");///hacemos una consulta de todos los datos de cinternet
           
            $total_registros=mysql_num_rows($result);//obtenesmos el numero de datos que nos devuelve la consulta

            $total_paginas = ceil($total_registros/$cant_reg);

            echo '<div class="pagination" style="display: none;">
                    ';
            if(($num_pag+1)<=$total_paginas){//preguntamos si el numero de la pagina es menor o = al total de paginas para que aparesca el siguiente
                
                echo "<ul><li class='next'> <a href='citas.php?pagina=".($num_pag+1)."'> Next </a></li></ul>";
            } ;echo '
                   </div>';
    }

    /*buscador en tiempo real de los citas */
    public function buscarCitas($palabra){
        if($palabra == ''){
            $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

            if(isset($_GET["pagina"])){
                $num_pag = $_GET["pagina"];//numero de la pagina
            }else{
                $num_pag = 1;
            }

            if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
                $inicio = 0;
                $num_pag = 1;
            }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
                $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
            }

            $result = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC");///hacemos una consulta de todos los datos de cinternet
           
            $total_registros=mysql_num_rows($result);//obtenesmos el numero de datos que nos devuelve la consulta

            $total_paginas = ceil($total_registros/$cant_reg);

            echo '<div class="pagination" style="display: none;">
                    ';
            if(($num_pag+1)<=$total_paginas){//preguntamos si el numero de la pagina es menor o = al total de paginas para que aparesca el siguiente
                
                echo "<ul><li class='next'> <a href='citas.php?pagina=".($num_pag+1)."'> Next </a></li></ul>";
            } ;echo '
                   </div>';

           $resultado = mysql_query("SELECT * FROM citas,medicos WHERE citas.doctor=medicos.idMedico ORDER BY citas.id ASC LIMIT $inicio,$cant_reg");//obtenemos los datos ordenados limitado con la variable inicio hasta la variable cant_reg
            while($fila = mysql_fetch_array($resultado)){
                 echo '<tr> 
                    <td>'.$fila['documento'].'</td> 
                    <td>'.$fila['numero'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['entidad'].'</td>
                    <td>'.$fila['tipo'].'</td>
                    <td>'.$fila['fechaSolicitud'].'</td>
                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
                    <td>'.$fila['fechaAsignacionSistema'].'</td>
                    <td>'.$fila['observaciones'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                    <td><a id="editar" class="btn btn-mini btn-info" href="'.$fila['id'].'"><i class="icon-eye-open"></i></a></td>
                    <td><a id="delete" class="btn btn-mini btn-danger" href="'.$fila['id'].'"><i class="icon-remove-sign"></i></a></td>
                </tr>';
            }/*cierre del while*/
        }else{
            $resultado = mysql_query("SELECT * FROM citas,medicos WHERE (citas.doctor=medicos.idMedico AND nombreMedico LIKE'%$palabra%')
                                                OR (citas.doctor=medicos.idMedico AND entidad LIKE'%$palabra%') OR (citas.doctor=medicos.idMedico AND fechaSolicitud LIKE'%$palabra%') 
                                                OR (citas.doctor=medicos.idMedico AND nombre LIKE'%$palabra%')");
            //echo json_encode($resultado);
            while($fila = mysql_fetch_array($resultado)){
                echo '<tr> 
                    <td>'.$fila['documento'].'</td> 
                    <td>'.$fila['numero'].'</td>
                    <td>'.$fila['nombre'].'</td>
                    <td>'.$fila['entidad'].'</td>
                    <td>'.$fila['tipo'].'</td>
                    <td>'.$fila['fechaSolicitud'].'</td>
                    <td>'.$fila['fechaAsignacionPaciente'].'</td>
                    <td>'.$fila['fechaAsignacionSistema'].'</td>
                    <td>'.$fila['observaciones'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                    <td><a id="editar" class="btn btn-mini btn-info" href="'.$fila['id'].'"><i class="icon-eye-open"></i></a></td>
                    <td><a id="delete" class="btn btn-mini btn-danger" href="'.$fila['id'].'"><i class="icon-remove-sign"></i></a></td>
                </tr>';
            }/*cierre del while*/
        }
    }/*fin*/

    /*modificamos los nombres de los medicos*/
    public function modificarMedico($cod,$nombre){
        mysql_query("UPDATE medicos SET nombreMedico='$nombre' WHERE idMedico='$cod'")
                 or die('problemas en el update de nombre'.mysql_error());
        
    }

    public function modificarCita($documento,$cedula,$codigo,$nom,$entidad,$tipo,$fechaS,$fechaA,$observa,$medico){
        $resultado =mysql_query("SELECT idMedico FROM medicos WHERE nombreMedico='$medico'");
        if($fila = mysql_fetch_array($resultado)){
            $medico = $fila['idMedico'];
            //echo $medico;
        }
        mysql_query("UPDATE citas SET documento='$documento', numero='$cedula', nombre='$nom', entidad='$entidad', tipo='$tipo',
                                      fechaAsignacionPaciente='$fechaS', fechaAsignacionSistema='$fechaA',observaciones='$observa',
                                      doctor='$medico' WHERE id='$codigo'")
                 or die('problemas en el update de nombre'.mysql_error());
    }

   /*eliminar cita*/
    public function eliminarCita($codigo){
        mysql_query("DELETE FROM citas WHERE id='$codigo'");
    }

    /*ver base de la caja */
    public function verMedicos(){
         $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

        if(isset($_GET["pagina"])){
            $num_pag = $_GET["pagina"];//numero de la pagina
        }else{
            $num_pag = 1;
        }

        if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
            $inicio = 0;
            $num_pag = 1;
        }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
            $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
        }

        $resultado = mysql_query("SELECT * FROM medicos LIMIT $inicio,$cant_reg");
   
        while($fila = mysql_fetch_array($resultado)){
            echo '<tr> 
                    <td>'.$fila['idMedico'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                    <td><a id="editarMedico" class="btn btn-mini btn-info" href="'.$fila['idMedico'].'"><strong>Editar</strong></a></td>
                </tr>';
        }
    }

    /*paginacion medicos*/
    public function paginacionMedicos(){
            $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

            if(isset($_GET["pagina"])){
                $num_pag = $_GET["pagina"];//numero de la pagina
            }else{
                $num_pag = 1;
            }

            if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
                $inicio = 0;
                $num_pag = 1;

            }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
                $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
            }
            $result = mysql_query("SELECT * FROM medicos");///hacemos una consulta de todos los datos de cinternet
           
            $total_registros=mysql_num_rows($result);//obtenesmos el numero de datos que nos devuelve la consulta

            $total_paginas = ceil($total_registros/$cant_reg);

            echo '<div class="pagination" style="display: none;">
                    ';
            if(($num_pag+1)<=$total_paginas){//preguntamos si el numero de la pagina es menor o = al total de paginas para que aparesca el siguiente
                
                echo "<ul><li class='next'> <a href='medicos.php?pagina=".($num_pag+1)."'> Next </a></li></ul>";
            } ;echo '
                   </div>';
    }

    /*buscador en tiempo real de los medicos */
    public function buscarMedicos($palabra){
        if($palabra == ''){
            $cant_reg = 10;//definimos la cantidad de datos que deseamos tenes por pagina.

            if(isset($_GET["pagina"])){
                $num_pag = $_GET["pagina"];//numero de la pagina
            }else{
                $num_pag = 1;
            }

            if(!$num_pag){//preguntamos si hay algun valor en $num_pag.
                $inicio = 0;
                $num_pag = 1;
            }else{//se activara si la variable $num_pag ha resivido un valor oasea se encuentra en la pagina 2 o ha si susecivamente 
                $inicio = ($num_pag-1)*$cant_reg;//si la pagina seleccionada es la numero 2 entonces 2-1 es = 1 por 10 = 10 empiesa a contar desde la 10 para la pagina 2 ok.
            }

            $result = mysql_query("SELECT * FROM medicos");///hacemos una consulta de todos los datos de cinternet
           
            $total_registros=mysql_num_rows($result);//obtenesmos el numero de datos que nos devuelve la consulta

            $total_paginas = ceil($total_registros/$cant_reg);

            echo '<div class="pagination" style="display: none;">
                    ';
            if(($num_pag+1)<=$total_paginas){//preguntamos si el numero de la pagina es menor o = al total de paginas para que aparesca el siguiente
                
                echo "<ul><li class='next'> <a href='medicos.php?pagina=".($num_pag+1)."'> Next </a></li></ul>";
            } ;echo '
                   </div>';

           $resultado = mysql_query("SELECT * FROM medicos LIMIT $inicio,$cant_reg");//obtenemos los datos ordenados limitado con la variable inicio hasta la variable cant_reg
            while($fila = mysql_fetch_array($resultado)){
                 echo '<tr> 
                    <td>'.$fila['idMedico'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                    <td><a id="editarMedico" class="btn btn-mini btn-info" href="'.$fila['idMedico'].'"><strong>Editar</strong></a></td>
                </tr>';
            }/*cierre del while*/
        }else{
            $resultado = mysql_query("SELECT * FROM medicos WHERE (nombreMedico LIKE'%$palabra%')");
            //echo json_encode($resultado);
            while($fila = mysql_fetch_array($resultado)){
               echo '<tr> 
                    <td>'.$fila['idMedico'].'</td>
                    <td>'.$fila['nombreMedico'].'</td>
                    <td><a id="editarMedico" class="btn btn-mini btn-info" href="'.$fila['idMedico'].'"><strong>Editar</strong></a></td>
                </tr>';
            }/*cierre del while*/
        }

    }/*fin*/


    /*Codigo de combox para mostrar nombres de los clientes*/
    public function comboMedicos(){
        $result = mysql_query("SELECT * FROM medicos");
        while ($fila = mysql_fetch_array($result)) {
            echo "<option value='".$fila['idMedico']."'>".$fila['nombreMedico']."
                     </option>";
        }
    }

    public function comboMedicosEdit(){
        $result = mysql_query("SELECT * FROM medicos");
        while ($fila = mysql_fetch_array($result)) {
            echo "<option value='".$fila['nombreMedico']."'>".$fila['nombreMedico']."
                     </option>";
        }
    }

    /*MODIFICAR DATOS DEL USUAIRO Y CREAR....*/
    public function editarNombreUser($nom,$cod){
        $nom = strtolower($nom);
        mysql_query("UPDATE usuarios SET nombre='$nom' WHERE id='$cod'") or die('problemas en el update de nombre'.mysql_error());
        session_start();
         if($_SESSION['id_user']){
             session_destroy();
         }
        $resultado=mysql_query("SELECT * FROM usuarios WHERE id='$cod'")
              or die('Problemas en el select de nombre usuarios'.mysql_error());
        $row=mysql_fetch_array($resultado);
        echo $row['nombre'];
        /*_______________________________*/
        session_start();
        $id_user=$row['id'];
        $user = $row['nombre'];
        $_SESSION['id_user']=$id_user;
        $_SESSION['nombre'] = $user;
    }

    public function cambiarClave($conA,$conN,$cod){
        $hash2=sha1($conA);
        $resultado = mysql_query("SELECT clave FROM usuarios WHERE id='$cod' AND clave='$hash2'");
        
        if($row = mysql_fetch_array($resultado)){
            echo "Bien";
            $hash=sha1($conN);//incriptamos la contraseña
            mysql_query("UPDATE usuarios SET clave='$hash' WHERE id='$cod'");
        }else{
            echo "Error";
        }
    }

    public function registrarUser($nom,$pass){
        $hash=sha1($pass);
         mysql_query("INSERT INTO usuarios (nombre,clave) VALUES ('$nom','$hash')") 
                       or die ("Error"); 
    }

  }//cierre de la clase
?>