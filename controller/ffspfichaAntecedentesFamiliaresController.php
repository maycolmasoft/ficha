<?php

class ffspfichaAntecedentesFamiliaresController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
        
    public function InsertafichaAntecedentesFamiliares(){
        
        session_start();
        
        
        $ficha_antecedentes_familiares = new ffspFichaAntecendentesFamiliaresModel();
        
            
            $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
            $_ant_id = (isset($_POST["ant_id"])) ? $_POST["ant_id"] : 0 ;
            $_fic_ant_fam_descripcion = (isset($_POST["fic_ant_fam_descripcion"])) ? $_POST["fic_ant_fam_descripcion"] : "" ;
               
            
            $funcion = "ins_ffsp_tbl_ficha_antecedentes_familiares";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_ant_id > 0 && $_fic_id > 0){
                
                $parametros = " '$_fic_id','$_ant_id','$_fic_ant_fam_descripcion'";
                $ficha_antecedentes_familiares->setFuncion($funcion);
                $ficha_antecedentes_familiares->setParametros($parametros);
                $resultado = $ficha_antecedentes_familiares->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Antecedentes Familiares Ingresado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Antecedentes Familiares";
            exit();
            
        
        
    }
    
  
    public function editfichaAntecedentesFamiliares(){
        
        session_start();
        $ficha_antecedentes_familiares = new ffspFichaAntecendentesFamiliaresModel();
        
        if(isset($_POST["fic_id"]) && isset($_POST["ant_id"])){
                
            $ant_id = (int)$_POST["ant_id"];
            $fic_id = (int)$_POST["fic_id"];
                
                $query = "SELECT * FROM ffsp_tbl_ficha_antecedentes_familiares WHERE ant_id = '$ant_id' and fic_id='$fic_id'";
                
                $resultado  = $ficha_antecedentes_familiares->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
    }
    
    

    public function delfichaAntecedentesFamiliares(){
        
        session_start();
        $ficha_antecedentes_familiares = new ffspFichaAntecendentesFamiliaresModel();
        
            
            if(isset($_POST["fic_ant_fam_id"])){
                
                $fic_ant_fam_id = (int)$_POST["fic_ant_fam_id"];
                
                $resultado  = $ficha_antecedentes_familiares->eliminarBy("fic_ant_fam_id", $fic_ant_fam_id);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
        
        
        
        
    }
    
    
    public function search_ficha_antecedentes_familiares(){
        
        session_start();
        $ficha_antecedentes_familiares = new ffspFichaAntecendentesFamiliaresModel();
        
        
        $where_to="";
     
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
        
        
        if($action == 'ajax' && $fic_id>0)
        {
        
        
        $columnas  = "a.*, b.*";
        $tablas    = "public.ffsp_tbl_ficha_antecedentes_familiares a, public.ffsp_tbl_antecedentes_familiares b";
        $where     = "a.ant_id=b.ant_id and a.fic_id='$fic_id'";
        $id        = "a.fic_ant_fam_id";
        
            
            $where_to=$where;
           
            
            $html="";
            $resultSet=$ficha_antecedentes_familiares->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 2; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$ficha_antecedentes_familiares->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:110px; overflow-y:scroll;">';
                $html.= "<table id='tabla_antecedentes_familiares' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;">Antecedente</th>';
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
                    $html.='<td style="font-size: 11px;">'.$res->ant_nombre.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_ant_fam_descripcion.'</td>';
                    
                    $html.='<td style="font-size: 11px;">
                            <a onclick="editfichaAntecedentesFamiliares('.$res->ant_id.', '.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaAntecedentesFamiliares('.$res->fic_ant_fam_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_antecedentes_familiares").'';
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
    
    public function cargaAntecedentesFamiliares(){
        
        $empleados = null;
        $empleados = new ffspEmpleadosModel();
        
        $query = " SELECT ant_id, ant_nombre FROM ffsp_tbl_antecedentes_familiares WHERE 1=1 ORDER BY ant_id";
        
        $resulset = $empleados->enviaquery($query);
        
        if(!empty($resulset) && count($resulset)>0){
            
            echo json_encode(array('data'=>$resulset));
            
        }
    }
    
}
?>