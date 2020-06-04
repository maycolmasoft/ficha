<?php

class ffspfichaEmpleoAnteriorController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $ficha_empleo_anterior = new ffspfichaEmpleoAnteriorModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("ffspUsuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "ffspfichaEmpleoAnterior";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $ficha_empleo_anterior->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Empleo Anterior"
                
            ));
            exit();
        }
        
        $rsfichaEmpleoAnterior= $ficha_empleo_anterior->getBy(" 1 = 1 ");
        
        
        $this->view("ffsp_ficha",array(
            "resultSet"=>$rsfichaEmpleoAnterior
            
        ));
        
        
    }
    

    
    public function InsertafichaEmpleoAnterior(){
        
        session_start();
        
        
        $ficha_empleo_anterior = new ffspfichaEmpleoAnteriorModel();
        
            
            $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
            $_fic_emp_ant_empresa = (isset($_POST["fic_emp_ant_empresa"])) ? $_POST["fic_emp_ant_empresa"] : 0 ;
            $_fic_emp_ant_puesto_trabajo = (isset($_POST["fic_emp_ant_puesto_trabajo"])) ? $_POST["fic_emp_ant_puesto_trabajo"] : "" ;
            $_fic_emp_ant_actividades_desempenia = (isset($_POST["fic_emp_ant_actividades_desempenia"])) ? $_POST["fic_emp_ant_actividades_desempenia"] : "" ;
            $_fic_emp_ant_tiempo_trabajo = (isset($_POST["fic_emp_ant_tiempo_trabajo"])) ? $_POST["fic_emp_ant_tiempo_trabajo"] : "" ;
            $_fac_id = (isset($_POST["fac_id"])) ? $_POST["fac_id"] : "" ;
            $_fic_emp_ant_observaciones = (isset($_POST["fic_emp_ant_observaciones"])) ? $_POST["fic_emp_ant_observaciones"] : "" ;
            
            
            $funcion = "ins_ffsp_tbl_ficha_empleos_anteriores";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_fac_id > 0 && $_fic_id > 0){
                
                $parametros = "'$_fic_id','$_fic_emp_ant_empresa','$_fic_emp_ant_puesto_trabajo','$_fic_emp_ant_actividades_desempenia','$_fic_emp_ant_tiempo_trabajo','$_fac_id','$_fic_emp_ant_observaciones'";
                $ficha_empleo_anterior->setFuncion($funcion);
                $ficha_empleo_anterior->setParametros($parametros);
                $resultado = $ficha_empleo_anterior->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Empleo Anterior Ingresado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Empleo Anterior";
            exit();
            
        
        
    }
    
  
    public function editfichaEmpleoAnterior(){
        
        session_start();
        $ficha_empleo_anterior = new ffspfichaEmpleoAnteriorModel();
            
        if(isset($_POST["fic_id"]) && isset($_POST["fac_id"])){
                
            $fac_id = (int)$_POST["fac_id"];
            $fic_id = (int)$_POST["fic_id"];
                
                $query = "SELECT * FROM ffsp_tbl_ficha_empleos_anteriores WHERE fac_id = $fac_id AND fic_id='$fic_id'";
                
                $resultado  = $ficha_empleo_anterior->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
       
        
    }
    
    

    public function delfichaEmpleoAnterior(){
        
        session_start();
        $ficha_empleo_anterior = new ffspfichaEmpleoAnteriorModel();
       
            
            if(isset($_POST["fic_emp_ant_id"])){
                
                $fic_emp_ant_id = (int)$_POST["fic_emp_ant_id"];
                
                $resultado  = $ficha_empleo_anterior->eliminarBy("fic_emp_ant_id", $fic_emp_ant_id);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
        
        
        
        
    }
    
    
    public function search_ficha_empleo_anterior(){
        
        session_start();
        $ficha_empleo_anterior = new ffspfichaEmpleoAnteriorModel();
        
        $where_to="";
     
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
        
        
        if($action == 'ajax' && $fic_id>0)
        {
        
        
        $columnas  = "a.*, b.*";
        $tablas    = "public.ffsp_tbl_ficha_empleos_anteriores a, public.ffsp_tbl_factores_riesgo_cabecera b";
        $where     = "a.fac_id=b.fac_id AND a.fic_id='$fic_id'";
        $id        = "a.fic_emp_ant_id";
        
            
            $where_to=$where;
           
            
            $html="";
            $resultSet=$ficha_empleo_anterior->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 2; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$ficha_empleo_anterior->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:110px; overflow-y:scroll;">';
                $html.= "<table id='tabla_empleo_anterior' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;">Empresa</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Puesto</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Actividades</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Tiempo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Factor Riesgo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Observaciones</th>';
                
                
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    
                    
                    
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_emp_ant_empresa.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_emp_ant_puesto_trabajo.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_emp_ant_actividades_desempenia.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_emp_ant_tiempo_trabajo.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fac_nombre.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_emp_ant_observaciones.'</td>';
                    
                    $html.='<td style="font-size: 11px;">
                            <a onclick="editfichaEmpleoAnterior('.$res->fac_id.', '.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaEmpleoAnterior('.$res->fic_emp_ant_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_empleo_anterior").'';
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
    
    public function cargaFactoresRiesgo(){
        
        $empleados = null;
        $empleados = new ffspFactoresRiesgoModel();
        
        $query = " SELECT fac_id, fac_nombre FROM ffsp_tbl_factores_riesgo_cabecera WHERE 1=1 ORDER BY fac_nombre";
        
        $resulset = $empleados->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
            
        }
    }
    
}
?>