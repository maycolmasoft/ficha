



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
          <form id="frm_ficha" method="post" enctype="multipart/form-data"  class="form form-horizontal">
  
  
        <?php if(!empty($resultEdit)){ foreach($resultEdit as $resEdit) {?>
        
         
        <?php }}else{?>
        
        
    
    	<div id="smartwizard">
            <ul>
                <li><a href="#step-1">A. Datos Empleado<br /><small> </small></a></li>
                <li><a href="#step-2">B. Motivo Consulta<br /><small></small></a></li>
                <li><a href="#step-3">C. Antecedentes Personales<br /><small></small></a></li>
                <li><a href="#step-4">D. Antecedentes de Trabajo<br /><small></small></a></li> 
                <li><a href="#step-5">E. Antecedentes Familiares<br /><small></small></a></li> 
            	<li><a href="#step-6">F. Factores de Riesgo<br /><small></small></a></li>
             	<li><a href="#step-7">G. Actividades Extra Laborales<br /><small></small></a></li> 
              	<li><a href="#step-8">H. Enfermedad Actual<br /><small></small></a></li>  
               	<li><a href="#step-9">I. Revisión Organos<br /><small></small></a></li>
                <li><a href="#step-10">J. Constantes Vitales<br /><small></small></a></li>  
                <li><a href="#step-11">K. Examen Fisico Regional<br /><small></small></a></li>  
                <li><a href="#step-12">L. Resultado de Examenes<br /><small></small></a></li>
                <li><a href="#step-13">M. Diagnostico<br /><small></small></a></li>  
           		<li><a href="#step-14">N. Aptitud Médica<br /><small></small></a></li>  
           		<li><a href="#step-15">O. Recomendaciones y/o Tratamiento<br /><small></small></a></li>  

           
           
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
            		     <label for="dis_tiene" class="control-label">Discapacidad:</label>
                         <select class="form-control" id="dis_tiene" onchange="ToggleDiv(this.value)">
        				 <option value="0">--Seleccione--</option>
        				 <option value="SI">SI</option>
        				 <option value="NO">NO</option>
    					 </select>                        
                          <div id="mensaje_discapacidad" class="errores"></div>
                        </div>
            		  </div>
            	
            		<div class="col-xs-12 col-md-3 col-md-3 " id="nombre_discapacidad">
            		    <div class="form-group-sm">
            		      <label for="dis_nombre" class="control-label">Nombre de Discapacidad:</label>
                          <input  type="text" class="form-control" id="dis_nombre" name="dis_nombre" value=""  placeholder="Nombre de Discapacidad" />
                          <div id="mensaje_dis_nombre" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>

				    <div class="col-xs-12 col-md-3 col-md-3 " id="porcentaje_discapacidad">
            		    <div class="form-group-sm">
            		      <label for="dis_porcentaje" class="control-label">Porcentaje de Discapacidad:</label>
                          <input  type="number" class="form-control" id="dis_porcentaje" name="dis_porcentaje" value=""  placeholder="Porcentaje de Discapacidad" />
                          <div id="mensaje_dis_porcentaje" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
            		   
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="ori_id" class="control-label">Orientacion Sexual:</label>
                          <select  class="form-control" id="ori_id" name="ori_id">
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_orientacion_sexual" class="errores"></div>
                        </div>
            		  </div>
            		  
            		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="rel_id" class="control-label">Religion:</label>
                          <select  class="form-control" id="rel_id" name="rel_id">
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_religion" class="errores"></div>
                        </div>
            		  </div> 
            	
            	     <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group-sm">
            		     <label for="sex_id" class="control-label">Sexo:</label>
                          <select  class="form-control" id="sex_id" name="sex_id">
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
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
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
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_gestas" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_partos" class="control-label">Partos:</label>
                                                      <select name="fic_ant_partos" id="fic_ant_partos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_partos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_cesareas" class="control-label">Cesareas:</label>
                                                      <select name="fic_ant_cesareas" id="fic_ant_cesareas"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_cesareas" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_abortos" class="control-label">Abortos:</label>
                                                      <select name="fic_ant_abortos" id="fic_ant_abortos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_abortos" class="errores"></div>
                                </div>
                                </div>
                                
                               
            
               			  </div>
               			  
               			  
               			</div>
               		</div>
               		
               		
               		 <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Planificación Familiar</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	    <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_hijos_vivos" class="control-label">Hijos Vivos:</label>
                                                      <select name="fic_ant_hijos_vivos" id="fic_ant_hijos_vivos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_hijos_vivos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_hijos_muertos" class="control-label">Hijos Muertos:</label>
                                                      <select name="fic_ant_hijos_muertos" id="fic_ant_hijos_muertos"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_hijos_muertos" class="errores"></div>
                                </div>
                                </div>
                                
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_vida_sexual" class="control-label">Vida Sexual Activa:</label>
                                                      <select name="fic_ant_vida_sexual" id="fic_ant_vida_sexual"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_vida_sexual" class="errores"></div>
                                </div>
                                </div>
                                  
                                                      
                                <div class="col-lg-2 col-xs-12 col-md-2">
                    		    <div class="form-group-sm">
                                                      <label for="fic_ant_metodo_planificacion_familiar" class="control-label">Método Pla. Familiar:</label>
                                                      <select name="fic_ant_metodo_planificacion_familiar" id="fic_ant_metodo_planificacion_familiar"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_metodo_planificacion_familiar" class="errores"></div>
                                </div>
                                </div>
                                
                                
                                  <div class="col-xs-12 col-md-4 col-md-4 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_tipo_metodo_planificacion_familiar" class="control-label">Tipo Pla. Familiar:</label>
                                  <input  type="text" class="form-control" id="fic_ant_tipo_metodo_planificacion_familiar" name="fic_ant_tipo_metodo_planificacion_familiar" value=""  placeholder="#"/>
                                  <div id="mensaje_fic_ant_tipo_metodo_planificacion_familiar" class="errores"></div>
                                 </div>
                    		  </div>
	         			     			
               			
	        
               			  </div>
               			  
               			  
               			  
               			  <div class="row" style="margin-top:40px;">
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Exámenes Realizados</div>
                              <div class="panel-body">
               			   
               			   
               			   
               			   <div class="col-xs-12 col-md-6 col-md-6 ">
            		    	<div class="form-group-sm">
            		     	<label for="ante_id" class="control-label">Exámenes:</label>
                          	<select  class="form-control" id="ante_id" name="ante_id">
                          	<option value="0">--Seleccione--</option>
                          	 <option value="TRUE">Si</option>
                          	</select>                         
                          	<div id="mensaje_ante_id" class="errores"></div>
                        	</div>
            		  	   </div>
            		  
            		        <div class="col-lg-6 col-xs-12 col-md-6">
                    		<div class="form-group-sm">
                                                      <label for="fic_ant_det_realizado" class="control-label">Se Realizo Exámen:</label>
                                                      <select name="fic_ant_det_realizado" id="fic_ant_det_realizado"  class="form-control" >
                                                      <option value="0" selected="selected">--Seleccione--</option>
                        							  <option value="TRUE">Si</option>
                        							  <option value="FALSE">No</option>
                        							  </select> 
                                                      <div id="mensaje_fic_ant_det_realizado" class="errores"></div>
                            </div>
                            </div>
            		  
            		        <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_det_tiempo" class="control-label">Tiempo:</label>
                                  <input  type="number" class="form-control" id="fic_ant_det_tiempo" name="fic_ant_det_tiempo" value=""  placeholder="# años"/>
                                  <div id="mensaje_fic_ant_det_tiempo" class="errores"></div>
                                 </div>
                    		  </div>
            		  
            		        <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_det_resultado" class="control-label">Resultado:</label>
                                  <input  type="text" class="form-control" id="fic_ant_det_resultado" name="fic_ant_det_resultado" value=""  placeholder="resultado.."/>
                                  <div id="mensaje_fic_ant_det_resultado" class="errores"></div>
                                 </div>
                    		  </div>
                    		  
                    		  
                    		  
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                                      <button type="button" onclick="AgregarC()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                				
                                </div>
                    		    </div>
                    		    
                    		    </div>
                    		  
                    		  <br>
                    		  
                    		  </div>
                    		  </div>
                    		  
               			  </div>
               			  
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Exámenes Realizados</div>
                              <div class="panel-body">
               			      <div id="load_antecedentes_sexo_registrados" ></div>
               			      <div id="antecedentes_sexo_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
               		
               		
               
               <!-- DESDE AQUI STEVEN -->		
               		
              <form id="frm_ficha_habitos_toxicos">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Hábitos Tóxicos</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Hábitos Tóxicos</div>
                              <div class="panel-body">
               			   
                      	      <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="hab_id" class="control-label">Habitos Toxicos:</label>
                                  <select  class="form-control" id="hab_id" name="hab_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_hab_id" class="errores"></div>
                                </div>
                    		  </div>
            		
            		        <div class="col-lg-6 col-xs-12 col-md-6">
                    		<div class="form-group-sm">
                              <label for="fic_hab_tox_consume" class="control-label">Consume Habitos Toxicos:</label>
                              <select name="fic_hab_tox_consume" id="fic_hab_tox_consume"  class="form-control" >
                              <option value="0" selected="selected">--Seleccione--</option>
							  <option value="TRUE">Si</option>
							  <option value="FALSE">No</option>
							  </select> 
                              <div id="mensaje_fic_hab_tox_consume" class="errores"></div>
        					</div>
                            </div>
            		  
            		        <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_hab_tox_tiempo" class="control-label">Tiempo:</label>
                                  <input  type="number" class="form-control" id="fic_hab_tox_tiempo" name="fic_hab_tox_tiempo" value=""  placeholder="# años"/>
                                  <div id="mensaje_fic_hab_tox_tiempo" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_hab_tox_cantidad" class="control-label">Cantidad:</label>
                                  <input  type="number" class="form-control" id="fic_hab_tox_cantidad" name="fic_hab_tox_cantidad" value=""  placeholder="# cantidad"/>
                                  <div id="mensaje_fic_hab_tox_cantidad" class="errores"></div>
                                 </div>
                    		  </div>
            		        <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_hab_tox_ex_consumidor" class="control-label">Ex Consumidor:</label>
                                  <input  type="text" class="form-control" id="fic_hab_tox_ex_consumidor" name="fic_hab_tox_ex_consumidor" value=""  placeholder="......."/>
                                  <div id="mensaje_fic_hab_tox_ex_consumidor" class="errores"></div>
                                 </div>
                    		  </div>
                    		  <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_hab_tox_tiempo_abstinencia" class="control-label">Tiempo Abstinencia:</label>
                                  <input  type="number" class="form-control" id="fic_hab_tox_tiempo_abstinencia" name="fic_hab_tox_tiempo_abstinencia" value=""  placeholder="# años"/>
                                  <div id="mensaje_fic_hab_tox_tiempo_abstinencia" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarHabitosToxicos()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Hábitos Tóxicos Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaHabitosToxicos" ></div>
               			      <div id="ficha_habitos_toxicos_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
               		</form>
               		
               	   <form id="frm_ficha_estilo_vida">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Estilo Vida</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Estilo de Vida</div>
                              <div class="panel-body">
               			   
                      	      <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="est_vid_id" class="control-label">Estilo Vida:</label>
                                  <select  class="form-control" id="est_vid_id" name="est_vid_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_est_vid_id" class="errores"></div>
                                </div>
                    		  </div>
            		
            		        <div class="col-lg-6 col-xs-12 col-md-6">
                    		<div class="form-group-sm">
                              <label for="fic_est_vid_practica" class="control-label">Vida Practica:</label>
                              <select name="fic_est_vid_practica" id="fic_est_vid_practica"  class="form-control" >
                              <option value="0" selected="selected">--Seleccione--</option>
							  <option value="TRUE">Si</option>
							  <option value="FALSE">No</option>
							  </select> 
                              <div id="mensaje_fic_est_vid_practica" class="errores"></div>
        					</div>
                            </div>
            		  
            		        <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_est_vid_cual" class="control-label">Cual:</label>
                                  <input  type="text" class="form-control" id="fic_est_vid_cual" name="fic_est_vid_cual" value=""  placeholder=""/>
                                  <div id="mensaje_fic_est_vid_cual" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_est_vid_tiempo_cantidad" class="control-label">Tiempo:</label>
                                  <input  type="number" class="form-control" id="fic_est_vid_tiempo_cantidad" name="fic_est_vid_tiempo_cantidad" value=""  placeholder=""/>
                                  <div id="mensaje_fic_est_vid_tiempo_cantidad" class="errores"></div>
                                 </div>
                    		  </div>
            		       
                    		 
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarEstiloVida()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Estilo Vida Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaEstiloVida" ></div>
               			      <div id="ficha_estilo_vida_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
               		</form>	
               		
               		<!-- TERMINA AQUI STEVEN -->	
               		
               		
               		 
               		
               		
                </div>
                
                
                <div id="step-4" class="">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Empleos Anteriores</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Empleos Anteriores</div>
                              <div class="panel-body">
               			    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_emp_ant_empresa" class="control-label">Empresa:</label>
                                  <input  type="text" class="form-control" id="fic_emp_ant_empresa" name="fic_emp_ant_empresa" value=""  placeholder="empresa.."/>
                                  <div id="mensaje_fic_emp_ant_empresa" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_emp_ant_puesto_trabajo" class="control-label">Puesto:</label>
                                  <input  type="text" class="form-control" id="fic_emp_ant_puesto_trabajo" name="fic_emp_ant_puesto_trabajo" value=""  placeholder="puesto.."/>
                                  <div id="mensaje_fic_emp_ant_puesto_trabajo" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_emp_ant_actividades_desempenia" class="control-label">Actividades:</label>
                                  <input  type="text" class="form-control" id="fic_emp_ant_actividades_desempenia" name="fic_emp_ant_actividades_desempenia" value=""  placeholder="actividades.."/>
                                  <div id="mensaje_fic_emp_ant_actividades_desempenia" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_emp_ant_tiempo_trabajo" class="control-label">Tiempo:</label>
                                  <input  type="number" class="form-control" id="fic_emp_ant_tiempo_trabajo" name="fic_emp_ant_tiempo_trabajo" value=""  placeholder="tiempo.."/>
                                  <div id="mensaje_fic_emp_ant_tiempo_trabajo" class="errores"></div>
                                 </div>
                    		  </div>
               			      <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="fac_id" class="control-label">Factores Riesgo:</label>
                                  <select  class="form-control" id="fac_id" name="fac_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_fac_id" class="errores"></div>
                                </div>
                    		  </div>
            				<div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_emp_ant_observaciones" class="control-label">Observaciones:</label>
                                  <input  type="text" class="form-control" id="fic_emp_ant_observaciones" name="fic_emp_ant_observaciones" value=""  placeholder="observaciones.."/>
                                  <div id="mensaje_fic_emp_ant_observaciones" class="errores"></div>
                                 </div>
                    		  </div>
            				 
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarEmpleoAnterior()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Empleos Anteriores Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaEmpleoAnterior" ></div>
               			      <div id="ficha_empleo_anterior_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
               		 <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Accidentes de Trabajo</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Accidentes de Trabajo</div>
                              <div class="panel-body">
               			    <div class="col-lg-6 col-xs-12 col-md-6">
                    		<div class="form-group-sm">
                              <label for="fic_acc_tra_fue_calificado" class="control-label">Fue Calificado:</label>
                              <select name="fic_acc_tra_fue_calificado" id="fic_acc_tra_fue_calificado"  class="form-control" >
                              <option value="0" selected="selected">--Seleccione--</option>
							  <option value="TRUE">Si</option>
							  <option value="FALSE">No</option>
							  </select> 
                              <div id="mensaje_fic_acc_tra_fue_calificado" class="errores"></div>
        					</div>
                            </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_acc_tra_especificar" class="control-label">Especificar:</label>
                                  <input  type="text" class="form-control" id="fic_acc_tra_especificar" name="fic_acc_tra_especificar" value=""  placeholder="especificar.."/>
                                  <div id="mensaje_fic_acc_tra_especificar" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_acc_tra_fecha" class="control-label">Fecha:</label>
                                  <input  type="date" class="form-control" id="fic_acc_tra_fecha" name="fic_acc_tra_fecha" value=""  placeholder="fecha.."/>
                                  <div id="mensaje_fic_acc_tra_fecha" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_acc_tra_observaciones" class="control-label">Observaciones:</label>
                                  <input  type="text" class="form-control" id="fic_acc_tra_observaciones" name="fic_acc_tra_observaciones" value=""  placeholder="observaciones.."/>
                                  <div id="mensaje_fic_acc_tra_observaciones" class="errores"></div>
                                 </div>
                    		  </div>
               			
               				   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarAccidenteTrabajo()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Accidentes de Trabajo Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaAccidenteTrabajo" ></div>
               			      <div id="ficha_accidente_trabajo_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
               		 <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Enfermedades Profesionales</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Enfermedades Profesionales</div>
                              <div class="panel-body">
               			    <div class="col-lg-6 col-xs-12 col-md-6">
                    		<div class="form-group-sm">
                              <label for="fic_enf_pro_fue_calificado" class="control-label">Fue Calificado:</label>
                              <select name="fic_enf_pro_fue_calificado" id="fic_enf_pro_fue_calificado"  class="form-control" >
                              <option value="0" selected="selected">--Seleccione--</option>
							  <option value="TRUE">Si</option>
							  <option value="FALSE">No</option>
							  </select> 
                              <div id="mensaje_fic_enf_pro_fue_calificado" class="errores"></div>
        					</div>
                            </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_enf_pro_especificar" class="control-label">Especificar:</label>
                                  <input  type="text" class="form-control" id="fic_enf_pro_especificar" name="fic_enf_pro_especificar" value=""  placeholder="especificar.."/>
                                  <div id="mensaje_fic_enf_pro_especificar" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_enf_pro_fecha" class="control-label">Fecha:</label>
                                  <input  type="date" class="form-control" id="fic_enf_pro_fecha" name="fic_enf_pro_fecha" value=""  placeholder="fecha.."/>
                                  <div id="mensaje_fic_enf_pro_fecha" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_enf_pro_observaciones" class="control-label">Observaciones:</label>
                                  <input  type="text" class="form-control" id="fic_enf_pro_observaciones" name="fic_enf_pro_observaciones" value=""  placeholder="observaciones.."/>
                                  <div id="mensaje_fic_enf_pro_observaciones" class="errores"></div>
                                 </div>
                    		  </div>
               			
               				   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarEnfermedadProfesional()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Enfermedades Profesionales Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaEnfermedadProfesional" ></div>
               			      <div id="ficha_enfermedad_profesional_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
                 </div>
           
           
           
           
           
           
               <div id="step-5" class="">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Antecedentes Familiares</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Antecedentes Familiares</div>
                              <div class="panel-body">
               			   
                      	      <div class="col-xs-12 col-md-12 col-md-12 ">
                    		    <div class="form-group-sm">
                    		     <label for="ant_id" class="control-label">Antecedentes:</label>
                                  <select  class="form-control" id="ant_id" name="ant_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_ant_id" class="errores"></div>
                                </div>
                    		  </div>
            		
            		       
            		  
            		        <div class="col-xs-12 col-md-12 col-md-12 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_ant_fam_descripcion" class="control-label">Descripción:</label>
                                  <input  type="text" class="form-control" id="fic_ant_fam_descripcion" name="fic_ant_fam_descripcion" value=""  placeholder="descripción.."/>
                                  <div id="mensaje_fic_ant_fam_descripcion" class="errores"></div>
                                 </div>
                    		  </div>
                    		 
            		       
                    		 
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarAntecedentesFamiliares()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Antecedentes Familiares Registrados</div>
                              <div class="panel-body">
               			      <div id="loadfichaAntecedentesFamiliares" ></div>
               			      <div id="ficha_antecedentes_familiares_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
                 </div>
           
           
           <div id="step-6" class="">
    	   <div class="box box-primary">
       
    	<section class="content">
            
            <div class="box-body">

           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#cabeza" data-toggle="tab">Puestos de Trabajo</a></li>
              <li><a href="#detalle" data-toggle="tab">Factores de Riesgo - Puestos de Trabajo</a></li> 
             
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
 			 <div class="tab-pane active" id="cabeza">
                        <div class="box-header with-border">
                          <h3 class="box-title">Factores Riesgo</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Factores Riesgo</div>
                              <div class="panel-body">
               			    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_fact_ries_puesto_trabajo" class="control-label">Puesto:</label>
                                  <input  type="text" class="form-control" id="fic_fact_ries_puesto_trabajo" name="fic_fact_ries_puesto_trabajo" value=""  placeholder="puesto.."/>
                                  <div id="mensaje_fic_fact_ries_puesto_trabajo" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_fact_ries_actividades" class="control-label">Actividades:</label>
                                  <input  type="text" class="form-control" id="fic_fact_ries_actividades" name="fic_fact_ries_actividades" value=""  placeholder="actividades.."/>
                                  <div id="mensaje_fic_fact_ries_actividades" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_fact_ries_medidas_preventivas" class="control-label">Medidas Preventivas:</label>
                                  <input  type="text" class="form-control" id="fic_fact_ries_medidas_preventivas" name="fic_fact_ries_medidas_preventivas" value=""  placeholder="medidas preventivas.."/>
                                  <div id="mensaje_fic_fact_ries_medidas_preventivas" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarFactorRiesgo()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Factor Riesgo Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaFactorRiesgo" ></div>
               			      <div id="ficha_factor_riesgo_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
                
              </div>
              
              <div class="tab-pane" id="detalle">
                
                        <div class="box-header with-border">
                          <h3 class="box-title">Factores Riesgo Detalle</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Factores Riesgo Detalle</div>
                              <div class="panel-body">
                              
                                <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for=fic_fact_ries_id class="control-label">Factores Riesgo Ficha:</label>
                                  <select  class="form-control" id="fic_fact_ries_id" name="fic_fact_ries_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_fic_fact_ries_id" class="errores"></div>
                                </div>
                    		  </div>
                    		  
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="fac_id_detalle" class="control-label">Factores Riesgo Cabeza:</label>
                                  <select  class="form-control" id="fac_id_detalle" name="fac_id_detalle" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_fac_id_detalle" class="errores"></div>
                                </div>
                    		  </div>
                    		  
               			 	   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="fact_id" class="control-label">Factores Riesgo Detalle:</label>
                                  <select  class="form-control" id="fact_id" name="fact_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_fact_id" class="errores"></div>
                                </div>
                    		  </div>
                    		 
                    		     <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_fact_ries_det_otros" class="control-label">Otros:</label>
                                  <input  type="text" class="form-control" id="fic_fact_ries_det_otros" name="fic_fact_ries_det_otros" value=""  placeholder="otros.."/>
                                  <div id="mensaje_fic_fact_ries_det_otros" class="errores"></div>
                                 </div>
                    		  </div>
                    		  
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarFactorRiesgoDetalle()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Factor Riesgo Detalle Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaFactorRiesgoDetalle" ></div>
               			      <div id="ficha_factor_riesgo_detalle_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               	
              </div>
					
              </div>
              
      
              
             </div>
            </div>
           </div>
         
            </div>
            </section>
          </div>
            
           </div>
           
           <div id="step-7" class="">
             <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">DESCRIPCIÓN: Actividades Extra Laborales.</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="fic_actividades_extra_laborales" name="fic_actividades_extra_laborales" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_fic_actividades_extra_laborales" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
           </div>
           
           
           <div id="step-8" class="">
                 <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">DESCRIPCIÓN: Enfermedad Actual.</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="fic_enfermedad_actual" name="fic_enfermedad_actual" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_fic_enfermedad_actual" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
           </div>
        
           <div id="step-9" class="">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Revisión Organos</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Revisión Organos</div>
                              <div class="panel-body">
               			   
                      	      <div class="col-xs-12 col-md-12 col-md-12 ">
                    		    <div class="form-group-sm">
                    		     <label for="org_id" class="control-label">Organos:</label>
                                  <select  class="form-control" id="org_id" name="org_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_org_id" class="errores"></div>
                                </div>
                    		  </div>
            		
            		       
            		  
            		        <div class="col-xs-12 col-md-12 col-md-12 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_rev_org_descripcion" class="control-label">Descripción:</label>
                                  <input  type="text" class="form-control" id="fic_rev_org_descripcion" name="fic_rev_org_descripcion" value=""  placeholder="descripción.."/>
                                  <div id="mensaje_fic_rev_org_descripcion" class="errores"></div>
                                 </div>
                    		  </div>
                    		 
            		       
                    		 
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarRevisionOrganos()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Revisión Organos Registrados</div>
                              <div class="panel-body">
               			      <div id="loadfichaRevisionOrganos" ></div>
               			      <div id="ficha_revision_organos_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
                 </div>
                 
                     <div id="step-10" class="">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Constantes Vitales y Antropometría</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Constantes Vitales</div>
                              <div class="panel-body">
               			   
               			      <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_presion_arterial" class="control-label">Presión Arterial:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_presion_arterial" name="fic_cons_vit_presion_arterial" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_presion_arterial" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_temperatura" class="control-label">Temperatura:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_temperatura" name="fic_cons_vit_temperatura" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_temperatura" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_frecuencia_cardiaca" class="control-label">Frecuencia Cardiaca:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_frecuencia_cardiaca" name="fic_cons_vit_frecuencia_cardiaca" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_frecuencia_cardiaca" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_saturacion_oxigeno" class="control-label">Saturación de Oxigeno:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_saturacion_oxigeno" name="fic_cons_vit_saturacion_oxigeno" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_saturacion_oxigeno" class="errores"></div>
                                 </div>
                    		  </div>
            		            <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_frecuencia_respiratoria" class="control-label">Frecuencia Respiratoria:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_frecuencia_respiratoria" name="fic_cons_vit_frecuencia_respiratoria" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_frecuencia_respiratoria" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_peso" class="control-label">Peso:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_peso" name="fic_cons_vit_peso" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_peso" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_talla" class="control-label">Talla:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_talla" name="fic_cons_vit_talla" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_talla" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_indice_masa_corporal" class="control-label">Indice de Masa Corporal:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_indice_masa_corporal" name="fic_cons_vit_indice_masa_corporal" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_indice_masa_corporal" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_perimetro_abdominal" class="control-label">Perimetro Abdominal:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_perimetro_abdominal" name="fic_cons_vit_perimetro_abdominal" value=""  placeholder=""/>
                                  <div id="mensaje_fic_cons_vit_perimetro_abdominal" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarConstanteVital()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Constantes Vitales Registrados</div>
                              <div class="panel-body">
               			      <div id="loadfichaConstanteVital" ></div>
               			      <div id="ficha_constante_vital_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
                 </div> 
          
          
          
			<div id="step-11" class="">
                <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Exámen Físico Regional</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Exámen Físico Regional</div>
                              <div class="panel-body">
               			   
                      	      <div class="col-xs-12 col-md-12 col-md-12 ">
                    		    <div class="form-group-sm">
                    		     <label for="exam_id" class="control-label">Región:</label>
                                  <select  class="form-control" id="exam_id" name="exam_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_exam_id" class="errores"></div>
                                </div>
                    		  </div>
            		
            		       
            		  
            		        <div class="col-xs-12 col-md-12 col-md-12 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_exa_fis_reg_observacion" class="control-label">Descripción:</label>
                                  <input  type="text" class="form-control" id="fic_exa_fis_reg_observacion" name="fic_exa_fis_reg_observacion" value=""  placeholder=""/>
                                  <div id="mensaje_fic_exa_fis_reg_observacion" class="errores"></div>
                                 </div>
                    		  </div>
                    		 
            		       
                    		 
                    		   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarExamenRegional()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Exámen Físico Regional Registrados</div>
                              <div class="panel-body">
               			      <div id="loadfichaExamenFisicoRegional" ></div>
               			      <div id="ficha_examen_fisico_regional_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
                 </div>
          
          
          
          
           <div id="step-12" class="">
                   <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Resultado de Examenes Generales y Especificos</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Resultado de Examenes</div>
                              <div class="panel-body">
               			   
               			      <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_res_exa_examen" class="control-label">Examen:</label>
                                  <input  type="text" class="form-control" id="fic_res_exa_examen" name="fic_res_exa_examen" value=""  placeholder=""/>
                                  <div id="mensaje_fic_res_exa_examen" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_res_exa_fecha" class="control-label">Fecha:</label>
                                  <input  type="date" class="form-control" id="fic_res_exa_fecha" name="fic_res_exa_fecha" value=""  placeholder=""/>
                                  <div id="mensaje_fic_res_exa_fecha" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_res_exa_resultados" class="control-label">Resultados:</label>
                                  <input  type="text" class="form-control" id="fic_res_exa_resultados" name="fic_res_exa_resultados" value=""  placeholder=""/>
                                  <div id="mensaje_fic_res_exa_resultados" class="errores"></div>
                                 </div>
                    		  </div>
                    			   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarResultadoExamen()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Resultados Registrados</div>
                              <div class="panel-body">
               			      <div id="loadfichaResultadoExamen" ></div>
               			      <div id="ficha_resultado_examen_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
           </div>
           <div id="step-13" class="">
             <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Diagnostico</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Diagnostico</div>
                              <div class="panel-body">
               			    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_diag_descripcion" class="control-label">Descripcion:</label>
                                  <input  type="text" class="form-control" id="fic_diag_descripcion" name="fic_diag_descripcion" value=""  placeholder=""/>
                                  <div id="mensaje_fic_diag_descripcion" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_diag_cie" class="control-label">Cie:</label>
                                  <input  type="text" class="form-control" id="fic_diag_cie" name="fic_diag_cie" value=""  placeholder=""/>
                                  <div id="mensaje_fic_diag_cie" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="tip_diag_id" class="control-label">Tipo de Diagnostico:</label>
                                  <select  class="form-control" id="tip_diag_id" name="tip_diag_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_tip_diag_id" class="errores"></div>
                                </div>
                    		  </div>
            				   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarDiagnostico()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Diagnosticos Registrados</div>
                              <div class="panel-body">
               			      <div id="consultafichaDiagnostico" ></div>
               			      <div id="ficha_diagnostico_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
           </div>
           <div id="step-14" class="">
                        <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Aptitud Médica</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row" >
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			   
               			   
               			   <div class="panel panel-info">
                              <div class="panel-heading">Registrar Aptitud</div>
                              <div class="panel-body">
                                 <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		     <label for="apt_med_id" class="control-label">Aptitud:</label>
                                  <select  class="form-control" id="apt_med_id" name="apt_med_id" >
                                  	<option value="0">--Seleccione--</option>
                                  </select>                         
                                  <div id="mensaje_apt_med_id" class="errores"></div>
                                </div>
                    		  </div>
               			    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_apt_med_observacion" class="control-label">Observación:</label>
                                  <input  type="text" class="form-control" id="fic_apt_med_observacion" name="fic_apt_med_observacion" value=""  placeholder=""/>
                                  <div id="mensaje_fic_apt_med_observacion" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_apt_med_limitacion" class="control-label">Limitación:</label>
                                  <input  type="text" class="form-control" id="fic_apt_med_limitacion" name="fic_apt_med_limitacion" value=""  placeholder=""/>
                                  <div id="mensaje_fic_apt_med_limitacion" class="errores"></div>
                                 </div>
                    		  </div>
                    		 
            				   <div class="row">
                    		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:30px">
                    		    <div class="form-group-sm">
                                  <button type="button" onclick="AgregarAptitud()" class="btn btn-warning"><i class="glyphicon glyphicon-plus"> Agregar</i></button>
                                </div>
                    		    </div>
                    		    </div>
                    		  <br>
                    		  </div>
                    		  </div>
                    	  </div>
               			  <div class="col-lg-6 col-md-6 col-xs-12">
               			  
               			     <div class="panel panel-info">
                              <div class="panel-heading">Aptitudes Registradas</div>
                              <div class="panel-body">
               			      <div id="consultafichaAptitud" ></div>
               			      <div id="ficha_aptitud_registrados" ></div>
               			   
               			   
               			   </div>
               			   </div>
               			  </div>
               			  
               			  
               			  
               			  
               			  </div>
               			  
               			  
               			</div>
               		</div>
           </div>
           <div id="step-15" class="">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">DESCRIPCIÓN: Recomendaciones y/o Tratamiento.</h3>
                          <div class="box-tools pull-right"> </div>
                        </div>
                    
                    	<div class="box-body">
                          <div class="row">
            	
            	        	<div class="col-lg-12 col-md-12 col-xs-12">
            	            <div class="box-body pad">
            	                    <textarea id="fic_recomendacion_tratamiento" name="fic_recomendacion_tratamiento" rows="15" cols="80"></textarea>
            	                    <div id="mensaje_fic_recomendacion_tratamiento" class="errores"></div>
            	            </div>
            	       		</div>
	        
               			  </div>
               			</div>
               		</div>
           </div>
          
           
           
           
           
           
                
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
	<script type="text/javascript" src="view/js/ffspFicha.js?0.31"></script>
	<script type="text/javascript" src="view/js/ffspfichaHabitosToxicos.js?0.6"></script>
	<script type="text/javascript" src="view/js/ffspfichaEstiloVida.js?0.1"></script>
	<script type="text/javascript" src="view/js/ffspfichaEmpleoAnterior.js?0.1"></script>
    <script type="text/javascript" src="view/js/ffspfichaAccidenteTrabajo.js?0.1"></script>
    <script type="text/javascript" src="view/js/ffspfichaEnfermedadProfesional.js?0.4"></script>
    <script type="text/javascript" src="view/js/ffspfichaConstanteVital.js?0.1"></script>
    <script type="text/javascript" src="view/js/ffspfichaResultadoExamen.js?0.1"></script>
    <script type="text/javascript" src="view/js/ffspfichaDiagnostico.js?0.2"></script>
    <script type="text/javascript" src="view/js/ffspfichaAptitud.js?0.3"></script>
    <script type="text/javascript" src="view/js/ffspfichaFactorRiesgo.js?0.4"></script>
    <script type="text/javascript" src="view/js/ffspfichaFactorRiesgoDetalle.js?0.9"></script>
    <script type="text/javascript" src="view/js/ffspfichaAntecedentesFamiliares.js?0.3"></script>
    <script type="text/javascript" src="view/js/ffspfichaRevisionOrganos.js?0.3"></script>
    <script type="text/javascript" src="view/js/ffspfichaExamenFisicoRegional.js?0.3"></script>
	<script type="text/javascript" src="view/js/ffspwizardFicha.js?0.30"></script>
    <script src="view/bootstrap/bower_components/ckeditor/ckeditor.js?0.2"></script>
    <script src="view/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  
  
  
  
  </body>
</html>

 