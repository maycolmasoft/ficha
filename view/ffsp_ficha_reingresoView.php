



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
             	<li><a href="#step-3">C. Enfermedad Actual<br /><small></small></a></li>  
                <li><a href="#step-4">D. Constantes Vitales<br /><small></small></a></li>  
                <li><a href="#step-5">E. Examen Fisico Regional<br /><small></small></a></li>  
                <li><a href="#step-6">F. Resultado de Examenes<br /><small></small></a></li>
                <li><a href="#step-7">G. Diagnostico<br /><small></small></a></li>  
           		<li><a href="#step-8">H. Aptitud Médica<br /><small></small></a></li>  
           		<li><a href="#step-9">I. Recomendaciones y/o Tratamiento<br /><small></small></a></li>  

           
           
           
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
        
         
                     <div id="step-4" class="">
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
                                  <input  type="text" class="form-control" id="fic_cons_vit_presion_arterial" name="fic_cons_vit_presion_arterial" value=""  placeholder="Presión Arterial.."/>
                                  <div id="mensaje_fic_cons_vit_presion_arterial" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_temperatura" class="control-label">Temperatura:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_temperatura" name="fic_cons_vit_temperatura" value=""  placeholder="Temperatura.."/>
                                  <div id="mensaje_fic_cons_vit_temperatura" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_frecuencia_cardiaca" class="control-label">Frecuencia Cardiaca:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_frecuencia_cardiaca" name="fic_cons_vit_frecuencia_cardiaca" value=""  placeholder="Frecuencia Cardiaca.."/>
                                  <div id="mensaje_fic_cons_vit_frecuencia_cardiaca" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_saturacion_oxigeno" class="control-label">Saturación de Oxigeno:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_saturacion_oxigeno" name="fic_cons_vit_saturacion_oxigeno" value=""  placeholder="Saturación de Oxigeno.."/>
                                  <div id="mensaje_fic_cons_vit_saturacion_oxigeno" class="errores"></div>
                                 </div>
                    		  </div>
            		            <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_frecuencia_respiratoria" class="control-label">Frecuencia Respiratoria:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_frecuencia_respiratoria" name="fic_cons_vit_frecuencia_respiratoria" value=""  placeholder="Frecuencia Respiratoria.."/>
                                  <div id="mensaje_fic_cons_vit_frecuencia_respiratoria" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_peso" class="control-label">Peso:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_peso" name="fic_cons_vit_peso" value=""  placeholder="Peso.."/>
                                  <div id="mensaje_fic_cons_vit_peso" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_talla" class="control-label">Talla:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_talla" name="fic_cons_vit_talla" value=""  placeholder="Talla.."/>
                                  <div id="mensaje_fic_cons_vit_talla" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_indice_masa_corporal" class="control-label">Indice de Masa Corporal:</label>
                                  <input  type="text" class="form-control" id="fic_cons_vit_indice_masa_corporal" name="fic_cons_vit_indice_masa_corporal" value=""  placeholder="Indice de Masa Corporal.."/>
                                  <div id="mensaje_fic_cons_vit_indice_masa_corporal" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_cons_vit_perimetro_abdominal" class="control-label">Perimetro Abdominal:</label>
                                  <input  type="number" class="form-control" id="fic_cons_vit_perimetro_abdominal" name="fic_cons_vit_perimetro_abdominal" value=""  placeholder="Perimetro Abdominal.."/>
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
          
          
          
			<div id="step-5" class="">
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
                                  <input  type="text" class="form-control" id="fic_exa_fis_reg_observacion" name="fic_exa_fis_reg_observacion" value=""  placeholder="Descripción.."/>
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
          
          
          
          
           <div id="step-6" class="">
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
                                  <input  type="text" class="form-control" id="fic_res_exa_examen" name="fic_res_exa_examen" value=""  placeholder="Examen.."/>
                                  <div id="mensaje_fic_res_exa_examen" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_res_exa_fecha" class="control-label">Fecha:</label>
                                  <input  type="date" class="form-control" id="fic_res_exa_fecha" name="fic_res_exa_fecha" value=""  placeholder="Fecha.."/>
                                  <div id="mensaje_fic_res_exa_fecha" class="errores"></div>
                                 </div>
                    		  </div>
                    		    <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_res_exa_resultados" class="control-label">Resultados:</label>
                                  <input  type="text" class="form-control" id="fic_res_exa_resultados" name="fic_res_exa_resultados" value=""  placeholder="Resultados.."/>
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
           <div id="step-7" class="">
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
                                  <input  type="text" class="form-control" id="fic_diag_descripcion" name="fic_diag_descripcion" value=""  placeholder="Descripcion.."/>
                                  <div id="mensaje_fic_diag_descripcion" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_diag_cie" class="control-label">Cie:</label>
                                  <input  type="text" class="form-control" id="fic_diag_cie" name="fic_diag_cie" value=""  placeholder="Cie.."/>
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
           <div id="step-8" class="">
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
                                  <input  type="text" class="form-control" id="fic_apt_med_observacion" name="fic_apt_med_observacion" value=""  placeholder="Observación.."/>
                                  <div id="mensaje_fic_apt_med_observacion" class="errores"></div>
                                 </div>
                    		  </div>
                    		   <div class="col-xs-12 col-md-6 col-md-6 ">
                    		    <div class="form-group-sm">
                    		      <label for="fic_apt_med_limitacion" class="control-label">Limitación:</label>
                                  <input  type="text" class="form-control" id="fic_apt_med_limitacion" name="fic_apt_med_limitacion" value=""  placeholder="Limitación.."/>
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
           <div id="step-9" class="">
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
	<script type="text/javascript" src="view/js/reingreso/ffspFicha.js?0.4"></script>
	<script type="text/javascript" src="view/js/reingreso/ffspfichaConstanteVital.js?0.6"></script>
    <script type="text/javascript" src="view/js/reingreso/ffspfichaExamenFisicoRegional.js?0.4"></script>
	<script type="text/javascript" src="view/js/reingreso/ffspfichaResultadoExamen.js?0.6"></script>
    <script type="text/javascript" src="view/js/reingreso/ffspfichaDiagnostico.js?0.3"></script>
    <script type="text/javascript" src="view/js/reingreso/ffspfichaAptitud.js?0.4"></script>
    <script type="text/javascript" src="view/js/reingreso/ffspwizardFicha.js?0.35"></script>
    <script src="view/bootstrap/bower_components/ckeditor/ckeditor.js?0.3"></script>
    <script src="view/bootstrap/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
  
  
  
  
  </body>
</html>

 