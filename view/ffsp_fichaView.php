



<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ficha</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="view/bootstrap/otros/login/images/icons/favicon.ico"/>
    
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
    
     
   <?php include("view/modulos/links_css.php"); ?>
  
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <link href="view/bootstrap/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" type="text/css" /> 
  <link rel="stylesheet" href="view/bootstrap/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    
   
  </head>

  <body class="hold-transition skin-blue fixed sidebar-mini">

 <?php  $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;
        $DateString = (string)$fecha;
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
                <li class="active">Ficha</li>
            </ol>
        </section>
        
        
        
        
        <section class="content">
          <form id="frm_avoco" action="<?php echo $helper->url("Avoco","InsertAvoco"); ?>" method="post" enctype="multipart/form-data"  class="form form-horizontal">
  
  
        <?php if(!empty($resultEdit)){ foreach($resultEdit as $resEdit) {?>
        
        
    
    	<div id="smartwizard">
            <ul>
                <li><a href="#step-1">Datos Empleado<br /><small> </small></a></li>
                <li><a href="#step-2">Revisión Providencia<br /><small></small></a></li>
                <li><a href="#step-3">Revisión Oficio<br /><small></small></a></li>
                <!-- <li><a href="#step-4">Revisión Segundo Oficio<br /><small></small></a></li> -->
            </ul>
         
            <div>
                <div id="step-1" class="">
                
                	<div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    <div class="box-body">
                    
                   
                    	
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
                          <select  class="form-control" id="dis_id" name="dis_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_discapacidad" class="errores"></div>
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
            	</div>	
            	
            	 <div class="row">
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
                  
            	</div>
            </div>
                	
                	
                </div>
                <div id="step-2" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor1" name="editor1" rows="15" cols="80"><?php echo $resEdit->cuerpo_documentos_generados; ?></textarea>
            	                    <div id="mensaje_editor1" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                  <div id="step-3" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor2" name="editor2" rows="15" cols="80"><?php echo $resEdit->oficio_uno_documentos_generados; ?></textarea>
            	                    <div id="mensaje_editor2" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                
                <!-- 
                  <div id="step-4" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor3" name="editor3" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_editor3" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                 -->
                
                
            </div>
        </div>
    		
       
        
        
        
        <?php }}else{?>
        
        
    
    	<div id="smartwizard">
            <ul>
                <li><a href="#step-1">A. Datos Empleado<br /><small> </small></a></li>
                <li><a href="#step-2">B. Motivo Consulta<br /><small></small></a></li>
                <li><a href="#step-3">C. Antecedentes Personales<br /><small></small></a></li>
                <li><a href="#step-4">D. Antecedentes de Trabajo<br /><small></small></a></li> 
            </ul>
         
            <div>
                <div id="step-1" class="">
                
                	<div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Datos del Establecimiento EMPRESA-USUARIO</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    <div class="box-body">
                    
                     <div class="row">
                      <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="emp_id" class="control-label">Empresa:</label>
                          <select  class="form-control" id="emp_id" name="emp_id" disabled>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_empresa" class="errores"></div>
                        </div>
            		  </div>
            		  
            		   <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            	          <label for="emp_ruc" class="control-label">Ruc:</label>
                          <input  type="text" class="form-control" id="emp_ruc" name="emp_ruc" value=""  placeholder="Ruc" readonly />
                          <div id="mensaje_emp_ruc" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		   <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            	          <label for="emp_ciudad" class="control-label">Ciudad:</label>
                          <input  type="text" class="form-control" id="emp_ciudad" name="emp_ciudad" value=""  placeholder="Ciudad" readonly />
                          <div id="mensaje_emp_ciudad" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  
                    </div>
                    
                    
                   <div class="row">
        		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            	          <label for="empl_primer_nombre" class="control-label">Primer Nombre:</label>
                          <input  type="text" class="form-control" id="empl_primer_nombre" name="empl_primer_nombre" value=""  placeholder="Primer Nombre" required/>
                          <input type="hidden" name="empl_id" id="empl_id" value="0" />
                          <input type="hidden" name="fic_id" id="fic_id" value="<?php echo $fic_id;?>" />
                          <div id="mensaje_primer_nombre" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            	          <label for="empl_segundo_nombre" class="control-label">Segundo Nombre:</label>
                          <input  type="text" class="form-control" id="empl_segundo_nombre" name="empl_segundo_nombre" value=""  placeholder="Segundo Nombre" required/>
                          <div id="mensaje_segundo_nombre" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            	          <label for="empl_primer_apellido" class="control-label">Primer Apellido:</label>
                          <input  type="text" class="form-control" id="empl_primer_apellido" name="empl_primer_apellido" value=""  placeholder="Primer Apellido" required/>
                           <div id="mensaje_primer_apellido" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            	
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            	          <label for="empl_segundo_apellido" class="control-label">Segundo Apellido:</label>
                          <input  type="text" class="form-control" id="empl_segundo_apellido" name="empl_segundo_apellido" value=""  placeholder="Segundo Apellido" required/>
                          <div id="mensaje_segundo_apellido" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            	</div>	
            	
            	 <div class="row">
        		      <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="empl_dni" class="control-label">DNI:</label>
                          <input  type="number" class="form-control" id="empl_dni" name="empl_dni" value=""  placeholder="DNI" required readonly/>
                          <div id="mensaje_dni" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		      <label for="empl_edad" class="control-label">Edad:</label>
                          <input  type="number" class="form-control" id="empl_edad" name="empl_edad" value=""  placeholder="Edad" required/>
                           <div id="mensaje_edad" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		      <label for="empl_grupo_sanguineo" class="control-label">Grupo Sanguineo:</label>
                          <input  type="text" class="form-control" id="empl_grupo_sanguineo" name="empl_grupo_sanguineo" value=""  placeholder="Grupo Sanguineo" required/>
                          <div id="mensaje_grupo_sanguineo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		   <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="empl_fecha_ingreso" class="control-label">Fecha Ingreso:</label>
                          <input  type="date" class="form-control" id="empl_fecha_ingreso" name="empl_fecha_ingreso" value=""  placeholder="Fecha Ingreso" required/>
                          <div id="mensaje_fecha_ingreso" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            	</div>	
            	
            	 <div class="row">
        		      <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		      <label for="empl_lugar_trabajo" class="control-label">Lugar de Trabajo:</label>
                          <input  type="text" class="form-control" id="empl_lugar_trabajo" name="empl_lugar_trabajo" value=""  placeholder="Lugar de Trabajo" required/>
                           <div id="mensaje_lugar_trabajo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		      <label for="empl_area_trabajo" class="control-label">Area de Trabajo:</label>
                          <input  type="text" class="form-control" id="empl_area_trabajo" name="empl_area_trabajo" value=""  placeholder="Area de Trabajo" required/>
                          <div id="mensaje_area_trabajo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		      <label for="empl_actividades_trabajo" class="control-label">Actividades de Trabajo:</label>
                          <input  type="text" class="form-control" id="empl_actividades_trabajo" name="empl_actividades_trabajo" value=""  placeholder="Actividades de Trabajo" required/>
                          <div id="mensaje_actividades_trabajo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
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
            		    <div class="form-group-sm">
            		     <label for="dis_id" class="control-label">Discapacidad:</label>
                          <select  class="form-control" id="dis_id" name="dis_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_discapacidad" class="errores"></div>
                        </div>
            		  </div>
            		  
            		   
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="ori_id" class="control-label">Orientacion Sexual:</label>
                          <select  class="form-control" id="ori_id" name="ori_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_orientacion_sexual" class="errores"></div>
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="rel_id" class="control-label">Religion:</label>
                          <select  class="form-control" id="rel_id" name="rel_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_religion" class="errores"></div>
                        </div>
            		  </div> 
            	
            	     <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="sex_id" class="control-label">Sexo:</label>
                          <select  class="form-control" id="sex_id" name="sex_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_sexo" class="errores"></div>
                        </div>
            		  </div>
            	</div>	
                    	
                   
            	</div>
            </div>
                	
                	
                </div>
                <div id="step-2" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">DESCRIPCIÓN: Anotar la causa en la versión del informante.</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="fic_motivo_consulta" name="fic_motivo_consulta" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_fic_motivo_consulta" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                  <div id="step-3" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">DESCRIPCIÓN: Antecedentes Clínicos y Quirúrgicos</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="fic_antecedentes_personales" name="fic_antecedentes_personales" rows="8" cols="30"></textarea>
            	                    <div id="mensaje_fic_antecedentes_personales" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
               		
               		
               		 <div id="mujer" class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Antecedentes Gineco Obstétricios</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_menarquia" class="control-label">Menarquia:</label>
                                                      <select name="fic_ant_menarquia" id="fic_ant_menarquia"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_menarquia" class="errores"></div>
                                </div>
                                </div>
                                
                                 <div class="col-xs-12 col-md-2 col-md-2 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_ciclos" class="control-label">Ciclos:</label>
                                  <input  type="number" class="form-control" id="fic_ant_ciclos" name="fic_ant_ciclos" value=""  placeholder="#"/>
                                  <div id="mensaje_fic_ant_ciclos" class="errores"></div>
                                 </div>
                    		  </div>
                                
                                <div class="col-xs-12 col-md-2 col-md-2 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_fecha_ultima_mestruacion" class="control-label">Fecha Ult. Mestruación:</label>
                                  <input  type="date" class="form-control" id="fic_ant_fecha_ultima_mestruacion" name="fic_ant_fecha_ultima_mestruacion" value="" />
                                  <div id="mensaje_fic_ant_fecha_ultima_mestruacion" class="errores"></div>
                                 </div>
                    		  </div>
                                
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_gestas" class="control-label">Gestas:</label>
                                                      <select name="fic_ant_gestas" id="fic_ant_gestas"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_gestas" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_partos" class="control-label">Partos:</label>
                                                      <select name="fic_ant_partos" id="fic_ant_partos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_partos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_cesareas" class="control-label">Cesareas:</label>
                                                      <select name="fic_ant_cesareas" id="fic_ant_cesareas"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_cesareas" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_abortos" class="control-label">Abortos:</label>
                                                      <select name="fic_ant_abortos" id="fic_ant_abortos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_abortos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_hijos_vivos" class="control-label">Hijos Vivos:</label>
                                                      <select name="fic_ant_hijos_vivos" id="fic_ant_hijos_vivos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_hijos_vivos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_hijos_muertos" class="control-label">Hijos Muertos:</label>
                                                      <select name="fic_ant_hijos_muertos" id="fic_ant_hijos_muertos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_hijos_muertos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_vida_sexual" class="control-label">Vida Sexual Activa:</label>
                                                      <select name="fic_ant_vida_sexual" id="fic_ant_vida_sexual"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_vida_sexual" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_metodo_planificacion_familiar" class="control-label">Método Pla. Familiar:</label>
                                                      <select name="fic_ant_metodo_planificacion_familiar" id="fic_ant_metodo_planificacion_familiar"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_metodo_planificacion_familiar" class="errores"></div>
                                </div>
                                </div>
                                
                                
                                  <div class="col-xs-12 col-md-2 col-md-2 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_tipo_metodo_planificacion_familiar" class="control-label">Tipo Pla. Familiar:</label>
                                  <input  type="text" class="form-control" id="fic_ant_tipo_metodo_planificacion_familiar" name="fic_ant_tipo_metodo_planificacion_familiar" value=""  placeholder="#"/>
                                  <div id="mensaje_fic_ant_tipo_metodo_planificacion_familiar" class="errores"></div>
                                 </div>
                    		  </div>
	        
               			  </div>
               			  
               			  
               			  
               			  <div class="row" style="margin-top:20px;">
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_metodo_planificacion_familiar" class="control-label">Método Pla. Familiar:</label>
                                                      <select name="fic_ant_metodo_planificacion_familiar" id="fic_ant_metodo_planificacion_familiar"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_metodo_planificacion_familiar" class="errores"></div>
                                </div>
                                </div>
                                <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_metodo_planificacion_familiar" class="control-label">Método Pla. Familiar:</label>
                                                      <select name="fic_ant_metodo_planificacion_familiar" id="fic_ant_metodo_planificacion_familiar"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_metodo_planificacion_familiar" class="errores"></div>
                                </div>
                                </div>
                                <div class="col-lg-4 col-xs-12 col-md-4">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_metodo_planificacion_familiar" class="control-label">Método Pla. Familiar:</label>
                                                      <select name="fic_ant_metodo_planificacion_familiar" id="fic_ant_metodo_planificacion_familiar"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="Si">Si</option>
                        							  <option value="No">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_metodo_planificacion_familiar" class="errores"></div>
                                </div>
                                </div>
               			  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  </div>
               			  </div>
               			  
               			  
               			  
               			  
               			</div>
               		</div>
               		
               		 <div id="hombre" class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Antecedentes Reproductivos Masculinos</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	
	        
               			  </div>
               			</div>
               		</div>
               		
               		
                </div>
                
                
                <div id="step-4" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="aa" name="aa" rows="15" cols="80"></textarea>
            	                    <div id="aa" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                <!-- 
                  <div id="step-4" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title"></h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="editor3" name="editor3" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_editor3" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
                </div>
                
                 -->
                
                
            </div>
        </div>
    		
   
    
    
    
    <?php } ?>
    
      </form>
   
    
    </section>
    
        
     
  </div>
 	<?php include("view/modulos/footer.php"); ?>	
   <div class="control-sidebar-bg"></div>
 </div>
   <?php include("view/modulos/links_js.php"); ?> 
   
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="view/bootstrap/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="view/bootstrap/bower_components/jquery-ui-1.12.1/jquery-ui.js"></script> 
    <script src="view/bootstrap/otros/notificaciones/notify.js"></script>
	<script type="text/javascript" src="view/bootstrap/smartwizard/dist/js/jquery.smartWizard.min.js"></script>
	<script type="text/javascript" src="view/js/ffspFicha.js?0.10"></script>
	<script type="text/javascript" src="view/js/ffspwizardFicha.js?0.13"></script>
    <script src="view/bootstrap/bower_components/ckeditor/ckeditor.js?0.2"></script>
    <script src="view/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  
  
  
  
  </body>
</html>

 