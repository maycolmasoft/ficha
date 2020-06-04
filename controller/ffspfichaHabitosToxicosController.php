<?php

class ffspfichaHabitosToxicosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $ficha_habitos_toxicos = new ffspfichaHabitosToxicosModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("ffspUsuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "ffspfichaHabitosToxicos";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $ficha_habitos_toxicos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Habitos Toxicos"
                
            ));
            exit();
        }
        
        $rsfichaHabitosToxicos = $ficha_habitos_toxicos->getBy(" 1 = 1 ");
        
        
        $this->view("ffsp_ficha",array(
            "resultSet"=>$rsfichaHabitosToxicos
            
        ));
        
        
    }
    

    
    public function InsertafichaHabitosToxicos(){
        
        session_start();
        
        
        $ficha_habitos_toxicos = new ffspfichaHabitosToxicosModel();
        
            
            $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
            $_hab_id = (isset($_POST["hab_id"])) ? $_POST["hab_id"] : 0 ;
            $_fic_hab_tox_consume = (isset($_POST["fic_hab_tox_consume"])) ? $_POST["fic_hab_tox_consume"] : "" ;
            $_fic_hab_tox_tiempo = (isset($_POST["fic_hab_tox_tiempo"])) ? $_POST["fic_hab_tox_tiempo"] : "" ;
            $_fic_hab_tox_cantidad = (isset($_POST["fic_hab_tox_cantidad"])) ? $_POST["fic_hab_tox_cantidad"] : "" ;
            $_fic_hab_tox_ex_consumidor = (isset($_POST["fic_hab_tox_ex_consumidor"])) ? $_POST["fic_hab_tox_ex_consumidor"] : "" ;
            $_fic_hab_tox_tiempo_abstinencia = (isset($_POST["fic_hab_tox_tiempo_abstinencia"])) ? $_POST["fic_hab_tox_tiempo_abstinencia"] : "" ;
                
            
            $funcion = "ins_ffsp_tbl_ficha_habitos_toxicos";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_hab_id > 0 && $_fic_id > 0){
                
                $parametros = " '$_fic_id','$_hab_id','$_fic_hab_tox_consume','$_fic_hab_tox_tiempo','$_fic_hab_tox_cantidad','$_fic_hab_tox_ex_consumidor','$_fic_hab_tox_tiempo_abstinencia'";
                $ficha_habitos_toxicos->setFuncion($funcion);
                $ficha_habitos_toxicos->setParametros($parametros);
                $resultado = $ficha_habitos_toxicos->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Habitos Toxicos Ingresado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Habitos Toxicos";
            exit();
            
        
        
    }
    
  
    public function editfichaHabitosToxicos(){
        
        session_start();
        $ficha_habitos_toxicos = new ffspfichaHabitosToxicosModel();
            
        if(isset($_POST["fic_id"]) && isset($_POST["hab_id"])){
                
            $hab_id = (int)$_POST["hab_id"];
            $fic_id = (int)$_POST["fic_id"];
                
                $query = "SELECT * FROM ffsp_tbl_ficha_habitos_toxicos WHERE hab_id = $hab_id and fic_id='$fic_id'";
                
                $resultado  = $ficha_habitos_toxicos->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
       
        
    }
    
    

    public function delfichaHabitosToxicos(){
        
        session_start();
        $ficha_habitos_toxicos = new ffspfichaHabitosToxicosModel();
       
            
            if(isset($_POST["fic_hab_tox_id"])){
                
                $fic_hab_tox_id = (int)$_POST["fic_hab_tox_id"];
                
                $resultado  = $ficha_habitos_toxicos->eliminarBy("fic_hab_tox_id", $fic_hab_tox_id);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
        
        
        
        
    }
    
    
    public function search_ficha_habitos_toxicos(){
        
        session_start();
        $ficha_habitos_toxicos = new ffspfichaHabitosToxicosModel();
        
        $where_to="";
     
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
        
        
        if($action == 'ajax' && $fic_id>0)
        {
        
        
        $columnas  = "a.*, b.*";
        $tablas    = "public.ffsp_tbl_ficha_habitos_toxicos a, public.ffsp_tbl_habitos_toxicos b";
        $where     = "a.hab_id=b.hab_id and a.fic_id='$fic_id'";
        $id        = "a.fic_hab_tox_id";
        
            
            $where_to=$where;
           
            
            $html="";
            $resultSet=$ficha_habitos_toxicos->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 2; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$ficha_habitos_toxicos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:110px; overflow-y:scroll;">';
                $html.= "<table id='tabla_habitos_toxicos' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;">Hábito</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Consume</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Tiempo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Cantidad</th>';
                
                
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    if($res->fic_hab_tox_consume=='t'){
                        
                        $realizado="Si";
                    }else{
                        $realizado="No";
                    }
                    
                    
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$res->hab_nombre.'</td>';
                    
                    $html.='<td style="font-size: 11px;">'.$realizado.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_hab_tox_tiempo.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_hab_tox_cantidad.'</td>';
                    
                    $html.='<td style="font-size: 11px;">
                            <a onclick="editfichaHabitosToxicos('.$res->hab_id.', '.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaHabitosToxicos('.$res->fic_hab_tox_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_habitos_toxicos").'';
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
    
    public function cargaHabitosToxicos(){
        
        $empleados = null;
        $empleados = new ffspEmpleadosModel();
        
        $query = " SELECT hab_id, hab_nombre FROM ffsp_tbl_habitos_toxicos WHERE 1=1 ORDER BY hab_nombre";
        
        $resulset = $empleados->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
            
        }
    }
    
}
?>