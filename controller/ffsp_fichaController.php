<?php

class ffsp_fichaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
	    $empleados = new ffspEmpleadosModel();
				
		session_start();
		
		if(empty( $_SESSION)){
		    
		    $this->redirect("Usuarios","sesion_caducada");
		    return;
		}
		
		if(isset($_GET["id"])){
		    
		    $_fic_id=$_GET["id"];
		    $resultEdit="";
		    
		    
		    
		    $this->view("ffsp_ficha",array(
		        "fic_id"=>$_fic_id, "resultEdit"=>$resultEdit
		        
		    ));
		}
			
	
	}
	
	
	public function cargarEmpleados(){
	    
	    session_start();
	    $empleados = new ffspEmpleadosModel();
	    
	        
	        if(isset($_POST["fic_id"])){
	            
	            $fic_id = (int)$_POST["fic_id"];
	            
	            $query = "SELECT b.*, c.* FROM ffsp_tbl_ficha a, ffsp_tbl_empleados b, ffsp_tbl_empresa c WHERE a.empl_id=b.empl_id AND b.emp_id=c.emp_id AND  a.fic_id = $fic_id";
	            
	            $resultado  = $empleados->enviaquery($query);
	            
	            echo json_encode(array('data'=>$resultado));
	            
	        }
	        
	        
	   
	    
	}
	
	
	
}
?>