<?php

class ffspRolesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
	    $roles=new ffspRolesModel();
					//Conseguimos todos los usuarios
		$resultSet=$roles->getAll("id_rol");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['nombre_usuarios']) )
		{

			$nombre_controladores = "ffspRoles";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $roles->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_rol"])   )
				{

					$nombre_controladores = "ffspRoles";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $roles->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_rol = $_GET["id_rol"];
						$columnas = " id_rol, nombre_rol ";
						$tablas   = "rol";
						$where    = "id_rol = '$_id_rol' "; 
						$id       = "nombre_rol";
							
						$resultEdit = $roles->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Roles"
					
						));
					
					
					}
					
				}
		
				
				$this->view("ffspRoles",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Roles"
				
				));
				
				exit();	
			}
				
		}
	else{
       	
       	$this->redirect("ffspUsuarios","sesion_caducada");
       	
       }
	
	}
	
	public function InsertaRoles(){
			
		session_start();
		$roles=new ffspRolesModel();

		$nombre_controladores = "ffspRoles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $roles->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$roles=new ffspRolesModel();
		
			if (isset ($_POST["nombre_rol"])   )
			{
				
				$_nombre_rol = $_POST["nombre_rol"];
				$_id_rol =  $_POST["id_rol"];
				
				if($_id_rol > 0){
					
					$columnas = " nombre_rol = '$_nombre_rol'";
					$tabla = "rol";
					$where = "id_rol = '$_id_rol'";
					$resultado=$roles->UpdateBy($columnas, $tabla, $where);
					
				}else{
					
					$funcion = "ins_rol";
					$parametros = " '$_nombre_rol'";
					$roles->setFuncion($funcion);
					$roles->setParametros($parametros);
					$resultado=$roles->Insert();
				}
				
				
				
		
			}
			$this->redirect("ffspRoles", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Roles"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		$roles=new ffspRolesModel();
		$nombre_controladores = "ffspRoles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $roles->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_rol"]))
			{
				$id_rol=(int)$_GET["id_rol"];
		
				
				
				$roles->deleteBy(" id_rol",$id_rol);
				
				
			}
			
			$this->redirect("ffspRoles", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Roles"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
	    $roles=new ffspRolesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("ffspRoles",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>