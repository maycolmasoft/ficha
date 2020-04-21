
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
        <li class="treeview"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Administración</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Usuarios",$controladores) ?>"><a href="index.php?controller=Usuarios&action=index"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li style="<?php echo getcontrolador("Controladores",$controladores) ?>"><a href="index.php?controller=Controladores&action=index"><i class="fa fa-circle-o"></i> Controladores</a></li>
            <li style="<?php echo getcontrolador("Roles",$controladores) ?>"><a href="index.php?controller=Roles&action=index"><i class="fa fa-circle-o"></i> Roles de Usuario</a></li>
            <li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>"><a href="index.php?controller=PermisosRoles&action=index"><i class="fa fa-circle-o"></i> Permisos Roles</a></li>
            <li style="<?php echo getcontrolador("Religion",$controladores) ?>"><a href="index.php?controller=Religion&action=index"><i class="fa fa-circle-o"></i> Religion</a></li>
            <li style="<?php echo getcontrolador("OrientacionSexual",$controladores) ?>"><a href="index.php?controller=OrientacionSexual&action=index"><i class="fa fa-circle-o"></i> Orientacion Sexual</a></li>
            <li style="<?php echo getcontrolador("Sexo",$controladores) ?>"><a href="index.php?controller=Sexo&action=index"><i class="fa fa-circle-o"></i> Sexo</a></li>
            <li style="<?php echo getcontrolador("Empresa",$controladores) ?>"><a href="index.php?controller=Empresa&action=index"><i class="fa fa-circle-o"></i> Empresa</a></li>
            <li style="<?php echo getcontrolador("Antecedentes",$controladores) ?>"><a href="index.php?controller=Antecedentes&action=index"><i class="fa fa-circle-o"></i> Antecedentes</a></li>
            <li style="<?php echo getcontrolador("AntecedentesFamiliares",$controladores) ?>"><a href="index.php?controller=AntecedentesFamiliares&action=index"><i class="fa fa-circle-o"></i> Antecedentes Familiares</a></li>
            <li style="<?php echo getcontrolador("HabitosToxicos",$controladores) ?>"><a href="index.php?controller=HabitosToxicos&action=index"><i class="fa fa-circle-o"></i> Habitos Toxicos</a></li>
      
         </ul>
       </li>
        
        
         <li class="treeview"  style="<?php echo getcontrolador("MenuMantenimiento",$controladores) ?>"  >
          <a href="#">
            <i class="fa fa-folder"></i> <span>Mantenimiento</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Empleados",$controladores) ?>"><a href="index.php?controller=Empleados&action=index"><i class="fa fa-circle-o"></i> Empleados</a></li>
          </ul>
        </li>
        
       
        
       
       
       
       
       <li class="treeview"  style="<?php echo getcontrolador("MenuReportes",$controladores) ?>">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li style="<?php echo getcontrolador("Sesiones",$controladores) ?>"><a href="index.php?controller=Sesiones&action=index">Sesiones</a></li>
           
          </ul>
        </li>
      </ul>









