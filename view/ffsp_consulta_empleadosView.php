<!DOCTYPE HTML>
<html lang="es">
      <head>
         
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Consulta Empleados</title>
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
        <li><a href="<?php echo $helper->url("Usuarios","Bienvenida"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Consulta Empleados</li>
      </ol>
    </section>   

              
     <section class="content">
      	<div class="box box-primary">
      		<div class="box-header with-border">
      			<h3 class="box-title">Listado de Empleados</h3>      			
            </div> 
            <div class="box-body">
    			<div class="pull-right" style="margin-right:15px;">
					<input type="text" value="" class="form-control" id="buscador" name="buscador" onkeyup="search(1)" placeholder="Buscar.."/>
    			</div>            	
            	<div id="empleados_registrados" ></div>
            </div> 	
      	</div>
      </section> 
    
  </div>
  
 
 
 
    
    <!-- PARA VENTANAS MODALES -->
    
      <div class="modal fade" id="mod_ficha" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ingresar Ficha</h4>
          </div>
          <div class="modal-body">
          <!-- empieza el formulario modal productos -->
          	<form class="form-horizontal" method="post" id="frm_ficha" name="frm_ficha">
          	
          	  <div class="form-group">
				<label for="mod_cedu" class="col-sm-3 control-label">Dni:</label>
				<div class="col-sm-8">
				  <input type="hidden" class="form-control" id="mod_empl_id" name="mod_empl_id"  readonly>
				  <input type="text" class="form-control" id="mod_cedu" name="mod_cedu"  readonly>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Empleado:</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  readonly>
				</div>
			  </div>
			  
			  			  
          	<div class="form-group">
				<label for="mod_emp_id" class="col-sm-3 control-label">Empresa:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_emp_id" name="mod_emp_id" required>
					<option value="0">--Seleccione--</option>					
				  </select>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="mod_tip_id" class="col-sm-3 control-label">Tipo Ficha:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="mod_tip_id" name="mod_tip_id" required>
					<option value="0">--Seleccione--</option>					
				  </select>
				</div>
			  </div>
			  <div id="msg_frm_ficha" class=""></div>
			  
          	</form>
          	<!-- termina el formulario modal lote -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" form="frm_ficha" class="btn btn-primary" id="guardar_datos">Ingresar Ficha</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
</div>
    
 
 	<?php include("view/modulos/footer.php"); ?>	

   <div class="control-sidebar-bg"></div>
 </div>
    
    <?php include("view/modulos/links_js.php"); ?>
	

   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.js"></script>
   <script src="view/bootstrap/plugins/input-mask/jquery.inputmask.extensions.js"></script>
   <script src="view/js/ConsultaEmpleados.js?0.2"></script> 
       
   
  </body>
</html>   

