<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Empleados</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
      
   <?php include("view/modulos/links_css.php"); ?>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
   
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">

 <?php  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
  ?>
    
    
    <div class="wrapper">

  <header class="main-header">
  
      <?php include("view/modulos/logo.php"); ?>
      <?php include("view/modulos/head.php"); ?>	
    
  </header>

   <aside class="main-sidebar">
    <section class="sidebar">
     <?php include("view/modulos/menu_profile.php"); ?>
      <br>
     <?php include("view/modulos/menu.php"); ?>
    </section>
  </aside>

  <div class="content-wrapper">
   		<section class="content-header">
            <h1>
            
            	<small><?php echo $fecha; ?></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Empleados</li>
            </ol>
        </section>
        
        <!-- comienza diseño controles usuario -->
        
        <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Registrar Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">





            <form  action="<?php echo $helper->url("Empleados","InsertaEmpleados"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12 col-md-12 col-xs-12">
                               
                           <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
                 
                                    
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="<?php echo $resEdit->id_empleados; ?>" >
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value="<?php echo $resEdit->identificacion_empleados; ?>"  placeholder="identificación..">
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-3 col-xs-12 col-md-3">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value="<?php echo $resEdit->apellidos_empleados; ?>"  placeholder="apellidos..">
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-3 col-xs-12 col-md-3">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value="<?php echo $resEdit->nombres_empleados; ?>"  placeholder="nombres..">
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                   
            
                                <div class="col-lg-2 col-xs-12 col-md-2">
                        		<div class="form-group">
                                                          <label for="fecha_nacimiento_empleados" class="control-label">Fecha Nacimiento:</label>
                                                          <input type="date" class="form-control" id="fecha_nacimiento_empleados" name="fecha_nacimiento_empleados" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $resEdit->fecha_nacimiento_empleados; ?>" placeholder="fecha nacimiento..">
                                                          <div id="mensaje_fecha_nacimiento_empleados" class="errores"></div>
                                </div>
                        		</div>
                                
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_sexo" class="control-label">Género:</label>
                                                          <select name="id_sexo" id="id_sexo"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSexo as $res) {?>
                        										<option value="<?php echo $res->id_sexo; ?>" <?php if ($res->id_sexo == $resEdit->id_sexo )  echo  ' selected="selected" '  ;  ?>><?php echo $res->nombre_sexo; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_sexo" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		   
                    		   
                    		   
                    		    
                    		    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="fecha_empieza_a_laborar" class="control-label">Fecha Inicia Labores:</label>
                                                          <input type="date" class="form-control" id="fecha_empieza_a_laborar" name="fecha_empieza_a_laborar"  max="<?php echo date('Y-m-d'); ?>" value="<?php echo $resEdit->fecha_empieza_a_laborar; ?>" placeholder="fecha labora..">
                                                          <div id="mensaje_fecha_empieza_a_laborar" class="errores"></div>
                                </div>
                    		    </div>
                    		    
                    		    
             <div class="col-md-2 col-lg-2 col-xs-12">
							     					   <label for="salario_basico" class="control-label">Salario Basico:</label>
							        				  <input type="text" class="form-control cantidades1" id="salario_basico" name="salario_basico" value='<?php echo $resEdit->salario_basico; ?>' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" >
                                 		        	   <div id="mensaje_salario_basico" class="errores"></div>
					             </div>
					        
                    	           	
                    	           	
                    	           	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Actualizar</i></button>
                                					  <a href="index.php?controller=Empleados&action=index" class="btn btn-primary" ><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></a>
				  		
                                </div>
                    		    </div>
                    		    </div>
                    	           	
                    
                 
                               
                    		  
                                
                    	   <?php } } else {?>
                    		    
                 				   
             					  
                                    
                                   <div class="col-lg-2 col-xs-12 col-md-2">
                        		   <div class="form-group">
                                                      <label for="identificacion_empleados" class="control-label">Identificación:</label>
                                                      <input type="hidden" class="form-control" id="id_empleados" name="id_empleados" value="0" >
                                                      <input type="number" class="form-control" id="identificacion_empleados" name="identificacion_empleados" value=""  placeholder="identificación..">
                                                      <div id="mensaje_identificacion_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-3 col-xs-12 col-md-3">
                        		   <div class="form-group">
                                                      <label for="apellidos_empleados" class="control-label">Apellidos:</label>
                                                      <input type="text" class="form-control" id="apellidos_empleados" name="apellidos_empleados" value=""  placeholder="apellidos..">
                                                      <div id="mensaje_apellidos_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                    
                                   <div class="col-lg-3 col-xs-12 col-md-3">
                        		   <div class="form-group">
                                                      <label for="nombres_empleados" class="control-label">Nombres:</label>
                                                      <input type="text" class="form-control" id="nombres_empleados" name="nombres_empleados" value=""  placeholder="nombres..">
                                                      <div id="mensaje_nombres_empleados" class="errores"></div>
                                    </div>
                                    </div>
                                   
                                   
             
                                <div class="col-lg-2 col-xs-12 col-md-2">
                        		<div class="form-group">
                                                          <label for="fecha_nacimiento_empleados" class="control-label">Fecha Nacimiento:</label>
                                                          <input type="date" class="form-control" id="fecha_nacimiento_empleados" name="fecha_nacimiento_empleados" max="<?php echo date('Y-m-d'); ?>" value="" placeholder="fecha nacimiento..">
                                                          <div id="mensaje_fecha_nacimiento_empleados" class="errores"></div>
                                </div>
                        		</div>
                                
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="id_sexo" class="control-label">Género:</label>
                                                          <select name="id_sexo" id="id_sexo"  class="form-control" >
                                                          <option value="0" selected="selected">--Seleccione--</option>
                        									<?php foreach($resultSexo as $res) {?>
                        										<option value="<?php echo $res->id_sexo; ?>"><?php echo $res->nombre_sexo; ?> </option>
                        							        <?php } ?>
                        								   </select> 
                                                          <div id="mensaje_id_sexo" class="errores"></div>
                                </div>
                    		    </div>       		    
                    		   
                    		   
                    		     <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group">
                                                          <label for="fecha_empieza_a_laborar" class="control-label">Fecha Inicia Labores:</label>
                                                          <input type="date" class="form-control" id="fecha_empieza_a_laborar" name="fecha_empieza_a_laborar"  max="<?php echo date('Y-m-d'); ?>" value="" placeholder="fecha labora..">
                                                          <div id="mensaje_fecha_empieza_a_laborar" class="errores"></div>
                                </div>
                    		    </div>
                                    

 								<div class="col-md-2 col-lg-2 col-xs-12">
							     					   <label for="salario_basico" class="control-label">Salario Basico:</label>
							        				   <input type="text" class="form-control cantidades1" id="salario_basico" name="salario_basico" value='0.00' 
                                                       data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false" >
                                 		        	   <div id="mensaje_salario_basico" class="errores"></div>
					             </div>
					        		    
                    	           	
                    	           	
                    	        <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px">
                    		    <div class="form-group">
                                                      <button type="submit" id="Guardar" name="Guardar" class="btn btn-success"><i class="glyphicon glyphicon-floppy-saved"> Guardar</i></button>
                                					  <button type="button" id="Cancelar" name="Cancelar" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-remove"> Cancelar</i></button>
                                
                                </div>
                    		    </div>
                    		    </div>
                    	           	
                    	           	
                    		     <?php } ?>
                  
              </form>
  			</div>
      	</div>
   	</section>
    		
    		
    		
    		
       <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Listado Empleados</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">
            
            
            
            
            
           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activos" data-toggle="tab">Empleados Activos</a></li>
             </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
              <div class="tab-pane active" id="activos">
                
					<div class="pull-right" style="margin-right:15px;">
						<input type="text" value="" class="form-control" id="search_activos" name="search_activos" onkeyup="load_empleados_activos(1)" placeholder="search.."/>
					</div>
					<div id="load_activos_registrados" ></div>	
					<div id="empleados_activos_registrados"></div>	
                
              </div>
              
             
             
            </div>
            </div>
          </div>
            
            </div>
            </div>
            </section>
            
            
            
            
             <!-- PARA VENTANAS MODALES -->
    
      <div class="modal fade" id="mod_calcular" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ficha Empleado</h4>
          </div>
          <div class="modal-body">
          <!-- empieza el formulario modal productos -->
          	<form class="form-horizontal" method="post" id="frm_reasignar" name="frm_reasignar">
          	
          	  <input type="hidden" class="form-control" id="mod_id_empleados" name="mod_id_empleados"  readonly>
				
          	 
			  
			  	<div id="load_ficha_registrados" ></div>	
				<div id="ficha_empleados_registrados"></div>	
                
			
		  
          	</form>
          	<!-- termina el formulario modal lote -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		   </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
    
            
            
            
    
  	</div>
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    
   <?php include("view/modulos/links_js.php"); ?>
   
    
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
 
	<script src="view/bootstrap/otros/inputmask_bundle/jquery.inputmask.bundle.js"></script>
       <script>
      $(document).ready(function(){
      $(".cantidades1").inputmask();
      });
	  </script>
   
   
   
   
   
	<script type="text/javascript">
    	var id = 0;
    	
    	$("#empleados_activos_registrados").on("click","#btn_abrir",function(event){
    		var $div_respuesta = $("#msg_frm_reasignar"); $div_respuesta.text("").removeClass();
    	    
    		id = $(this).data().id;
    		
    
    		$("#mod_calcular").on('show.bs.modal',function(e){
    
    			 var modal = $(this)
    			 modal.find('#mod_id_empleados').val(id);
    			
    			 cargarFicha(id);
    			
    		}) 
    		
    	})
    	
    	
    	
    	
    	
    	
    	
    	
    	 function cargarFicha(id){

    		var con_datos={
    				action:'ajax',
    				id_empleados:id
 					  };
		
    		 $.ajax({
 	               beforeSend: function(objeto){
 	                 $("#load_ficha_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
 	               },
 	               url: 'index.php?controller=Empleados&action=cargar_ficha',
 	               type: 'POST',
 	               data: con_datos,
 	               success: function(x){
 	                 $("#ficha_empleados_registrados").html(x);
 	               	 //$("#tabla_empleados").tablesorter(); 
 	                 $("#load_ficha_registrados").html("");
 	               },
 	              error: function(jqXHR,estado,error){
 	                $("#ficha_empleados_registrados").html("Ocurrio un error al cargar la información de Empleados..."+estado+"    "+error);
 	              }
 	            });
	}
    	
   
   </script>
   
   
   
    <script type="text/javascript">
     
        	   $(document).ready( function (){
        		   load_empleados_activos(1);
        		});

        	          	   
        	   function load_empleados_activos(pagina){

        		   var search=$("#search_activos").val();
                   var con_datos={
           					  action:'ajax',
           					  page:pagina
           					  };
                 $("#load_activos_registrados").fadeIn('slow');
           	     $.ajax({
           	               beforeSend: function(objeto){
           	                 $("#load_activos_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>')
           	               },
           	               url: 'index.php?controller=Empleados&action=index10&search='+search,
           	               type: 'POST',
           	               data: con_datos,
           	               success: function(x){
           	                 $("#empleados_activos_registrados").html(x);
           	               	 $("#tabla_empleados").tablesorter(); 
           	                 $("#load_activos_registrados").html("");
           	               },
           	              error: function(jqXHR,estado,error){
           	                $("#empleados_activos_registrados").html("Ocurrio un error al cargar la informacion de Empleados Activos..."+estado+"    "+error);
           	              }
           	            });

           		   }


        	        </script>
        
        
        
        
        		    
			
        
        
        
        
         <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    $("#Cancelar").click(function() 
			{
		    	$('#identificacion_empleados').val("");
				$('#apellidos_empleados').val("");
				$('#nombres_empleados').val("");
				$('#fecha_nacimiento_empleados').val("");
				$("#id_empleados").val("0");
		        $("#id_sexo").val("0");
		        $("#fecha_empieza_a_laborar").val("");
		        $("#salario_basico").val("0.00");

		        
		        
		     
		    }); 
		    }); 
			</script>
        
        
          
        <script>
        

	       	$(document).ready(function(){

                        var id_empleados = $("#id_empleados").val();

                        if(id_empleados>0){}else{
        	       		
						$( "#identificacion_empleados" ).autocomplete({
		      				source: "<?php echo $helper->url("Empleados","AutocompleteCedula"); ?>",
		      				minLength: 1
		    			});
		
						$("#identificacion_empleados").focusout(function(){
		    				$.ajax({
		    					url:'<?php echo $helper->url("Empleados","AutocompleteDevuelveNombres"); ?>',
		    					type:'POST',
		    					dataType:'json',
		    					data:{identificacion_empleados:$('#identificacion_empleados').val()}
		    				}).done(function(respuesta){

		    				    $('#identificacion_empleados').val(respuesta.identificacion_empleados);
		    					$('#apellidos_empleados').val(respuesta.apellidos_empleados);
		    					$('#nombres_empleados').val(respuesta.nombres_empleados);
		    					$("#id_empleados").val(respuesta.id_empleados);
		    			        $("#id_sexo").val(respuesta.id_sexo);
		    			        $("#fecha_nacimiento_empleados").val(respuesta.fecha_nacimiento_empleados);
		    			        $("#fecha_empieza_a_laborar").val(respuesta.fecha_empieza_a_laborar);
		    			        $("#salario_basico").val(respuesta.salario_basico);

		    			        
		    					
		    					
		    				
		        			}).fail(function(respuesta) {

		        				
		        				$('#apellidos_empleados').val("");
		        				$('#nombres_empleados').val("");
		        				$("#id_empleados").val("0");
		        		        $("#id_sexo").val("0");
		        		        $("#fecha_nacimiento_empleados").val("");
		        		        $("#fecha_empieza_a_laborar").val("");
		        		        $("#salario_basico").val("0.00");

		        		        
		    					
		        			    
		        			  });
		    				 
		    				
		    			});  
                        }
						
		    		});
		
	     
		     </script>
        
         
        <script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{


				
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;


		    	var identificacion_empleados  =  $('#identificacion_empleados').val();
		    	var apellidos_empleados  =  $('#apellidos_empleados').val();
		    	var nombres_empleados  =  $('#nombres_empleados').val();
		    	var fecha_nacimiento_empleados  =  $('#fecha_nacimiento_empleados').val();
		    	var id_empleados  =  $("#id_empleados").val();
		    	var id_sexo  =  $("#id_sexo").val();
				var fecha_empieza_a_laborar =  $("#fecha_empieza_a_laborar").val();
				var salario_basico =  $("#salario_basico").val();

				
		    	var contador=0;
		    	var tiempo = tiempo || 1000;



		    	var suma = 0;      
		        var residuo = 0;      
		        var pri = false;      
		        var pub = false;            
		        var nat = false;      
		        var numeroProvincias = 22;                  
		        var modulo = 11;
		                    
		        /* Verifico que el campo no contenga letras */                  
		        var ok=1;


		        for (i=0; i<identificacion_empleados.length && ok==1 ; i++){
		            var n = parseInt(identificacion_empleados.charAt(i));
		            if (isNaN(n)) ok=0;
		         }


		        /* Los primeros dos digitos corresponden al codigo de la provincia */
		        provincia = identificacion_empleados.substr(0,2);


		        /* Aqui almacenamos los digitos de la cedula en variables. */
		        d1  = identificacion_empleados.substr(0,1);         
		        d2  = identificacion_empleados.substr(1,1);         
		        d3  = identificacion_empleados.substr(2,1);         
		        d4  = identificacion_empleados.substr(3,1);         
		        d5  = identificacion_empleados.substr(4,1);         
		        d6  = identificacion_empleados.substr(5,1);         
		        d7  = identificacion_empleados.substr(6,1);         
		        d8  = identificacion_empleados.substr(7,1);         
		        d9  = identificacion_empleados.substr(8,1);         
		        d10 = identificacion_empleados.substr(9,1);                
		           
		        /* El tercer digito es: */                           
		        /* 9 para sociedades privadas y extranjeros   */         
		        /* 6 para sociedades publicas */         
		        /* menor que 6 (0,1,2,3,4,5) para personas naturales */ 





		        /* Solo para personas naturales (modulo 10) */         
		        if (d3 < 6){           
		           nat = true;            
		           p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;
		           p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;
		           p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;
		           p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;
		           p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;
		           p6 = d6 * 1;  if (p6 >= 10) p6 -= 9; 
		           p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;
		           p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;
		           p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;             
		           modulo = 10;
		        }         
		        /* Solo para sociedades publicas (modulo 11) */                  
		        /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */
		        else if(d3 == 6){           
		           pub = true;             
		           p1 = d1 * 3;
		           p2 = d2 * 2;
		           p3 = d3 * 7;
		           p4 = d4 * 6;
		           p5 = d5 * 5;
		           p6 = d6 * 4;
		           p7 = d7 * 3;
		           p8 = d8 * 2;            
		           p9 = 0;            
		        }         
		           
		        /* Solo para entidades privadas (modulo 11) */         
		        else if(d3 == 9) {           
		           pri = true;                                   
		           p1 = d1 * 4;
		           p2 = d2 * 3;
		           p3 = d3 * 2;
		           p4 = d4 * 7;
		           p5 = d5 * 6;
		           p6 = d6 * 5;
		           p7 = d7 * 4;
		           p8 = d8 * 3;
		           p9 = d9 * 2;            
		        }
		                  
		        suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;                
		        residuo = suma % modulo;                                         
		        /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/
		        digitoVerificador = residuo==0 ? 0: modulo - residuo; 


		    	
		    	if (identificacion_empleados == "")
		    	{
			    	
		    		$("#mensaje_identificacion_empleados").text("Ingrese Identificación");
		    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error

		    		$("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
			        return false;
			    }
		    	else 
		    	{



						 if (ok==0){
							 $("#mensaje_identificacion_empleados").text("Ingrese solo números");
					    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
					           
					            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
					            return false;
					      }else{

								$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						
						  }
						
						
						if(identificacion_empleados.length==10){

							$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						}else{
							
							$("#mensaje_identificacion_empleados").text("Ingrese 10 Digitos");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;
						}



						if (provincia < 1 || provincia > numeroProvincias){           
							$("#mensaje_identificacion_empleados").text("El código de la provincia (dos primeros dígitos) es inválido");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;

					      }else{

					    		$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
								
						  }



						if (d3==7 || d3==8){           

							$("#mensaje_identificacion_empleados").text("El tercer dígito ingresado es inválido");
				    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
				           
				            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
				            return false;
					      }
						else{

							$("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							
							}



						if(nat == true){         
					         if (digitoVerificador != d10){    

					        	 $("#mensaje_identificacion_empleados").text("El número de cédula de la persona natural es incorrecto.");
						    		$("#mensaje_identificacion_empleados").fadeIn("slow"); //Muestra mensaje de error
						           
						            $("html, body").animate({ scrollTop: $(mensaje_identificacion_empleados).offset().top-120 }, tiempo);
						            return false;
						       
					         }else{

						        	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
						     }  

					     }else{

					    	 $("#mensaje_identificacion_empleados").fadeOut("slow"); //Muestra mensaje de error
							   
						 }
						
					
    
				}    


		    	if (apellidos_empleados == "")
		    	{
			    	
		    		$("#mensaje_apellidos_empleados").text("Introduzca Apellidos");
		    		$("#mensaje_apellidos_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_apellidos_empleados).offset().top-120 }, tiempo);
			        
			            return false;
			    }
		    	else 
		    	{

		    		contador=0;
		    		numeroPalabras=0;
		    		contador = apellidos_empleados.split(" ");
		    		numeroPalabras = contador.length;
		    		
					if(numeroPalabras==2){

						$("#mensaje_apellidos_empleados").fadeOut("slow"); //Muestra mensaje de error
				                     
			             
					}else{
						$("#mensaje_apellidos_empleados").text("Introduzca 2 Apellidos");
			    		$("#mensaje_apellidos_empleados").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_apellidos_empleados).offset().top-120 }, tiempo);
			            return false;
					}
			    	
				}



		    	if (nombres_empleados == "")
		    	{
			    	
		    		$("#mensaje_nombres_empleados").text("Introduzca Nombres");
		    		$("#mensaje_nombres_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_nombres_empleados).offset().top-120 }, tiempo);
			        
			            return false;
			    }
		    	else 
		    	{

		    		contador=0;
		    		numeroPalabras=0;
		    		contador = nombres_empleados.split(" ");
		    		numeroPalabras = contador.length;
		    		
					if(numeroPalabras==2){

						$("#mensaje_nombres_empleados").fadeOut("slow"); //Muestra mensaje de error
				                     
			             
					}else{
						$("#mensaje_nombres_empleados").text("Introduzca 2 Nombres");
			    		$("#mensaje_nombres_empleados").fadeIn("slow"); //Muestra mensaje de error
			           
			            $("html, body").animate({ scrollTop: $(mensaje_nombres_empleados).offset().top-120 }, tiempo);
			            return false;
					}
			    	
				}


		    	
				
		    	if (fecha_nacimiento_empleados == "" )
		    	{
			    	
		    		$("#mensaje_fecha_nacimiento_empleados").text("Seleccione Fecha Nac");
		    		$("#mensaje_fecha_nacimiento_empleados").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_fecha_nacimiento_empleados).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_nacimiento_empleados").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    	if (id_sexo == 0 )
		    	{
			    	
		    		$("#mensaje_id_sexo").text("Seleccione");
		    		$("#mensaje_id_sexo").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_id_sexo).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_id_sexo").fadeOut("slow"); //Muestra mensaje de error
		            
				}


		    			    	
		    	if (fecha_empieza_a_laborar == "" )
		    	{
			    	
		    		$("#mensaje_fecha_empieza_a_laborar").text("Seleccione");
		    		$("#mensaje_fecha_empieza_a_laborar").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_fecha_empieza_a_laborar).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha_empieza_a_laborar").fadeOut("slow"); //Muestra mensaje de error
		            
				}



		    	if (salario_basico == 0 )
		    	{
			    	
		    		$("#mensaje_salario_basico").text("Ingrese Salario");
		    		$("#mensaje_salario_basico").fadeIn("slow"); //Muestra mensaje de error
		    		$("html, body").animate({ scrollTop: $(mensaje_salario_basico).offset().top-120 }, tiempo);
					
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_salario_basico").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
						    	
		    	
		    				    

			}); 

		    

		        $( "#identificacion_empleados" ).focus(function() {
					  $("#mensaje_identificacion_empleados").fadeOut("slow");
				 });
		        $( "#apellidos_empleados" ).focus(function() {
					  $("#mensaje_apellidos_empleados").fadeOut("slow");
				 });
		        $( "#nombres_empleados" ).focus(function() {
					  $("#mensaje_nombres_empleados").fadeOut("slow");
				 });
		       
		        			     $( "#fecha_nacimiento_empleados" ).focus(function() {
					  $("#mensaje_fecha_nacimiento_empleados").fadeOut("slow");
				 });  


			     $( "#id_sexo" ).focus(function() {
					  $("#mensaje_id_sexo").fadeOut("slow");
				 }); 
				
				 $( "#fecha_empieza_a_laborar" ).focus(function() {
					  $("#mensaje_fecha_empieza_a_laborar").fadeOut("slow");
				 }); 
				 
				
		        $( "#salario_basico" ).focus(function() {
					  $("#mensaje_salario_basico").fadeOut("slow");
				 });
		}); 

	</script>
        
      
   
	
  </body>
</html>   