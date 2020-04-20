<?php

class PermisosRolesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "PermisosRoles";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			

                    $columnas = "permisos_rol.id_permisos_rol, rol.nombre_rol, permisos_rol.nombre_permisos_rol, controladores.nombre_controladores, permisos_rol.ver_permisos_rol, permisos_rol.editar_permisos_rol, permisos_rol.borrar_permisos_rol  ";
					$tablas   = "public.controladores,  public.permisos_rol, public.rol";
					$where    = " controladores.id_controladores = permisos_rol.id_controladores AND permisos_rol.id_rol = rol.id_rol";
					$id       = " permisos_rol.id_permisos_rol";
						
					$permisos_rol = new PermisosRolesModel();
					$resultSet=$permisos_rol->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
			
			if (!empty($resultPer))
			{
					
					//roles
					$rol = new RolesModel();
					$resultRol=$rol->getAll("nombre_rol");
					
					$controladores=new ControladoresModel();
					$resultCon=$controladores->getAll("nombre_controladores");
			
			
					$resultEdit = "";
					$resul = "";
			
					if (isset ($_GET["id_permisos_rol"])   )
					{
						$nombre_controladores = "PermisosRoles";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
						
							$_id_permisos_rol = $_GET["id_permisos_rol"];
							$resultEdit = $permisos_rol->getBy("id_permisos_rol = '$_id_permisos_rol' ");
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Permisos Roles"
						
									
							));
						
							exit();
						}
						
						
						
					}
			
					
					$this->view("PermisosRoles",array(
							"resultCon"=>$resultCon, "resultSet"=>$resultSet,  "resultEdit"=>$resultEdit, "resultRol"=>$resultRol
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Permisos Rol"
			
				));
			
			
			}
			
		}
	else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
	
	}
	
	
	public function InsertaPermisosRoles(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
	
		
		$nombre_controladores = "PermisosRoles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["nombre_permisos_rol"]) && isset ($_POST["id_controladores"]) && isset ($_POST["id_rol"])  )
			
		{
			$_nombre_permisos_rol = $_POST["nombre_permisos_rol"];
			$_id_controladores = $_POST["id_controladores"];
			$_ver_permisos_rol = $_POST["ver_permisos_rol"];
			$_editar_permisos_rol = $_POST["editar_permisos_rol"];
			$_borrar_permisos_rol = $_POST["borrar_permisos_rol"];
			$_id_rol = $_POST["id_rol"];
			$_id_permisos_rol = $_POST["id_permisos_rol"];
			 
			
			if($_id_permisos_rol > 0){
				
				$columnas = " nombre_permisos_rol = '$_nombre_permisos_rol',
							  id_controladores ='$_id_controladores',	
							  ver_permisos_rol = '$_ver_permisos_rol',
							  editar_permisos_rol = '$_editar_permisos_rol',
							  borrar_permisos_rol = '$_borrar_permisos_rol',
							  id_rol = '$_id_rol'";
				$tabla = "permisos_rol";
				$where = "id_permisos_rol = '$_id_permisos_rol'";
				$resultado=$permisos_rol->UpdateBy($columnas, $tabla, $where);
				
			}else{
			
			$funcion = "ins_permisos_rol";
				$parametros = " '$_nombre_permisos_rol' ,'$_id_controladores' , '$_ver_permisos_rol' , '$_editar_permisos_rol', '$_borrar_permisos_rol', '$_id_rol' ";
				$permisos_rol->setFuncion($funcion);
				$permisos_rol->setParametros($parametros);
				$resultado=$permisos_rol->Insert();
			}				
	
		}
		
		$this->redirect("PermisosRoles", "index");
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos Para Crear Permisos Roles"
		
			));
		
		
		}
		
		
		
	}
	
	public function borrarId()
	{
		$permisos_rol = new PermisosRolesModel();

		session_start();
		
		$nombre_controladores = "PermisosRoles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosBorrar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			if(isset($_GET["id_permisos_rol"]))
			{
				$id_permisos_rol=(int)$_GET["id_permisos_rol"];
		
				$permisos_rol=new PermisosRolesModel();
				
				$permisos_rol->deleteBy(" id_permisos_rol",$id_permisos_rol);
			}
			
			$this->redirect("PermisosRoles", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar Permisos Roles"
		
			));
		
		
		}
		
	}
	
	
	

	
	
	
	
	
	
	

	
	
	
	

	
}
?>