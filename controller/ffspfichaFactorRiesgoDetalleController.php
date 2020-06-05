<?php

class ffspfichaFactorRiesgoDetalleController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $ficha_factor_riesgo_detalle = new ffspfichaFactorRiesgoDetalleModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("ffspUsuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "ffspfichaFactorRiesgoDetalle";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $ficha_factor_riesgo_detalle->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Factor Riesgo Detalle"
                
            ));
            exit();
        }
        
        $rsfichaFactorRiesgoDetalle= $ficha_factor_riesgo_detalle->getBy(" 1 = 1 ");
        
        
        $this->view("ffsp_ficha",array(
            "resultSet"=>$rsfichaFactorRiesgoDetalle
            
        ));
        
        
    }
    
    public function cargaFactorRiesgoFicha(){
        
        $empleados = null;
        $empleados = new ffspfichaFactorRiesgoDetalleModel();
        $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
        
        
        if($_fic_id > 0){
            
        $query = " SELECT fic_fact_ries_id, fic_fact_ries_puesto_trabajo FROM ffsp_tbl_ficha_factores_riesgo WHERE fic_id = '$_fic_id' ORDER BY fic_fact_ries_puesto_trabajo";
        
        $resulset = $empleados->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
            
        }
            
        }
    }
    public function cargaFactorRiesgoCabeza(){
        
        $empleados = null;
        $empleados = new ffspfichaFactorRiesgoDetalleModel();
        
        $query = " SELECT fac_id, fac_nombre FROM ffsp_tbl_factores_riesgo_cabecera WHERE 1=1 ORDER BY fac_nombre";
        
        $resulset = $empleados->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
            
        }
    }
    public function cargaFactorRiesgoDetalle(){
        
        $empleados = null;
        $empleados = new ffspfichaFactorRiesgoDetalleModel();
        $fac_id = (isset($_POST["fac_id"])) ? $_POST["fac_id"] : 0 ;
        
           
        if($fac_id > 0){
           
            $query = " SELECT fact_id, fact_nombre FROM ffsp_tbl_factores_riesgo_detalle WHERE fac_id='$fac_id' ORDER BY fact_nombre";
            
            $resulset = $empleados->enviaquery($query);
            
            if(!empty($resulset) && count($resulset)>0){
                
                echo json_encode(array('data'=>$resulset));
                
            }
            
            
        }
        
       }
       
       
       public function InsertafichaFactorRiesgoDetalle(){
           
           session_start();
           
           
           $ficha_factor_riesgo_detalle = new ffspfichaFactorRiesgoDetalleModel();
           
           
           $_fic_fact_ries_id = (isset($_POST["fic_fact_ries_id"])) ? $_POST["fic_fact_ries_id"] : 0 ;
           $_fact_id = (isset($_POST["fact_id"])) ? $_POST["fact_id"] : 0 ;
           $_fic_fact_ries_det_otros = (isset($_POST["fic_fact_ries_det_otros"])) ? $_POST["fic_fact_ries_det_otros"] : "" ;
           
           
           $funcion = "ins_ffsp_tbl_ficha_estilo_vida";
           $respuesta = 0 ;
           $mensaje = "";
           
           if($_est_vid_id > 0 && $_fic_id > 0){
               
               $parametros = "'$_fic_id','$_est_vid_id','$_fic_est_vid_practica','$_fic_est_vid_cual','$_fic_est_vid_tiempo_cantidad'";
               $ficha_factor_riesgo_detalle->setFuncion($funcion);
               $ficha_factor_riesgo_detalle->setParametros($parametros);
               $resultado = $ficha_factor_riesgo_detalle->llamafuncionPG();
               
               if(is_int((int)$resultado[0])){
                   $respuesta = $resultado[0];
                   $mensaje = "Estilo Vida Ingresado Correctamente";
               }
               
               
           }
           
           
           
           if((int)$respuesta > 0 ){
               
               echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
               exit();
           }
           
           echo "Error al Ingresar Estilo Vida";
           exit();
           
           
           
       }
       
       
   
   
}
?>