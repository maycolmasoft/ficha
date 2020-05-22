<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Empleados</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    
 	<style type="text/css">
 	  .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('view/images/ajax-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
        }
 	  
 	</style>
 	
 	 <style type="text/css">
        div#nombre_discapacidad, div#porcentaje_discapacidad{
            display: none;
        }
    </style>
 	
 
 	
   <?php include("view/modulos/links_css.php"); ?>
  			        
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini"  >

     <?php
        
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
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
        <li><a href="<?php echo $helper->url("ffspUsuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Empleados</li>
      </ol>
    </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Empleados</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
  		<div class="box-body">

			<form id="frm_empleados" action="<?php echo $helper->url("ffspEmpleados","Index"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
             
		    	 <div class="row">
        		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            	          <label for="empl_primer_nombre" class="control-label">Primer Nombre:</label>
                          <input  type="text" class="form-control" id="empl_primer_nombre" name="empl_primer_nombre" value=""  placeholder="Primer Nombre" required/>
                          <input type="hidden" name="empl_id" id="empl_id" value="0" />
                          <div id="mensaje_primer_nombre" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            	          <label for="empl_segundo_nombre" class="control-label">Segundo Nombre:</label>
                          <input  type="text" class="form-control" id="empl_segundo_nombre" name="empl_segundo_nombre" value=""  placeholder="Segundo Nombre" required/>
                          <div id="mensaje_segundo_nombre" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            	          <label for="empl_primer_apellido" class="control-label">Primer Apellido:</label>
                          <input  type="text" class="form-control" id="empl_primer_apellido" name="empl_primer_apellido" value=""  placeholder="Primer Apellido" required/>
                           <div id="mensaje_primer_apellido" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            	
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            	          <label for="empl_segundo_apellido" class="control-label">Segundo Apellido:</label>
                          <input  type="text" class="form-control" id="empl_segundo_apellido" name="empl_segundo_apellido" value=""  placeholder="Segundo Apellido" required/>
                          <div id="mensaje_segundo_apellido" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            	</div>	
            	
            	 <div class="row">
        		      <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="empl_dni" class="control-label">DNI:</label>
                          <input  type="text" class="form-control" id="empl_dni" name="empl_dni" value=""  placeholder="DNI" required/>
                          <div id="mensaje_dni" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="empl_edad" class="control-label">Edad:</label>
                          <input  type="text" class="form-control" id="empl_edad" name="empl_edad" value=""  placeholder="Edad" required/>
                           <div id="mensaje_edad" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="empl_grupo_sanguineo" class="control-label">Grupo Sanguineo:</label>
                          <input  type="text" class="form-control" id="empl_grupo_sanguineo" name="empl_grupo_sanguineo" value=""  placeholder="Grupo Sanguineo" required/>
                          <div id="mensaje_grupo_sanguineo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		   <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="empl_fecha_ingreso" class="control-label">Fecha Ingreso:</label>
                          <input  type="date" class="form-control" id="empl_fecha_ingreso" name="empl_fecha_ingreso" value=""  placeholder="Fecha Ingreso" required/>
                          <div id="mensaje_fecha_ingreso" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            	</div>	
            	
            	 <div class="row">
        		      <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="empl_lugar_trabajo" class="control-label">Lugar de Trabajo:</label>
                          <input  type="text" class="form-control" id="empl_lugar_trabajo" name="empl_lugar_trabajo" value=""  placeholder="Lugar de Trabajo" required/>
                           <div id="mensaje_lugar_trabajo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="empl_area_trabajo" class="control-label">Area de Trabajo:</label>
                          <input  type="text" class="form-control" id="empl_area_trabajo" name="empl_area_trabajo" value=""  placeholder="Area de Trabajo" required/>
                          <div id="mensaje_area_trabajo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		      <label for="empl_actividades_trabajo" class="control-label">Actividades de Trabajo:</label>
                          <input  type="text" class="form-control" id="empl_actividades_trabajo" name="empl_actividades_trabajo" value=""  placeholder="Actividades de Trabajo" required/>
                          <div id="mensaje_actividades_trabajo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="ide_id" class="control-label">Identidad de Sexo:</label>
                          <select  class="form-control" id="ide_id" name="ide_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_identidad_genero" class="errores"></div>
                        </div>
            		  </div>
            	</div>	
            	
            	 <div class="row">
            	
        		     <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="dis_id" class="control-label">Discapacidad:</label>
                         <select class="form-control" onchange="ToggleDiv(this.value)">
        				 <option value="0">--Seleccione--</option>
        				 <option value="SI">SI</option>
        				 <option value="NO">NO</option>
    					 </select>                        
                          <div id="mensaje_discapacidad" class="errores"></div>
                        </div>
            		  </div>
            	
            		<div class="col-xs-12 col-md-3 col-md-3 " id="nombre_discapacidad">
            		    <div class="form-group">
            		      <label for="dis_nombre" class="control-label">Nombre de Discapacidad:</label>
                          <input  type="text" class="form-control" id="dis_nombre" name="dis_nombre" value=""  placeholder="Nombre de Discapacidad" required/>
                          <div id="mensaje_dis_nombre" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>

				    <div class="col-xs-12 col-md-3 col-md-3 " id="porcentaje_discapacidad">
            		    <div class="form-group">
            		      <label for="dis_porcentaje" class="control-label">Porcentaje de Discapacidad:</label>
                          <input  type="text" class="form-control" id="dis_porcentaje" name="dis_porcentaje" value=""  placeholder="Porcentaje de Discapacidad" required/>
                          <div id="mensaje_dis_porcentaje" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
  
            		  
            		  
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="emp_id" class="control-label">Empresa:</label>
                          <select  class="form-control" id="emp_id" name="emp_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_empresa" class="errores"></div>
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="ori_id" class="control-label">Orientacion Sexual:</label>
                          <select  class="form-control" id="ori_id" name="ori_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_orientacion_sexual" class="errores"></div>
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="rel_id" class="control-label">Religion:</label>
                          <select  class="form-control" id="rel_id" name="rel_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_religion" class="errores"></div>
                        </div>
            		  </div> 
            	
        		     <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		     <label for="sex_id" class="control-label">Sexo:</label>
                          <select  class="form-control" id="sex_id" name="sex_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_sexo" class="errores"></div>
                        </div>
            		  </div>
         			</div>	
            			          		        
           		<div class="row">
    			    <div class="col-xs-12 col-md-4 col-lg-4 " style="text-align: center; ">
        	   		    <div class="form-group">
    	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">GUARDAR</button>
    	                  <a href="<?php echo $helper->url("ffspEmpleados","Index"); ?>" class="btn btn-danger">CANCELAR</a>
	                    </div>
	                
	                  
	                    
        		    </div>        		    
    		    </div>
 
           </form>
                      
          </div>
    	</div>
    </section>
              
     <section class="content">
      	<div class="box box-primary">
      		<div class="box-header with-border">
      			<h3 class="box-title">Listado de Empleados</h3>      			
            </div> 
            <div class="box-body">
    			<div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="buscador" name="buscador" onkeyup="consultaEmpleados(1)" placeholder="Buscar.."/>
    			</div>            	
            	<div id="empleados_registrados" ></div>
            </div> 	
      	</div>
      </section> 
    
  </div>
  
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	

   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
   <script src="view/js/ffspEmpleados.js?0.2"></script> 
       
   
  </body>
</html>   

