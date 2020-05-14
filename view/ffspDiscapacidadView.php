<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Discapacidad</title>
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
        <li class="active">Discapacidad</li>
      </ol>
    </section>   

    <section class="content">
     <div class="box box-primary">
     <div class="box-header">
          <h3 class="box-title">Registrar Discapacidad</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            
          </div>
        </div>
        
                  
  		<div class="box-body">

			<form id="frm_Discapacidad" action="<?php echo $helper->url("ffspDiscapacidad","Index"); ?>" method="post" class="col-lg-12 col-md-12 col-xs-12">
             
							    
							    
		    	 <div class="row">
        		    <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="dis_descripcion" class="control-label">Descripcion:</label>
                          <input  type="text" class="form-control" id="dis_descripcion" name="dis_descripcion" value=""  placeholder="Descripcion" required/>
                          <input type="hidden" name="dis_id" id="dis_id" value="0" />
                          <div id="mensaje_dis_descripcion" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                                              
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="dis_tipo" class="control-label">Tipo:</label>
                          <input  type="text" class="form-control" id="dis_tipo" name="dis_tipo" value=""  placeholder="Tipo" required/>
                          <div id="mensaje_dis_tipo" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                                              
                        </div>
            		  </div>
            		  
            		  <div class="col-xs-12 col-md-3 col-md-3 ">
            		    <div class="form-group">
            		    					  
                          <label for="dis_porcentaje" class="control-label">Porcentaje:</label>
                          <input  type="text" class="form-control" id="dis_porcentaje" name="dis_porcentaje" value="" onKeyPress="return soloNumeros(event)" placeholder="Porcentaje" required/>
                          <div id="mensaje_dis_porcentaje" class="errores"></div>
                          <div id="divLoaderPage" ></div>                     	
                                              
                        </div>
            		  </div>
            		  
            		
            	
                        		 
				    
          	   	</div>	
							          		        
           		<div class="row">
    			    <div class="col-xs-12 col-md-4 col-lg-4 " style="text-align: center; ">
        	   		    <div class="form-group">
    	                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">GUARDAR</button>
    	                  <a href="<?php echo $helper->url("ffspDiscapacidad","Index"); ?>" class="btn btn-danger">CANCELAR</a>
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
      			<h3 class="box-title">Discapacidades Registradas</h3>      			
            </div> 
            <div class="box-body">
    			<div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="buscador" name="buscador" onkeyup="consultaDiscapacidad(1)" placeholder="Buscar.."/>
    			</div>            	
            	<div id="discapacidad_registrados" ></div>
            </div> 	
      	</div>
      </section> 
    
  </div>
  
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	
<script type="text/javascript">
// Solo permite ingresar numeros.
function soloNumeros(e){
	var key = window.Event ? e.which : e.keyCode
	return (key >= 48 && key <= 57)
}
</script>
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
   <script src="view/js/ffspDiscapacidad.js?1.5"></script> 
       
       

 	
	
	
  </body>
</html>   

