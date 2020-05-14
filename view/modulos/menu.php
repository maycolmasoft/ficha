
<?php 
$controladores=$_SESSION['controladores'];
 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }
 
?>








      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li class="treeview"  style="<?php echo getcontrolador("ffspMenuAdministracion",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("ffspUsuarios",$controladores) ?>"><a href="index.php?controller=ffspUsuarios&action=index"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li style="<?php echo getcontrolador("ffspControladores",$controladores) ?>"><a href="index.php?controller=ffspControladores&action=index"><i class="fa fa-circle-o"></i> Controladores</a></li>
            <li style="<?php echo getcontrolador("ffspRoles",$controladores) ?>"><a href="index.php?controller=ffspRoles&action=index"><i class="fa fa-circle-o"></i> Roles de Usuario</a></li>
            <li style="<?php echo getcontrolador("ffspPermisosRoles",$controladores) ?>"><a href="index.php?controller=ffspPermisosRoles&action=index"><i class="fa fa-circle-o"></i> Permisos Roles</a></li>
            <li style="<?php echo getcontrolador("ffspReligion",$controladores) ?>"><a href="index.php?controller=ffspReligion&action=index"><i class="fa fa-circle-o"></i> Religion</a></li>
            <li style="<?php echo getcontrolador("ffspOrientacionSexual",$controladores) ?>"><a href="index.php?controller=ffspOrientacionSexual&action=index"><i class="fa fa-circle-o"></i> Orientacion Sexual</a></li>
            <li style="<?php echo getcontrolador("ffspSexo",$controladores) ?>"><a href="index.php?controller=ffspSexo&action=index"><i class="fa fa-circle-o"></i> Sexo</a></li>
            <li style="<?php echo getcontrolador("ffspEmpresa",$controladores) ?>"><a href="index.php?controller=ffspEmpresa&action=index"><i class="fa fa-circle-o"></i> Empresa</a></li>
            <li style="<?php echo getcontrolador("ffspDiscapacidad",$controladores) ?>"><a href="index.php?controller=ffspDiscapacidad&action=index"><i class="fa fa-circle-o"></i> Discapacidad</a></li>
            <li style="<?php echo getcontrolador("ffspAntecedentes",$controladores) ?>"><a href="index.php?controller=ffspAntecedentes&action=index"><i class="fa fa-circle-o"></i> Antecedentes</a></li>
            <li style="<?php echo getcontrolador("ffspAntecedentesFamiliares",$controladores) ?>"><a href="index.php?controller=ffspAntecedentesFamiliares&action=index"><i class="fa fa-circle-o"></i> Antecedentes Familiares</a></li>
            <li style="<?php echo getcontrolador("ffspHabitosToxicos",$controladores) ?>"><a href="index.php?controller=ffspHabitosToxicos&action=index"><i class="fa fa-circle-o"></i> Habitos Toxicos</a></li>
            <li style="<?php echo getcontrolador("ffspEmpleados",$controladores) ?>"><a href="index.php?controller=ffspEmpleados&action=index"><i class="fa fa-circle-o"></i> Empleados</a></li>
            <li style="<?php echo getcontrolador("ffspExamenFisicoRegional",$controladores) ?>"><a href="index.php?controller=ffspExamenFisicoRegional&action=index"><i class="fa fa-circle-o"></i> Examen Fisico Regional</a></li>
            <li style="<?php echo getcontrolador("ffspFactoresRiesgo",$controladores) ?>"><a href="index.php?controller=ffspFactoresRiesgo&action=index"><i class="fa fa-circle-o"></i> Factores Riesgo</a></li>
            <li style="<?php echo getcontrolador("ffspEmpleados",$controladores) ?>"><a href="index.php?controller=ffspEmpleados&action=index"><i class="fa fa-circle-o"></i> Empleados</a></li>
         </ul>
       </li>
        
        
         <li class="treeview"  style="<?php echo getcontrolador("ffspMenuMantenimiento",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          </ul>
        </li>
       <li class="treeview"  style="<?php echo getcontrolador("ffspMenuReportes",$controladores) ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("ffspSesiones",$controladores) ?>"><a href="index.php?controller=ffspSesiones&action=index"><i class="fa fa-circle-o"></i> Sesiones</a></li>
           
          </ul>
        </li>
      </ul>









