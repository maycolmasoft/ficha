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
 	  .loader_detalle {
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
        <li class="active">Factores Riesgo</li>
      </ol>
    </section>   

    <section class="content">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Factores Riesgo</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
                
              </div>
            </div>
            
            <div class="box-body">

           <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#cabeza" data-toggle="tab">Cabeza</a></li>
              <li><a href="#detalle" data-toggle="tab">Detalle</a></li> 
            
            </ul>
            
            <div class="col-md-12 col-lg-12 col-xs-12">
            <div class="tab-content">
            <br>
 			
 			 <div class="tab-pane active" id="cabeza">
   		   <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Factores Riesgo</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            
          </div>
        </div>
        
                  
  		<div class="box-body">
			<form id="frm_factores_riesgo" action="<?php echo $helper->url("ffspFactoresRiesgo","Index"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
           	 <div class="row">
        		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
                          <label for="fac_nombre" class="control-label">Nombre Factores Riesgo:</label>
                          <input  type="text" class="form-control" id="fac_nombre" name="fac_nombre" value=""  placeholder="Nombre Factores Riesgo" required/>
                          <input type="hidden" name="fac_id" id="fac_id" value="0" />
                          <div id="mensaje_nombre_factores_riesgo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                        </div>
            		  </div>
              	</div>	
							          		        
           		<div class="row">
    			    <div class="col-xs-12 col-md-4 col-lg-4 " style="text-align: center; ">
        	   		    <div class="form-group">
    	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">GUARDAR</button>
    	                  <a href="<?php echo $helper->url("FactoresRiesgo","Index"); ?>" class="btn btn-danger">CANCELAR</a>
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
      			<h3 class="box-title">Listado de Factores Riesgo</h3>      			
            </div> 
            <div class="box-body">
    			<div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="buscador" name="buscador" onkeyup="consultaFactoresRiesgo(1)" placeholder="Buscar.."/>
    			</div>            	
            	<div id="factores_riesgo_registrados" ></div>
            </div> 	
      	</div>
      </section> 
    	     </div>
              
              <div class="tab-pane" id="detalle">
	 <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Factores Riesgo Detalle</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            
          </div>
        </div>
        
                  
  		<div class="box-body">
			<form id="frm_factores_riesgo_detalle" action="<?php echo $helper->url("ffspFactoresRiesgoDetalle","Index"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
           	 <div class="row">
        		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
                          <label for="fact_nombre" class="control-label">Nombre Factores Riesgo Detalle:</label>
                          <input  type="text" class="form-control" id="fact_nombre" name="fact_nombre" value=""  placeholder="Nombre Factores Riesgo Detalle" required/>
                          <input type="hidden" name="fact_id" id="fact_id" value="0" />
                          <div id="mensaje_nombre_factores_riesgos_detalle" class="errores"></div>
                          <div id="divLoaderPageDetalle" ></div>                     	
                        </div>
            		  </div>
              		
					 <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
                          <label for="ddl_fac_id" class="control-label">Factores Riesgo:</label>
                          <select  class="form-control" id="ddl_fac_id" name="ddl_fac_id" required>
                          	<option value="0">--Seleccione--</option>
                          </select>                         
                          <div id="mensaje_id_factores_riesgo" class="errores"></div>
                        </div>
            		  </div>	
            		  </div>		          		        
           		<div class="row">
    			    <div class="col-xs-12 col-md-4 col-lg-4 " style="text-align: center; ">
        	   		    <div class="form-group">
    	                  <button type="submit" id="GuardarDetalle" name="GuardarDetalle" class="btn btn-success" >GUARDAR</button>
    	                  <a href="<?php echo $helper->url("FactoresRiesgoDetalle","Index"); ?>" class="btn btn-danger">CANCELAR</a>
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
      			<h3 class="box-title">Listado de Factores Riesgo Detalle</h3>      			
            </div> 
            <div class="box-body">
    			<div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="buscador_detalle" name="buscador_detalle" onkeyup="consultaFactoresRiesgoDetalle(1)" placeholder="Buscar.."/>
    			</div>            	
            	<div id="factores_riesgo_registrados_detalle" ></div>
            </div> 	
      	</div>
      </section> 
			  </div>
      
             </div>
            </div>
           </div>
         
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
   <script src="view/js/ffspFactoresRiesgo.js?0.2"></script> 
   <script src="view/js/ffspFactoresRiesgoDetalle.js?0.3"></script> 
       
       

 	
	
	
  </body>
</html>   

