<?php

class ffspfichaConstanteVitalController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $ficha_constante_vital = new ffspfichaConstanteVitalModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("ffspUsuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "ffspfichaConstanteVital";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $ficha_constante_vital->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Constante Vital"
                
            ));
            exit();
        }
        
        $rsfichaConstanteVital= $ficha_constante_vital->getBy(" 1 = 1 ");
        
        
        $this->view("ffsp_ficha",array(
            "resultSet"=>$rsfichaConstanteVital
            
        ));
        
        
    }
    

    
    public function InsertafichaConstanteVital(){
        
        session_start();
        
        
        $ficha_constante_vital = new ffspfichaConstanteVitalModel();
        
            
            $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
            $_fic_cons_vit_presion_arterial = (isset($_POST["fic_cons_vit_presion_arterial"])) ? $_POST["fic_cons_vit_presion_arterial"] : "" ;
            $_fic_cons_vit_temperatura = (isset($_POST["fic_cons_vit_temperatura"])) ? $_POST["fic_cons_vit_temperatura"] : "" ;
            $_fic_cons_vit_frecuencia_cardiaca = (isset($_POST["fic_cons_vit_frecuencia_cardiaca"])) ? $_POST["fic_cons_vit_frecuencia_cardiaca"] : "" ;
            $_fic_cons_vit_saturacion_oxigeno = (isset($_POST["fic_cons_vit_saturacion_oxigeno"])) ? $_POST["fic_cons_vit_saturacion_oxigeno"] : "" ;
            $_fic_cons_vit_frecuencia_respiratoria = (isset($_POST["fic_cons_vit_frecuencia_respiratoria"])) ? $_POST["fic_cons_vit_frecuencia_respiratoria"] : "" ;
            $_fic_cons_vit_peso = (isset($_POST["fic_cons_vit_peso"])) ? $_POST["fic_cons_vit_peso"] : "" ;
            $_fic_cons_vit_talla = (isset($_POST["fic_cons_vit_talla"])) ? $_POST["fic_cons_vit_talla"] : "" ;
            $_fic_cons_vit_indice_masa_corporal = (isset($_POST["fic_cons_vit_indice_masa_corporal"])) ? $_POST["fic_cons_vit_indice_masa_corporal"] : "" ;
            $_fic_cons_vit_perimetro_abdominal = (isset($_POST["fic_cons_vit_perimetro_abdominal"])) ? $_POST["fic_cons_vit_perimetro_abdominal"] : "" ;
            
            
            $funcion = "ins_ffsp_tbl_ficha_constantes_vitales";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_fic_id > 0){
                
                $parametros = "'$_fic_id',
                                '$_fic_cons_vit_presion_arterial',
                                '$_fic_cons_vit_temperatura',
                                '$_fic_cons_vit_frecuencia_cardiaca',
                                '$_fic_cons_vit_saturacion_oxigeno',
                                '$_fic_cons_vit_frecuencia_respiratoria',
                                '$_fic_cons_vit_peso',
                                '$_fic_cons_vit_talla',
                                '$_fic_cons_vit_indice_masa_corporal',
                                '$_fic_cons_vit_perimetro_abdominal'";
                
                $ficha_constante_vital->setFuncion($funcion);
                $ficha_constante_vital->setParametros($parametros);
                $resultado = $ficha_constante_vital->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Constantes Vitales Ingresado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Constantes Vitales";
            exit();
            
        
        
    }
    
  
    public function editfichaConstanteVital(){
        
        session_start();
        $ficha_constante_vital = new ffspfichaConstanteVitalModel();
            
        if(isset($_POST["fic_id"])){
                
             $fic_id = (int)$_POST["fic_id"];
                
                $query = "SELECT * FROM ffsp_tbl_ficha_constantes_vitales WHERE fic_id='$fic_id'";
                
                $resultado  = $ficha_constante_vital->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
       
        
    }
    
    

    public function delfichaConstanteVital(){
        
        session_start();
        $ficha_constante_vital = new ffspfichaConstanteVitalModel();
       
            
            if(isset($_POST["fic_cons_vit_id"])){
                
                $fic_cons_vit_id = (int)$_POST["fic_cons_vit_id"];
                
                $resultado  = $ficha_constante_vital->eliminarBy("fic_cons_vit_id", $fic_cons_vit_id);
                
                if( $resultado > 0 ){
                    
                    echo json_encode(array('data'=>$resultado));
                    
                }else{
                    
                    echo $resultado;
                }
                
                
                
            }
            
        
        
        
        
    }
    
    
    public function search_ficha_constante_vital(){
        
        session_start();
        $ficha_constante_vital = new ffspfichaConstanteVitalModel();
        
        $where_to="";
     
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
        
        
        if($action == 'ajax' && $fic_id>0)
        {
        
        
        $columnas  = "a.*";
        $tablas    = "public.ffsp_tbl_ficha_constantes_vitales a";
        $where     = "a.fic_id='$fic_id'";
        $id        = "a.fic_cons_vit_id";
        
            
            $where_to=$where;
           
            
            $html="";
            $resultSet=$ficha_constante_vital->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 2; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$ficha_constante_vital->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
               $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:110px; overflow-y:scroll;">';
                $html.= "<table id='tabla_constante_vital' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 12px;">Presión Arterial</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Temperatura</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Frecuencia Cardiaca</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Saturación Oxigeno</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Frecuencia Respiratoria</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Peso</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Talla</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Masa Corporal</th>';
                $html.='<th style="text-align: left;  font-size: 12px;">Perimetro Abdominal</th>';
                
                
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                
                
                $html.='</tr>';
                $html.='</thead>';
                $html.='<tbody>';
                
                
                $i=0;
                
                foreach ($resultSet as $res)
                {
                    
                   
                    
                    $html.='<tr>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_presion_arterial.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_temperatura.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_frecuencia_cardiaca.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_saturacion_oxigeno.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_frecuencia_respiratoria.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_peso.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_talla.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_indice_masa_corporal.'</td>';
                    $html.='<td style="font-size: 11px;">'.$res->fic_cons_vit_perimetro_abdominal.'</td>';
                       $html.='<td style="font-size: 11px;">

                            <a onclick="editfichaConstanteVital('.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 11px;">
                            <a onclick="delfichaConstanteVital('.$res->fic_cons_vit_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_ficha_constante_vital").'';
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