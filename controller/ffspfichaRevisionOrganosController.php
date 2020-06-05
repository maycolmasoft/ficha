<?php

class ffspfichaRevisionOrganosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
        
    public function InsertafichaRevisionOrganos(){
        
        session_start();
        
        
        $ficha_revision_organos = new ffspFichaRevisionOrganosModel();
        
            
            $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
            $_org_id = (isset($_POST["org_id"])) ? $_POST["org_id"] : 0 ;
            $_fic_rev_org_descripcion = (isset($_POST["fic_rev_org_descripcion"])) ? $_POST["fic_rev_org_descripcion"] : "" ;
               
            
            $funcion = "ins_ffsp_tbl_ficha_revision_organos";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_org_id > 0 && $_fic_id > 0){
                
                $parametros = " '$_fic_id','$_org_id','$_fic_rev_org_descripcion'";
                $ficha_revision_organos->setFuncion($funcion);
                $ficha_revision_organos->setParametros($parametros);
                $resultado = $ficha_revision_organos->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Revisión Organos Ingresado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Revisión Organos";
            exit();
            
        
        
    }
    
  
    public function editfichaRevisionOrganos(){
        
        session_start();
        $ficha_revision_organos = new ffspFichaRevisionOrganosModel();
        
        if(isset($_POST["fic_id"]) && isset($_POST["org_id"])){
                
            $org_id = (int)$_POST["org_id"];
            $fic_id = (int)$_POST["fic_id"];
                
                $query = "SELECT * FROM ffsp_tbl_ficha_revision_organos WHERE org_id = '$org_id' and fic_id='$fic_id'";
                
                $resultado  = $ficha_revision_organos->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
    }
    
    

    public function delfichaRevisionOrganos(){
        
        session_start();
        $ficha_revision_organos = new ffspFichaRevisionOrganosModel();
        
            
            if(isset($_POST["fic_rev_org_id"])){
                
                $fic_rev_org_id = (int)$_POST["fic_rev_org_id"];
                
                $resultado  = $ficha_revision_organos->eliminarBy("fic_rev_org_id", $fic_rev_org_id);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
        
        
        
        
    }
    
    
    public function search_ficha_revision_organos(){
        
        session_start();
        $ficha_revision_organos = new ffspFichaRevisionOrganosModel();
        
        
        $where_to="";
     
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
        
        
        if($action == 'ajax' && $fic_id>0)
        {
        
        
        $columnas  = "a.*, b.*";
        $tablas    = "public.ffsp_tbl_ficha_revision_organos a, public.ffsp_tbl_organos b";
        $where     = "a.org_id=b.org_id and a.fic_id='$fic_id'";
        $id        = "a.fic_rev_org_id";
        
            
            $where_to=$where;
           
            
            $html="";
            $resultSet=$ficha_revision_organos->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 2; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$ficha_revision_organos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:110px; overflow-y:scroll;">';
                $html.= "<table id='tabla_revision_organos_actual' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;">Organo</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Descripción</th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$res->org_nombre.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_rev_org_descripcion.'</td>';
                    
                    $html.='<td style="font-size: 11px;">
                            <a onclick="editfichaRevisionOrganos('.$res->org_id.', '.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaRevisionOrganos('.$res->fic_rev_org_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_revision_organos").'';
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
    
    public function cargaOrganos(){
        
        $empleados = null;
        $empleados = new ffspEmpleadosModel();
        
        $query = " SELECT org_id, org_nombre FROM ffsp_tbl_organos WHERE 1=1 ORDER BY org_id";
        
        $resulset = $empleados->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
            
        }
    }
    
}
?>