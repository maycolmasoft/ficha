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
           
           
           $funcion = "ins_ffsp_tbl_ficha_factores_riesgo_detalle";
           $respuesta = 0 ;
           $mensaje = "";
           
           if($_fact_id > 0 && $_fic_fact_ries_id > 0){
               
               $parametros = "'$_fic_fact_ries_id','$_fact_id','$_fic_fact_ries_det_otros'";
               $ficha_factor_riesgo_detalle->setFuncion($funcion);
               $ficha_factor_riesgo_detalle->setParametros($parametros);
               $resultado = $ficha_factor_riesgo_detalle->llamafuncionPG();
               
               if(is_int((int)$resultado[0])){
                   $respuesta = $resultado[0];
                   $mensaje = "Factor Riesgo Detalle Ingresado Correctamente";
               }
               
               
           }
           
           
           
           if((int)$respuesta > 0 ){
               
               echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
               exit();
           }
           
           echo "Error al Ingresar Factor Riesgo Detalle";
           exit();
           
           
           
       }
       
       public function editfichaFactorRiesgoDetalle(){
           
           session_start();
           $ficha_factor_riesgo_detalle = new ffspfichaFactorRiesgoDetalleModel();
           
           if(isset($_POST["fic_fact_ries_id"]) && isset($_POST["fact_id"])){
               
               $fact_id = (int)$_POST["fact_id"];
               $fic_fact_ries_id = (int)$_POST["fic_fact_ries_id"];
               
               $query = "SELECT * FROM ffsp_tbl_ficha_factores_riesgo_detalle WHERE fact_id = $fact_id AND fic_fact_ries_id='$fic_fact_ries_id'";
               
               $resultado  = $ficha_factor_riesgo_detalle->enviaquery($query);
               
               echo json_encode(array('data'=>$resultado));
               
           }
           
           
           
       }
       public function delfichaFactorRiesgoDetalle(){
           
           session_start();
           $ficha_factor_riesgo_detalle = new ffspfichaFactorRiesgoDetalleModel();
           
           
           if(isset($_POST["fic_fact_ries_det_id"])){
               
               $fic_fact_ries_det_id = (int)$_POST["fic_fact_ries_det_id"];
               
               $resultado  = $ficha_factor_riesgo_detalle->eliminarBy("fic_fact_ries_det_id", $fic_fact_ries_det_id);
               
               if( $resultado > 0 ){
                   
                   echo json_encode(array('data'=>$resultado));
                   
               }else{
                   
                   echo $resultado;
               }
               
               
               
           }
  
       }
       
       public function search_ficha_factor_riesgo_detalle(){
           
           session_start();
           $ficha_factor_riesgo_detalle = new ffspfichaFactorRiesgoDetalleModel();
           
           $where_to="";
           
           $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
           $fic_fact_ries_id = (isset($_REQUEST['fic_fact_ries_id'])&& $_REQUEST['fic_fact_ries_id'] !=NULL)?$_REQUEST['fic_fact_ries_id']:'0';
           $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
           
           $html="";
           
           if($action == 'ajax' && $fic_fact_ries_id>0)
           {
               
               
               $columnas  = "a.*, b.*,c.*,d.*";
               $tablas    = "public.ffsp_tbl_ficha_factores_riesgo_detalle a, public.ffsp_tbl_factores_riesgo_detalle b , public.ffsp_tbl_ficha_factores_riesgo c, ffsp_tbl_factores_riesgo_cabecera d";
               $where     = "a.fact_id=b.fact_id AND a.fic_fact_ries_id=c.fic_fact_ries_id AND a.fic_fact_ries_id='$fic_fact_ries_id' AND c.fic_id = '$fic_id' AND b.fac_id = d.fac_id";
               $id        = "a.fic_fact_ries_det_id";
               
               
               $where_to=$where;
               
               
               $resultSet=$ficha_factor_riesgo_detalle->getCantidad("*", $tablas, $where_to);
               $cantidadResult=(int)$resultSet[0]->total;
               
               $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
               
               $per_page = 2; //la cantidad de registros que desea mostrar
               $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
               $offset = ($page - 1) * $per_page;
               
               $limit = " LIMIT   '$per_page' OFFSET '$offset'";
               
               $resultSet=$ficha_factor_riesgo_detalle->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
               $total_pages = ceil($cantidadResult/$per_page);
               
               if($cantidadResult > 0)
               {
                   
                   $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                   $html.='<section style="height:110px; overflow-y:scroll;">';
                   $html.= "<table id='tabla_factor_riesgo_detalle' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                   $html.= "<thead>";
                   $html.= "<tr>";
                   $html.='<th style="text-align: left;  font-size: 12px;">Puesto</th>';
                   $html.='<th style="text-align: left;  font-size: 12px;">Riesgo</th>';
                   $html.='<th style="text-align: left;  font-size: 12px;">Factor Riesgo Detalle</th>';
                   $html.='<th style="text-align: left;  font-size: 12px;">Otros</th>';
                   
                   
                   $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                   $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                   
                   
                   $html.='</tr>';
                   $html.='</thead>';
                   $html.='<tbody>';
                   
                   
                   $i=0;
                   
                   foreach ($resultSet as $res)
                   {
             
                       
                       
                       $html.='<tr>';
                       $html.='<td style="font-size: 11px;">'.$res->fic_fact_ries_puesto_trabajo.'</td>';
                       $html.='<td style="font-size: 11px;">'.$res->fac_nombre.'</td>';
                       $html.='<td style="font-size: 11px;">'.$res->fact_nombre.'</td>';
                       $html.='<td style="font-size: 11px;">'.$res->fic_fact_ries_det_otros.'</td>';
                       
                       $html.='<td style="font-size: 11px;">
                            <a onclick="editfichaFactorRiesgoDetalle('.$res->fact_id.', '.$res->fic_fact_ries_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                       $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaFactorRiesgoDetalle('.$res->fic_fact_ries_det_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                       
                       
                       $html.='</tr>';
                   }
                   
                   
                   
                   $html.='</tbody>';
                   $html.='</table>';
                   $html.='</section></div>';
                   $html.='<div class="table-pagination pull-right">';
                   $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_factor_riesgo_detalle").'';
                   $html.='</div>';
                   
                   
                   
               }else{
                   $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                   $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                   $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                   $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay registrados...</b>';
                   $html.='</div>';
                   $html.='</div>';
               }
               
               
               echo $html;
               
           }
           
           else {
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
               $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
               $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
               $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay registrados...</b>';
               $html.='</div>';
               $html.='</div>';
               
               echo $html;
           }
           
           
       }
       
       public function paginate($reload, $page, $tpages, $adjacents, $funcion = "") {
           
           $prevlabel = "&lsaquo; Prev";
           $nextlabel = "Next &rsaquo;";
           $out = '<ul class="pagination pagination-large">';
           
           // previous label
           
           if($page==1) {
               $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
           } else if($page==2) {
               $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(1)'>$prevlabel</a></span></li>";
           }else {
               $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page-1).")'>$prevlabel</a></span></li>";
               
           }
           
           // first label
           if($page>($adjacents+1)) {
               $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>1</a></li>";
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
                   $out.= "<li><a href='javascript:void(0);' onclick='$funcion(1)'>$i</a></li>";
               }else {
                   $out.= "<li><a href='javascript:void(0);' onclick='$funcion(".$i.")'>$i</a></li>";
               }
           }
           
           // interval
           
           if($page<($tpages-$adjacents-1)) {
               $out.= "<li><a>...</a></li>";
           }
           
           // last
           
           if($page<($tpages-$adjacents)) {
               $out.= "<li><a href='javascript:void(0);' onclick='$funcion($tpages)'>$tpages</a></li>";
           }
           
           // next
           
           if($page<$tpages) {
               $out.= "<li><span><a href='javascript:void(0);' onclick='$funcion(".($page+1).")'>$nextlabel</a></span></li>";
           }else {
               $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
           }
           
           $out.= "</ul>";
           return $out;
       }
   
}
?>