<?php
class ffspUsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    public function index10(){
    	 
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$usuarios = new ffspUsuariosModel();
    	$where_to="";
    	$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
    		
    	$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
    		
    	$where    = " rol.id_rol = usuarios.id_rol AND
								  estado.id_estado = usuarios.id_estado AND usuarios.id_estado=1";
    		
    	$id       = "usuarios.id_usuarios";
    		
    	
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	
    	
    	
    	
    	if($action == 'ajax')
    	{
    		
    		if(!empty($search)){
    			 
    			 
    			$where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR rol.nombre_rol LIKE '".$search."%' OR estado.nombre_estado LIKE '".$search."%')";
    			 
    			$where_to=$where.$where1;
    		}else{
    		
    			$where_to=$where;
    			 
    		}
    		
    		$html="";
    		$resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    		
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    		
    		$per_page = 50; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    		
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    		
    		$resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    		
    			
    		
    		
    		
    	if($cantidadResult>0)
    	{
    
    		$html.='<div class="pull-left" style="margin-left:11px;">';
    		$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
    		$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
    		$html.='</div>';
    		$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
			$html.='<section style="height:400px; overflow-y:scroll;">';
    		$html.= "<table id='tabla_usuarios_activos' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    		$html.= "<thead>";
    		$html.= "<tr>";
    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Teléfono</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Rol</th>';
    		$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
    		
    		if($id_rol==1){
	    		
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
	    		$html.='<th style="text-align: left;  font-size: 12px;"></th>';
	    		
    		}else{
    			
    			
    		}
    		
    		$html.='</tr>';
    		$html.='</thead>';
    		$html.='<tbody>';
    		 
    		$i=0;
    		
    		
    		
    		foreach ($resultSet as $res)
    		{
    			$i++;
    			$html.='<tr>';
    			$html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" width="80" height="60"></td>';
    			$html.='<td style="font-size: 11px;">'.$i.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->telefono_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->celular_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->correo_usuarios.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->nombre_rol.'</td>';
    			$html.='<td style="font-size: 11px;">'.$res->nombre_estado.'</td>';
    			
    			if($id_rol==1){
    			
    				$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=ffspUsuarios&action=index&id_usuarios='.$res->id_usuarios.'"  class="btn btn-warning" style="font-size:65%;" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    				$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=ffspUsuarios&action=borrarId&id_usuarios='.$res->id_usuarios.'" class="btn btn-danger" style="font-size:65%;" data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    			
    			
    			}else{
    			
    			
    			}
    			
    				$html.='</tr>';
    		}
    		
    		
    		$html.='</tbody>';
    		$html.='</table>';
    		$html.='</section></div>';
    		$html.='<div class="table-pagination pull-right">';
    		$html.=''. $this->paginate_usuarios_activos("index.php", $page, $total_pages, $adjacents).'';
    		$html.='</div>';
    		
    		
    		 
    	}else{
    		$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    		$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    		$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    		$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios activos registrados...</b>';
    		$html.='</div>';
    		$html.='</div>';
    	}
    	
    	
    	echo $html;
    	die();
    	 
    	} 
    	 
    	 
    }
    
    
    
       
    
    

    public function index11(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$usuarios = new ffspUsuariosModel();
    	$where_to="";
    	$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
    
    	$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
    
    	$where    = " rol.id_rol = usuarios.id_rol AND
								  estado.id_estado = usuarios.id_estado AND usuarios.id_estado=2";
    
    	$id       = "usuarios.id_usuarios";
    
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    
    			$where1=" AND (usuarios.cedula_usuarios LIKE '".$search."%' OR usuarios.nombre_usuarios LIKE '".$search."%' OR usuarios.correo_usuarios LIKE '".$search."%' OR rol.nombre_rol LIKE '".$search."%' OR estado.nombre_estado LIKE '".$search."%')";
    
    			$where_to=$where.$where1;
    		}else{
    
    			$where_to=$where;
    
    		}
    
    		$html="";
    		$resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
    		$cantidadResult=(int)$resultSet[0]->total;
    
    		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    
    		$per_page = 50; //la cantidad de registros que desea mostrar
    		$adjacents  = 9; //brecha entre páginas después de varios adyacentes
    		$offset = ($page - 1) * $per_page;
    
    		$limit = " LIMIT   '$per_page' OFFSET '$offset'";
    
    		$resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    
    		 
    
    
    
    		if($cantidadResult>0)
    		{
    
    			$html.='<div class="pull-left" style="margin-left:11px;">';
    			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
    			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
    			$html.='</div>';
    			$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
    			$html.='<section style="height:400px; overflow-y:scroll;">';
    			$html.= "<table id='tabla_usuarios_inactivos' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    			$html.= "<thead>";
    			$html.= "<tr>";
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Nombre</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Teléfono</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Celular</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Correo</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Rol</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Estado</th>';
    
    			if($id_rol==1){
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				 
    			}else{
    				 
    				 
    				
    			}
    
    			$html.='</tr>';
    			$html.='</thead>';
    			$html.='<tbody>';
    			 
    			$i=0;
    
    
    
    			foreach ($resultSet as $res)
    			{
    				$i++;
    				$html.='<tr>';
    				$html.='<td style="font-size: 11px;"><img src="view/DevuelveImagenView.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=fotografia_usuarios" width="80" height="60"></td>';
    				$html.='<td style="font-size: 11px;">'.$i.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->cedula_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->telefono_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->celular_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->correo_usuarios.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_rol.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_estado.'</td>';
    				 
    				if($id_rol==1){
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=ffspUsuarios&action=index&id_usuarios='.$res->id_usuarios.'"  class="btn btn-warning" style="font-size:65%;" data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					 
    					 
    				}else{
    					 
    					 
    				}
    				 
    				$html.='</tr>';
    			}
    
    
    			$html.='</tbody>';
    			$html.='</table>';
    			$html.='</section></div>';
    			$html.='<div class="table-pagination pull-right">';
    			$html.=''. $this->paginate_usuarios_inactivos("index.php", $page, $total_pages, $adjacents).'';
    			$html.='</div>';
    
    
    			 
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay usuarios inactivos registrados...</b>';
    			$html.='</div>';
    			$html.='</div>';
    		}
    		 
    		 
    		echo $html;
    		die();
    
    	}
    
    
    }
       

       
       
    public function cargar_global_usuarios(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$i=0;
    	$usuarios = new ffspUsuariosModel();
    	$columnas = "usuarios.cedula_usuarios";
    	
    	$tablas   = "public.usuarios";
    	
    	$where    = " 1=1";
    	
    	$id       = "usuarios.id_usuarios";
    
    
    
    	$resultSet = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
    
    	$i=count($resultSet);
    
    	$html="";
    	if($i>0)
    	{
    
    		$html .= "<div class='col-lg-3 col-xs-12'>";
    		$html .= "<div class='small-box bg-green'>";
    		$html .= "<div class='inner'>";
    		$html .= "<h3>$i</h3>";
    		$html .= "<p>Usuarios Registrados.</p>";
    		$html .= "</div>";
    
    
    		$html .= "<div class='icon'>";
    		$html .= "<i class='ion ion-person-add'></i>";
    		$html .= "</div>";
    		
    	
    
    		
    		if($id_rol==1){
    		
    		$html .= "<a href='index.php?controller=ffspUsuarios&action=index' class='small-box-footer'>Operaciones con usuarios <i class='fa fa-arrow-circle-right'></i></a>";
    				
    		}else{
    			$html .= "<a href='#' class='small-box-footer'>Operaciones con usuarios <i class='fa fa-arrow-circle-right'></i></a>";
    		
    		}
    

    		$html .= "</div>";
    		$html .= "</div>";
    		
    		
    	}else{
    		 
    		$html = "<b>Actualmente no hay usuarios registrados...</b>";
    	}
    
    	echo $html;
    	die();
    
    
    
    
    
    
    
    }
    
    
    
public function index(){
	
		session_start();
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
				//Creamos el objeto usuario
		    $rol=new ffspRolesModel();
			$resultRol = $rol->getAll("nombre_rol");
			$resultSet="";
			$estado = new ffspEstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
			$usuarios = new ffspUsuariosModel();

			$nombre_controladores = "ffspUsuarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					
					$resultEdit = "";
			
					if (isset ($_GET["id_usuarios"])   )
					{
						
						
						$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
						
						$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
						
						$id       = "usuarios.id_usuarios";
						
						$_id_usuarios = $_GET["id_usuarios"];
						$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND usuarios.id_usuarios = '$_id_usuarios' "; 
						$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
					}
			
					
					$this->view("ffspUsuarios",array(
							"resultSet"=>$resultSet, "resultRol"=>$resultRol, "resultEdit" =>$resultEdit, "resultEst"=>$resultEst
				
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Usuarios"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("ffspUsuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	public function llenar_fotografia_usuarios(){
	
		session_start();
		$resultado = null;
		$usuarios=new ffspUsuariosModel();
	
	
		
		if ($_FILES['fotografia_usuarios']['tmp_name']!="")
		{
	
		$columnas = "usuarios.cedula_usuarios,
	   			     usuarios.pass_sistemas_usuarios";
			
		$tablas   = "public.usuarios";
			
		$where    = "1=1";
			
		$id       = "usuarios.id_usuarios";
			
		$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
	
		$directorio = $_SERVER['DOCUMENT_ROOT'].'/ficha/fotografias_usuarios/';
		 
		$nombre = $_FILES['fotografia_usuarios']['name'];
		$tipo = $_FILES['fotografia_usuarios']['type'];
		$tamano = $_FILES['fotografia_usuarios']['size'];
		 
		move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
		$data = file_get_contents($directorio.$nombre);
		$imagen_usuarios = pg_escape_bytea($data);
		 
		 
		
	
		if(!empty($resultSet)){
				
			foreach ($resultSet as $res){
	
				$cedula=$res->cedula_usuarios;
				
				$colval = "fotografia_usuarios='$imagen_usuarios'";
				$tabla = "usuarios";
				$where = "cedula_usuarios = '$cedula'";
				$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
	
	
			}
				
		}
		
		
		
		$this->redirect("ffspRoles", "index");
		
	 }
	 
	 
	 $this->view("ffspSubirFotosUsuarios",array(
	 		"resultSet"=>""
	 
	 ));
	 
	
	}
	
	
	
	
	public function encriptar_maycol_postgres(){
		
		session_start();
		$resultado = null;
		$usuarios=new ffspUsuariosModel();
		
		
		
		$columnas = "usuarios.cedula_usuarios,
	   			     usuarios.pass_sistemas_usuarios";
			
		$tablas   = "public.usuarios";
			
		$where    = "1=1 AND usuarios.cedula_usuarios='1750402859'";
			
		$id       = "usuarios.id_usuarios";
			
		$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		
		if(!empty($resultSet)){
			
			foreach ($resultSet as $res){
				
				$cedula=$res->cedula_usuarios;
				$clave_usuarios = $usuarios->encriptar($res->pass_sistemas_usuarios);
				
				
				$colval = "cedula_usuarios= '$cedula', clave_usuarios='$clave_usuarios'";
				$tabla = "usuarios";
				$where = "cedula_usuarios = '$cedula'";
				$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
				
				
			}
			
		}
		
		$this->redirect("ffspRoles", "index");
		
	}
	
	
	
	public function InsertaUsuarios(){
			
		session_start();
		$resultado = null;
		$usuarios=new ffspUsuariosModel();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
	
		if (isset ($_POST["cedula_usuarios"]))
		{
			$_cedula_usuarios    = $_POST["cedula_usuarios"];
			$_nombre_usuarios     = $_POST["nombre_usuarios"];
			$_clave_usuarios      = $usuarios->encriptar($_POST["clave_usuarios"]);
			$_pass_sistemas_usuarios      = $_POST["clave_usuarios"];
			$_telefono_usuarios   = $_POST["telefono_usuarios"];
			$_celular_usuarios    = $_POST["celular_usuarios"];
			$_correo_usuarios     = $_POST["correo_usuarios"];
		    $_id_rol             = $_POST["id_rol"];
		    $_id_estado          = $_POST["id_estado"];
		    
		    $_id_usuarios          = $_POST["id_usuarios"];
		    
		    
		    if($_id_usuarios > 0){
		    	
		    	
		    	if ($_FILES['fotografia_usuarios']['tmp_name']!="")
		    	{
		    			
		    		$directorio = $_SERVER['DOCUMENT_ROOT'].'/ficha/fotografias_usuarios/';
		    			
		    		$nombre = $_FILES['fotografia_usuarios']['name'];
		    		$tipo = $_FILES['fotografia_usuarios']['type'];
		    		$tamano = $_FILES['fotografia_usuarios']['size'];
		    			
		    		move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
		    		$data = file_get_contents($directorio.$nombre);
		    		$imagen_usuarios = pg_escape_bytea($data);
		    			
		    			
		    		$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', id_rol = '$_id_rol', id_estado = '$_id_estado', fotografia_usuarios ='$imagen_usuarios'";
		    		$tabla = "usuarios";
		    		$where = "id_usuarios = '$_id_usuarios'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    			
		    	}
		    	else
		    	{
		    	
		    		$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', id_rol = '$_id_rol', id_estado = '$_id_estado'";
		    		$tabla = "usuarios";
		    		$where = "id_usuarios = '$_id_usuarios'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    	
		    	}
		    	
		    	
		    	
		    }else{
		    
		    	
		    	
		    	
		    if ($_FILES['fotografia_usuarios']['tmp_name']!="")
		    {
		    
		    	$directorio = $_SERVER['DOCUMENT_ROOT'].'/empleados/fotografias_usuarios/';
		    
		    	$nombre = $_FILES['fotografia_usuarios']['name'];
		    	$tipo = $_FILES['fotografia_usuarios']['type'];
		    	$tamano = $_FILES['fotografia_usuarios']['size'];
		    	
		    	move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
		    	$data = file_get_contents($directorio.$nombre);
		    	$imagen_usuarios = pg_escape_bytea($data);
		    
		    
		    	$funcion = "ins_usuarios";
		    	$parametros = "'$_cedula_usuarios',
		    				   '$_nombre_usuarios',
		    				   '$_clave_usuarios',
		    	               '$_pass_sistemas_usuarios',
		    	               '$_telefono_usuarios',
		    	               '$_celular_usuarios',
		    	               '$_correo_usuarios',
		    	               '$_id_rol',
		    	               '$_id_estado',
		    	               '$imagen_usuarios'";
		    	$usuarios->setFuncion($funcion);
		    	$usuarios->setParametros($parametros);
		    	$resultado=$usuarios->Insert();
		    
		    }
		    else
		    {
		    
		    	$where_TO = "cedula_usuarios = '$_cedula_usuarios'";
		    	$result=$usuarios->getBy($where_TO);
		    	 
		    	if ( !empty($result) )
		    	{
		    		 
		    		$colval = "nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', id_rol = '$_id_rol', id_estado = '$_id_estado'";
		    		$tabla = "usuarios";
		    		$where = "cedula_usuarios = '$_cedula_usuarios'";
		    		$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    	}
		        else{
		        	
		        	$imagen_usuarios="";
		        	
		        	$funcion = "ins_usuarios";
		        	$parametros = "'$_cedula_usuarios',
		        	'$_nombre_usuarios',
		        	'$_clave_usuarios',
		        	'$_pass_sistemas_usuarios',
		        	'$_telefono_usuarios',
		        	'$_celular_usuarios',
		        	'$_correo_usuarios',
		        	'$_id_rol',
		        	'$_id_estado',
		        	'$imagen_usuarios'";
		        	$usuarios->setFuncion($funcion);
		        	$usuarios->setParametros($parametros);
		        	$resultado=$usuarios->Insert();
		    	}
		    
		    }
		
		  	 	
		  }
		  
		   
		    $this->redirect("ffspUsuarios", "index");
		}
		
	   }else{
	   	
	   	$error = TRUE;
	   	$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	   		
	   	$this->view("Login",array(
	   			"resultSet"=>"$mensaje", "error"=>$error
	   	));
	   		
	   		
	   	die();
	   	
	   }
	}
	
	
	


	public function AutocompleteCedula(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new ffspUsuariosModel();
		$numero_cedula = $_GET['term'];
			
		$resultSet=$usuarios->getBy("cedula_usuarios LIKE '$numero_cedula%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_numero_cedula[] = $res->cedula_usuarios;
			}
			echo json_encode($_numero_cedula);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveNombres(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
			
		$usuarios = new ffspUsuariosModel();
			
		$cedula_usuario = $_POST['cedula_usuarios'];
		$resultSet=$usuarios->getBy("cedula_usuarios = '$cedula_usuario'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->cedula_usuarios = $resultSet[0]->cedula_usuarios;
			$respuesta->nombre_usuarios = $resultSet[0]->nombre_usuarios;
			$respuesta->pass_sistemas_usuarios = $resultSet[0]->pass_sistemas_usuarios;
			$respuesta->telefono_usuarios = $resultSet[0]->telefono_usuarios;
			$respuesta->celular_usuarios = $resultSet[0]->celular_usuarios;
			$respuesta->correo_usuarios = $resultSet[0]->correo_usuarios;
			$respuesta->id_rol = $resultSet[0]->id_rol;
			$respuesta->id_estado = $resultSet[0]->id_estado;
				
			echo json_encode($respuesta);
		}
			
	}
	
	
	
	
	
	public function borrarId()
	{
		if(isset($_GET["id_usuarios"]))
		{
			$id_usuario=(int)$_GET["id_usuarios"];
	
			$usuarios=new ffspUsuariosModel();
				
			$usuarios->UpdateBy("id_estado=2","usuarios","id_usuarios='$id_usuario'");
			
		}
	
		$this->redirect("ffspUsuarios", "index");
	}
	
	
	
	
	
	
	public function resetear_clave_inicio()
	{
		session_start();
		$_usuario_usuario = "";
		$_clave_usuario = "";
		$usuarios = new ffspUsuariosModel();
		$error = FALSE;
	
	
		$mensaje = "";
	
		if (isset($_POST['cedula_usuarios']))
		{
		    
		 
		    
			$_cedula_usuarios = $_POST['cedula_usuarios'];
	
			$where = "cedula_usuarios = '$_cedula_usuarios'   ";
			$resultUsu = $usuarios->getBy($where);
				
			if(!empty($resultUsu))
			{
	
				foreach ($resultUsu as $res){
						
					$correo_usuario=$res->correo_usuarios;
					$id_estado=$res->id_estado;
					$nombre_usuario   = $res->nombre_usuarios;
				}
	
	
				$cadena = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
				$longitudCadena=strlen($cadena);
				$pass = "";
				$longitudPass=15;
				for($i=1 ; $i<=$longitudPass ; $i++){
					$pos=rand(0,$longitudCadena-1);
					$pass .= substr($cadena,$pos,1);
				}
				$_clave_usuario= $pass;
				$_encryp_pass = $usuarios->encriptar($_clave_usuario);
					
			}
	
			if ($_clave_usuario == "")
			{
				$mensaje = "Este Usuario no existe resgistrado en nuestro sistema.";
	
				$error = TRUE;
	
	
			}
			else
			{
	
				
				if($id_estado==1){
				
				$usuarios->UpdateBy("clave_usuarios = '$_encryp_pass', pass_sistemas_usuarios='$_clave_usuario'", "usuarios", "cedula_usuarios = '$_cedula_usuarios'  ");
					
					
				$cabeceras = "MIME-Version: 1.0 \r\n";
				$cabeceras .= "Content-type: text/html; charset=utf-8 \r\n";
				$cabeceras.= "From: nathy6410@hotmail.com \r\n";
				$destino="$correo_usuario";
				$asunto="Claves de Acceso";
				$fecha=date("d/m/y");
				$hora=date("H:i:s");
	
	
				$resumen="
				<table rules='all'>
				<tr><td WIDTH='1000' HEIGHT='50'><center><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAANsAAADmCAMAAABruQABAAABIFBMVEX////xIAD8/////v/9//3wAAD//f/5/////v3xFgD//P31i4PuAADyAAD//vr9/f/6t7LzYlj0YFT51M3uIgD2HQD2op//+v/wJxP6//roAADy///3h3n4//z1bWj/9vb1ZVL7GgDvU0n4vLb/+PL3pJr95uH/4NzzcmXzUkT/7uz61tH+7eLoJgD5xcH/qaj5rqT2lojubVj1hnDtNSHvsKb68ePodG7439T93+f439/yRjXwJh79gGn1mZf5sKz4vav3OzX6o4z8j4r2rZf4amz0oozqpJv3jX/1fXT+29z6XFL7mZTwVUP51L7uUDf26tj4w7DxQzv4tJnxkHftWUH5xsbfJRD4inHokYfzSS362M79NyPobGH5YVz43shM32PdAAAPxUlEQVR4nO2a/XvattrHZflFkoOsEKwamxAHMIQQoElGMk7o8vK0TxfaZll6tvSstGf//3/x3JKBBOKs63599LmutoltZH2l+1UUIYPBYDAYDAaDwWAwGAwGg8FgMBgMBoPBYDAYDAaDwWAwGAwGg8FgMBgMBoPBYDAYDAaDwWAwGAwGg8FgMBgMBoPBYDAYDIZ/iLDjCD9zj5IoFuoHx/OdxyAiIuwhG8HPvg1/YRshG37wqRepB9SIdP6wiAgNkOfhII68tTdgx4c/i1GdVSLq5NOgsQDgOepQ6tjqX+fvaCMOrq2/8eEmcrQ2O461fn8OpnEcE0LUBUGwEDai+UoJQtQDekGcfAZOIJzAw6BfPJmRLShcB9SHPM+2Yb2Wb6ljLx9AeDiOYb0whllgDKML+ne04bvN59cg+yPV2nwPFMwh6icCstVrFAge8bCelA3vJgo0v6v/HafC8Ujwoo+D9VfBuGgxMpmPPf8b46we6dWBVcROtle5ePny5eHlXo9iUv9b2sRx9fTZm0M+09OLauPdcndBeevFnztl+Gf+63/LFxFsHqzAQfm/W90pcL19fb0NTOFPM6kQMO7eVTcl61OySeV4MXK5XO4eP35Ly8m1YXRwPalarARwHg72j2bBc260Qjrhl9h37PW3egJRf4sf5oMI/6xyxJmC3xzOeulB62jCQ6l+v66M08VgZ/dvJ/PHXJgHLzUYC/k7mKLdG/Hf6kIEwWMPwDj917vWjQvP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' WIDTH='250' HEIGHT='190'/></center></td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='center'><b> RECUPERAR CLAVE </b></td></tr></p>
				<tr style='background: #FFFFFF;'><td  WIDTH='1000' align='justify'>Solicitaste recuperar tu clave de acceso al sistema.</td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background: #FFFFFF'><td WIDTH='1000' align='center'><b> TUS DATOS DE ACCESO SON: </b></td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Usuario:</b> $_cedula_usuarios</td></tr>
				<tr style='background: #FFFFFF;'><td WIDTH='1000' > <b>Clave Temporal:</b> $_clave_usuario </td></tr>
				</tabla>
				<p><table rules='all'></p>
				<tr style='background:#1C1C1C'><td WIDTH='1000' HEIGHT='50' align='center'><font color='white'> Milenio - Copyright © 2019-</font></td></tr>
				</table>
				";
	
	
				if(mail("$destino","Claves de Acceso","$resumen","$cabeceras"))
				{
					$mensaje = "Te hemos enviado un correo electrónico a $correo_usuario con tus datos de acceso.";
						
	
				}else{
					$mensaje = "No se pudo enviar el correo con la informacion. Intentelo nuevamente.";
					$error = TRUE;
	
				}
			
				
				}else{
					
					
					$error = TRUE;
					$mensaje = "Hola $nombre_usuario tu usuario se encuentra inactivo.";
						
						
					$this->view("Login",array(
							"resultSet"=>"$mensaje", "error"=>$error
					));
						
						
					die();
					
				}
				
			}
			 
			$this->view("Login",array(
					"resultSet"=>"$mensaje", "error"=>$error
			));
			 
			 
			die();
			
		}else{
			
			$mensaje = "Ingresa tu cedula para recuperar tu clave.";
			$error = TRUE;
		}
	
	
	
		$this->view("ffspResetUsuariosInicio",array(
				"resultSet"=>$mensaje , "error"=>$error
		));
	
	}
	
	public function Inicio(){
	
		session_start();
		
		$this->view("Login",array(
				"allusers"=>""
		));
	}
    
    
    public function Login(){
    
    	session_destroy();
    	$usuarios=new ffspUsuariosModel();
    
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	 
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Login",array(
    			"allusers"=>$allusers
    	));
    }
    public function Bienvenida(){
    
    	session_start();
    	
    	if(isset($_SESSION['id_usuarios']))
    	{
    		$_usuario=$_SESSION['nombre_usuarios'];
    		$_id_rol=$_SESSION['id_rol'];
    		
    		if($_id_rol==1){
    				
    		
    			$this->view("ffspBienvenidaAdmin",array(
    					"allusers"=>$_usuario
    			));
    				
    			die();
    				
    		}else{
    				
    			$this->view("ffspBienvenida",array(
    					"allusers"=>$_usuario
    			));
    		
    			die();
    				
    		}
    		
    		 
    	}else{
       	
       	$this->redirect("ffspUsuarios","sesion_caducada");
       	
       }
    }
    
    
    
    
    public function Loguear(){
    	
    	$error=FALSE;
    	if (isset($_POST["usuario"]) && ($_POST["clave"] ) )
    	{
    	
    		
    	    $usuarios=new ffspUsuariosModel();
    		$_usuario = $_POST["usuario"];
    		$_clave =   $usuarios->encriptar($_POST["clave"]);
    		
    		 
    		
    		$where = "cedula_usuarios = '$_usuario' AND  clave_usuarios ='$_clave'";
    	
    		$result=$usuarios->getBy($where);

    		$usuario_usuario = "";
    		$id_rol  = "";
    		$nombre_usuario = "";
    		$correo_usuario = "";
    		$ip_usuario = "";
    		
    		if ( !empty($result) )
    		{ 
    			foreach($result as $res) 
    			{
    				$id_usuario  = $res->id_usuarios;
    			    $id_rol           = $res->id_rol;
	    			$nombre_usuario   = $res->nombre_usuarios;
	    			$correo_usuario   = $res->correo_usuarios;
	    			$id_estado        = $res->id_estado;
	    			$cedula_usuarios        = $res->cedula_usuarios;
	    			
    			}	
    			
    			if($id_estado==1){
    				
    				
    				//obtengo ip
    				$ip_usuario = $usuarios->getRealIP();
    				 
    				 
    				///registro sesion
    				$usuarios->registrarSesion($id_usuario, $id_rol, $nombre_usuario, $correo_usuario, $ip_usuario, $cedula_usuarios);
    				 
    				//inserto en la tabla
    				$_id_usuario = $_SESSION['id_usuarios'];
    				 
    				$sesiones = new ffspSesionesModel();
    				
    				$funcion = "ins_sesiones";
    				 
    				$parametros = " '$_id_usuario' ,'$ip_usuario' ";
    				$sesiones->setFuncion($funcion);
    				
    				$_id_rol=$_SESSION['id_rol'];
    				$usuarios->MenuDinamico($_id_rol);
    				 
    				$sesiones->setParametros($parametros);
    				 
    				 
    				$resultado=$sesiones->Insert();
    				 
    				 
    				
    				if($_id_rol==1){
    					

    					$this->view("ffspBienvenidaAdmin",array(
    							"allusers"=>$_usuario
    					));
    					
    					die();
    					
    				}else{
    					
    					$this->view("ffspBienvenida",array(
    							"allusers"=>$_usuario
    					));
    						
    					die();
    					
    				}
    				
    				
    			}else{
    				
    				
    				$error = TRUE;
    				$mensaje = "Hola $nombre_usuario tu usuario se encuentra inactivo.";
    				 
    				 
    				$this->view("Login",array(
    						"resultSet"=>"$mensaje", "error"=>$error
    				));
    				 
    				 
    				die();
    			}
    			
    			
    		}
    		else
    		{
    			$error = TRUE;
    			$mensaje = "Este Usuario no existe resgistrado en nuestro sistema.";
    			
    			
	    		$this->view("Login",array(
	    				"resultSet"=>"$mensaje", "error"=>$error
	    		));
	    		
	    		
	    		die();
    		}
    		
    	} 
    	else
    	{
    		    $error = TRUE;
    			$mensaje = "Ingrese su cedula y su clave.";
    			
    			
	    		$this->view("Login",array(
	    				"resultSet"=>"$mensaje", "error"=>$error
	    		));
	    		
	    		
	    		die();
    		
    	}
    	
    }

    
   
    
    
    public function  sesion_caducada()
    {
    	session_start();
    	session_destroy();
    
    	$error = TRUE;
	    $mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	    	
	    $this->view("Login",array(
	    		"resultSet"=>"$mensaje", "error"=>$error
	    ));
	    	
	    die();
	    		
    
    }
    
    
	public function  cerrar_sesion ()
	{
		session_start();
		session_destroy();
		
		$error = TRUE;
		$mensaje = "Te has desconectado de nuestro sistema.";
		 
		 
		$this->view("Login",array(
				"resultSet"=>"$mensaje", "error"=>$error
		));
		 
		 
		die();
		
		
	}
	
	
	
	public function  actualizo_perfil ()
	{
		session_start();
		session_destroy();
	
		$error = FALSE;
		$mensaje = "Actualizaste tus datos, vuelve a iniciar sesión.";	
			
		$this->view("Login",array(
				"resultSet"=>"$mensaje", "error"=>$error
		));
			
			
		die();
	
	
	}
	
	
	public function Actualiza()
	{
		session_start();
		
		$rol=new ffspRolesModel();
		$resultRol = $rol->getAll("nombre_rol");
			
		$estado = new ffspEstadoModel();
		$resultEst = $estado->getAll("nombre_estado");
			
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			
		    $usuarios = new ffspUsuariosModel();
		
						
					
				$resultEdit = "";
					
				$_id_usuario = $_SESSION['id_usuarios'];
				
				$columnas = " usuarios.id_usuarios,
								  usuarios.cedula_usuarios,
								  usuarios.nombre_usuarios,
								  usuarios.clave_usuarios,
								  usuarios.pass_sistemas_usuarios,
								  usuarios.telefono_usuarios,
								  usuarios.celular_usuarios,
								  usuarios.correo_usuarios,
								  rol.id_rol,
								  rol.nombre_rol,
								  estado.id_estado,
								  estado.nombre_estado,
								  usuarios.fotografia_usuarios,
								  usuarios.creado";
					
					
				$tablas   = "public.usuarios,
								  public.rol,
								  public.estado";
					
				$where    = " rol.id_rol = usuarios.id_rol AND
								  estado.id_estado = usuarios.id_estado AND usuarios.id_usuarios = '$_id_usuario'";
					
				$id       = "usuarios.id_usuarios";
				
				$resultEdit=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
				
				

				if ( isset($_POST["cedula_usuarios"]) )
				{
					
					$_cedula_usuarios    = $_POST["cedula_usuarios"];
					$_nombre_usuarios     = $_POST["nombre_usuarios"];
					//$_usuario_usuario     = $_POST["usuario_usuario"];
					$_clave_usuarios      = $usuarios->encriptar($_POST["clave_usuarios"]);
					$_pass_sistemas_usuarios      = $_POST["clave_usuarios"];
					$_telefono_usuarios   = $_POST["telefono_usuarios"];
					$_celular_usuarios    = $_POST["celular_usuarios"];
					$_correo_usuarios     = $_POST["correo_usuarios"];
					$_id_rol             = $_POST["id_rol"];
					$_id_estado          = $_POST["id_estado"];
					
					$_id_usuario = $_SESSION['id_usuarios'];
					
					if ($_FILES['fotografia_usuarios']['tmp_name']!="")
					{
					
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/empleados/fotografias_usuarios/';
					
						$nombre = $_FILES['fotografia_usuarios']['name'];
						$tipo = $_FILES['fotografia_usuarios']['type'];
						$tamano = $_FILES['fotografia_usuarios']['size'];
						 
						move_uploaded_file($_FILES['fotografia_usuarios']['tmp_name'],$directorio.$nombre);
						$data = file_get_contents($directorio.$nombre);
						$imagen_usuarios = pg_escape_bytea($data);
					
					
						    $colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios', fotografia_usuarios ='$imagen_usuarios'";
							$tabla = "usuarios";
							$where = "id_usuarios = '$_id_usuario'";
							$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
					
					}
					else
					{
						
						$colval = "cedula_usuarios= '$_cedula_usuarios', nombre_usuarios = '$_nombre_usuarios',  clave_usuarios = '$_clave_usuarios', pass_sistemas_usuarios='$_pass_sistemas_usuarios',  telefono_usuarios = '$_telefono_usuarios', celular_usuarios = '$_celular_usuarios', correo_usuarios = '$_correo_usuarios'";
						$tabla = "usuarios";
						$where = "id_usuarios = '$_id_usuario'";
						$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
						
					}
					
				
					
					
					
					
					$this->redirect("ffspUsuarios", "actualizo_perfil");
					 
					 
				}
				else
				{
					$this->view("ffspActualizarUsuarios",array(
							"resultEdit" =>$resultEdit, "resultRol"=>$resultRol, "resultEst"=>$resultEst
								
					));
					
				}
				

		}
	else{
       	
       	$this->redirect("ffspUsuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	////// lo nuevo

	
	
	
	
	
	public function paginate_usuarios_activos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_activos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_activos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_activos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_activos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	
	public function paginate_usuarios_inactivos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_inactivos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_inactivos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_inactivos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_inactivos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}

}
?>
