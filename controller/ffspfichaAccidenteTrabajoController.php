<?php

class ffspfichaAccidenteTrabajoController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $ficha_accidente_trabajo = new ffspfichaAccidenteTrabajoModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("ffspUsuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "ffspfichaAccidenteTrabajo";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $ficha_accidente_trabajo->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Empleo Anterior"
                
            ));
            exit();
        }
        
        $rsfichaAccidenteTrabajo= $ficha_accidente_trabajo->getBy(" 1 = 1 ");
        
        
        $this->view("ffsp_ficha",array(
            "resultSet"=>$rsfichaAccidenteTrabajo
            
        ));
        
        
    }
    

    
    public function InsertafichaAccidenteTrabajo(){
        
        session_start();
        
        
        $ficha_accidente_trabajo = new ffspfichaAccidenteTrabajoModel();
        
            
            $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
            $_fic_acc_tra_fue_calificado = (isset($_POST["fic_acc_tra_fue_calificado"])) ? $_POST["fic_acc_tra_fue_calificado"] : 0 ;
            $_fic_acc_tra_especificar = (isset($_POST["fic_acc_tra_especificar"])) ? $_POST["fic_acc_tra_especificar"] : "" ;
            $_fic_acc_tra_fecha = (isset($_POST["fic_acc_tra_fecha"])) ? $_POST["fic_acc_tra_fecha"] : "" ;
            $_fic_acc_tra_observaciones = (isset($_POST["fic_acc_tra_observaciones"])) ? $_POST["fic_acc_tra_observaciones"] : "" ;
            
            
            $funcion = "ins_ffsp_tbl_ficha_accidentes_trabajo";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_fic_id > 0){
                
                $parametros = "'$_fic_id','$_fic_acc_tra_fue_calificado','$_fic_acc_tra_especificar','$_fic_acc_tra_fecha','$_fic_acc_tra_observaciones'";
                $ficha_accidente_trabajo->setFuncion($funcion);
                $ficha_accidente_trabajo->setParametros($parametros);
                $resultado = $ficha_accidente_trabajo->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Accidentes de Trabajo Ingresado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Accidentes de Trabajo";
            exit();
            
        
        
    }
    
  
    public function editfichaAccidenteTrabajo(){
        
        session_start();
        $ficha_accidente_trabajo = new ffspfichaAccidenteTrabajoModel();
            
        if(isset($_POST["fic_id"])){
                
             $fic_id = (int)$_POST["fic_id"];
                
                $query = "SELECT * FROM ffsp_tbl_ficha_accidentes_trabajo WHERE fic_id='$fic_id'";
                
                $resultado  = $ficha_accidente_trabajo->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
       
        
    }
    
    

    public function delfichaAccidenteTrabajo(){
        
        session_start();
        $ficha_accidente_trabajo = new ffspfichaAccidenteTrabajoModel();
       
            
            if(isset($_POST["fic_acc_tra_id"])){
                
                $fic_acc_tra_id = (int)$_POST["fic_acc_tra_id"];
                
                $resultado  = $ficha_accidente_trabajo->eliminarBy("fic_acc_tra_id", $fic_acc_tra_id);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
        
        
        
        
    }
    
    
    public function search_ficha_accidente_trabajo(){
        
        session_start();
        $ficha_accidente_trabajo = new ffspfichaAccidenteTrabajoModel();
        
        $where_to="";
     
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
        
        
        if($action == 'ajax' && $fic_id>0)
        {
        
        
        $columnas  = "a.*";
        $tablas    = "public.ffsp_tbl_ficha_accidentes_trabajo a";
        $where     = "a.fic_id='$fic_id'";
        $id        = "a.fic_acc_tra_id";
        
            
            $where_to=$where;
           
            
            $html="";
            $resultSet=$ficha_accidente_trabajo->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 2; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$ficha_accidente_trabajo->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:110px; overflow-y:scroll;">';
                $html.= "<table id='tabla_empleo_anterior' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;">Calificado</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Especificar</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Fecha</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Observaciones</th>';
                
                
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    
                    if($res->fic_acc_tra_fue_calificado=='t'){
                        
                        $realizado="Si";
                    }else{
                        $realizado="No";
                    }
                    
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$realizado.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_acc_tra_especificar.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_acc_tra_fecha.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_acc_tra_observaciones.'</td>';
                    $html.='<td style="font-size: 11px;">

                            <a onclick="editfichaAccidenteTrabajo('.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaAccidenteTrabajo('.$res->fic_acc_tra_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_accidente_trabajo").'';
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
    
}
?>