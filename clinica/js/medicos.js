$(document).ready(function(){
   /*medicos*/
      $('#nuevoMedico').dialog({//con esto cargamos los formulario de los gastos y de los cierre no es necesario repetir el codigo
            autoOpen: false,
            modal: true,
            width:400,
            height:'auto',
            resizable: false,
            close:function(){
                  $('#id_registro').val('0');
            }
      });
     
     /*cerrar ventana de modificar ventana de fechas vencimientos*/
      $('body').on('click','#cancelar',function(e){
         e.preventDefault();
         $('#nuevoMedico').dialog('close');
      });

      //editar Registro
      $('body').on('click','#nuevo',function(e){
            e.preventDefault();
         //abreimos el formulario
            $('#nuevoMedico').dialog('open');
      });

      /*_______________________________________________________*/

      /* metodo para refrescar los prestamos del mes */
   var peticion = $('#nuevoMedico form').attr('action');
   var metodo = $('#nuevoMedico form').attr('method');

    $('#nuevoMedico form').on('click','#registrarMedico',function(e){
                e.preventDefault();

                $.ajax({
                  beforeSend: function(){

                  },
                  url: peticion,
                  type: metodo,
                  data: $('#nuevoMedico form').serialize(),
                  success: function(resp){
                        console.log(resp);
                        if(resp == "Error"){
                           setTimeout(function(){ $("#mensajeError .alert").fadeOut(1000).fadeIn(1000).fadeOut(800).fadeIn(500).fadeOut(300);}, 1000); 
                           var error = '<div class="alert alert-error">'+'<button type="button" class="close" data-dismiss="alert">'+'X'+'</button>'+'<strong>'+'Error'+'</strong>'+'<br> No se Pudo registrar verifique el N° de identificacion'+'</div>';
                           $('#mensajeError .alert').remove();
                           $('#mensajeError').html(error);
                        }else{
                           $('#verMedicos').empty();//limpiar la tabla.
                           $('#verMedicos').html(resp);//imprimir datos de la tabla.
                           setTimeout(function(){ $("#mensaje .alert").fadeOut(1000).fadeIn(900).fadeOut(800).fadeIn(700).fadeOut(300);}, 1000); 
                           var exito = '<div class="alert alert-success">'+'<button type="button" class="close" data-dismiss="alert">'+'X'+'</button>'+'<strong>'+'Registro guardado '+'</strong>'+' el registro se agrego correctamente'+'</div>';
                           $('#mensaje').html(exito);//impresion del mensaje exitoso.
                           $('.limpiar')[0].reset();///limpiamos los campos del formulario.
                           $('#buscar').focus();///indicamos el foco al primer valor del formulario.
                           $('#nuevoMedico').dialog('close');
                        }
                  },
                  error: function(jqXHR,estado,error){
                        console.log(estado);
                        console.log(error);
                  },
                  complete: function(jqXHR,estado){
                        console.log(estado);
                  },
                  timeout: 10000 //10 segundos.
                });
    });

});/*cierre del document*/