<?php

class ffsp_fichaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
	    $empleados = new ffspEmpleadosModel();
				
		session_start();
		
		if(empty( $_SESSION)){
		    
		    $this->redirect("ffspUsuarios","sesion_caducada");
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
	            
	            $query = "SELECT b.*, c.*, d.* FROM ffsp_tbl_ficha a, ffsp_tbl_empleados b, ffsp_tbl_empresa c, ffsp_tbl_discapacidad d WHERE d.empl_id=b.empl_id AND a.empl_id=b.empl_id AND b.emp_id=c.emp_id AND  a.fic_id = $fic_id";
	            
	            $resultado  = $empleados->enviaquery($query);
	            
	            echo json_encode(array('data'=>$resultado));
	            
	        }
	       
	}
	
	
	public function cargaExamenes(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	  
	    if(isset($_POST["sex_id"])){
	   
	        $sex_id = (int)$_POST["sex_id"];
	        
	    $query = " SELECT ante_id, ante_nombre FROM ffsp_tbl_antecedentes WHERE sex_id='$sex_id' ORDER BY ante_id";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	    
	}
	}
	
	
	public function InsertaMotivo_B() {
	    
	    
	    session_start();
	    
	    $ficha = new ffspFichaModel();
	    
	          $_empl_id = (isset($_POST["empl_id"])) ? $_POST["empl_id"] : 0 ;
	          $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
	          $_fic_motivo_consulta = (isset($_POST["fic_motivo_consulta"])) ? $_POST["fic_motivo_consulta"] : "";
	        
	        $funcion = "ins_ffsp_tbl_ficha_b";
	        $respuesta = 0 ;
	        $mensaje = "";
	        
	        if($_empl_id > 0 && $_fic_id > 0){
	            
	            $parametros =  "'$_fic_id',
                                '$_empl_id',
                                '$_fic_motivo_consulta'";
	            $ficha->setFuncion($funcion);
	            $ficha->setParametros($parametros);
	            $resultado = $ficha->llamafuncionPG();
	            
	            if(is_int((int)$resultado[0])){
	                $respuesta = $resultado[0];
	               
	                $mensaje = "B. Actualizado Correctamente";
	            }
	            
	        }
	        
	        
	        
	        if((int)$respuesta > 0 ){
	            
	            echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
	            exit();
	        }
	        
	        echo "Error al Actualizar Motivo Consulta B.";
	        exit();
	        
	   
	    
	    
	}
	
	
	
	public function InsertaAntecedentes_Plani(){
	    
	    
	    
	    session_start();
	    
	    $ficha = new ffspFichaModel();
	    
	    
	    $_empl_id = (isset($_POST["empl_id"])) ? $_POST["empl_id"] : 0 ;
	    $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
	    $_sex_id = (isset($_POST["sex_id"])) ? $_POST["sex_id"] : 0 ;
	    $_fic_ant_menarquia = (isset($_POST["fic_ant_menarquia"])&& $_POST["fic_ant_menarquia"]!="") ? $_POST["fic_ant_menarquia"] : 'FALSE' ;
	    $_fic_ant_ciclos = (isset($_POST["fic_ant_ciclos"])&& $_POST["fic_ant_ciclos"]!="") ? $_POST["fic_ant_ciclos"] : 'null' ;
	    $_fic_ant_fecha_ultima_mestruacion = (isset($_POST["fic_ant_fecha_ultima_mestruacion"]) && $_POST["fic_ant_fecha_ultima_mestruacion"]!="") ? $_POST["fic_ant_fecha_ultima_mestruacion"] : 'null';
	    
	    $_fic_ant_gestas = (isset($_POST["fic_ant_gestas"])&& $_POST["fic_ant_gestas"]!="") ? $_POST["fic_ant_gestas"] : 'FALSE' ;
	    $_fic_ant_partos = (isset($_POST["fic_ant_partos"])&& $_POST["fic_ant_partos"]!="") ? $_POST["fic_ant_partos"] : 'FALSE' ;
	    $_fic_ant_cesareas = (isset($_POST["fic_ant_cesareas"])&& $_POST["fic_ant_cesareas"]!="") ? $_POST["fic_ant_cesareas"] : 'FALSE' ;
	    $_fic_ant_abortos = (isset($_POST["fic_ant_abortos"])&& $_POST["fic_ant_abortos"]!="") ? $_POST["fic_ant_abortos"] : 'FALSE' ;
	    
	    $_fic_ant_hijos_vivos = (isset($_POST["fic_ant_hijos_vivos"])&& $_POST["fic_ant_hijos_vivos"]!="") ? $_POST["fic_ant_hijos_vivos"] : 'FALSE' ;
	    $_fic_ant_hijos_muertos = (isset($_POST["fic_ant_hijos_muertos"])&& $_POST["fic_ant_hijos_muertos"]!="") ? $_POST["fic_ant_hijos_muertos"] : 'FALSE' ;
	    $_fic_ant_vida_sexual = (isset($_POST["fic_ant_vida_sexual"])&& $_POST["fic_ant_vida_sexual"]!="") ? $_POST["fic_ant_vida_sexual"] : 'FALSE' ;
	    $_fic_ant_metodo_planificacion_familiar = (isset($_POST["fic_ant_metodo_planificacion_familiar"])&& $_POST["fic_ant_metodo_planificacion_familiar"]!="") ? $_POST["fic_ant_metodo_planificacion_familiar"] : 'FALSE' ;
	    $_fic_ant_tipo_metodo_planificacion_familiar = (isset($_POST["fic_ant_tipo_metodo_planificacion_familiar"])&& $_POST["fic_ant_tipo_metodo_planificacion_familiar"]!="") ? $_POST["fic_ant_tipo_metodo_planificacion_familiar"] : '' ;
	    
	    
	    
	    
	    
	    $funcion = "ins_ffsp_tbl_ficha_antecedentes_plani";
	    $respuesta = 0 ;
	    $mensaje = "";
	    
	    if($_empl_id > 0 && $_fic_id > 0 && $_sex_id > 0){
	        
	        $_fic_ant_fecha_ultima_mestruacion = ( $_fic_ant_fecha_ultima_mestruacion == 'null' ) ? $_fic_ant_fecha_ultima_mestruacion : "'".$_fic_ant_fecha_ultima_mestruacion."'";
	        
	        $parametros =  "'$_fic_id',
                                '$_sex_id',
                                '$_fic_ant_menarquia',
                                 $_fic_ant_ciclos,
                                $_fic_ant_fecha_ultima_mestruacion,
                                '$_fic_ant_gestas',
                                '$_fic_ant_partos',
                                '$_fic_ant_cesareas',
                                '$_fic_ant_abortos',
                                '$_fic_ant_hijos_vivos',
                                '$_fic_ant_hijos_muertos',
                                '$_fic_ant_vida_sexual',
                                '$_fic_ant_metodo_planificacion_familiar',
                                '$_fic_ant_tipo_metodo_planificacion_familiar'";
	        
                               //  die($parametros);
                                 
                                 
            //$sqFicha = $ficha->getconsultaPG($funcion,$parametros);
            
//echo $sqFicha; die();
	        $ficha->setFuncion($funcion);
	        $ficha->setParametros($parametros);
	        $resultado = $ficha->llamafuncionPG();
	        
	        if(is_int((int)$resultado[0])){
	            $respuesta = $resultado[0];
	            
	            $mensaje = "C. Actualizado Correctamente";
	        }
	        
	    }
	    
	    
	    
	    if((int)$respuesta > 0 ){
	        
	        echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
	        exit();
	    }
	    
	    echo "Error al Actualizar Antecedentes Personales C.";
	    exit();
	    
	    
	    
	    
	    
	}
	
	
	
	
	
	
	
	public function InsertaAntecedentes_C(){
	    
	    
	    
	    session_start();
	    
	    $ficha = new ffspFichaModel();
	    
	    $_empl_id = (isset($_POST["empl_id"])) ? $_POST["empl_id"] : 0 ;
	    $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
	    $_fic_antecedentes_personales = (isset($_POST["fic_antecedentes_personales"])) ? $_POST["fic_antecedentes_personales"] : "";
	    
	    $funcion = "ins_ffsp_tbl_ficha_c";
	    $respuesta = 0 ;
	    $mensaje = "";
	    
	    if($_empl_id > 0 && $_fic_id > 0){
	        
	        $parametros =  "'$_fic_id',
                                '$_empl_id',
                                '$_fic_antecedentes_personales'";
	        $ficha->setFuncion($funcion);
	        $ficha->setParametros($parametros);
	        $resultado = $ficha->llamafuncionPG();
	        
	        if(is_int((int)$resultado[0])){
	            $respuesta = $resultado[0];
	            
	            $mensaje = "C. Actualizado Correctamente";
	        }
	        
	    }
	    
	    
	    
	    if((int)$respuesta > 0 ){
	        
	        echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
	        exit();
	    }
	    
	    echo "Error al Actualizar Antecedentes Personales C.";
	    exit();
	    
	    
	    
	    
	    
	}
	
	
	public function InsertaAntecedentesDetalle_C(){
	    
	    session_start();
	    
	    $ficha = new ffspFichaModel();
	    
	    $_empl_id = (isset($_POST["empl_id"])) ? $_POST["empl_id"] : 0 ;
	    $_fic_id = (isset($_POST["fic_id"])) ? $_POST["fic_id"] : 0 ;
	    $_ante_id = (isset($_POST["ante_id"])) ? $_POST["ante_id"] : 0;
	    $_fic_ant_det_realizado = (isset($_POST["fic_ant_det_realizado"])) ? $_POST["fic_ant_det_realizado"] : "FALSE";
	    $_fic_ant_det_tiempo = (isset($_POST["fic_ant_det_tiempo"]) && $_POST['fic_ant_det_tiempo'] != "") ? $_POST["fic_ant_det_tiempo"] : 'null';
	    $_fic_ant_det_resultado = (isset($_POST["fic_ant_det_resultado"])) ? $_POST["fic_ant_det_resultado"] : "";
	    
	    
	    
	    
	    $funcion = "ins_ffsp_tbl_ficha_c_detalle";
	    $respuesta = 0 ;
	    $mensaje = "";
	    
	    if($_empl_id > 0 && $_fic_id > 0){
	        
	        $parametros =  "'$_fic_id',
                                '$_ante_id',
                                '$_fic_ant_det_realizado',
                                 $_fic_ant_det_tiempo,
                                '$_fic_ant_det_resultado'";
	        $ficha->setFuncion($funcion);
	        $ficha->setParametros($parametros);
	        $resultado = $ficha->llamafuncionPG();
	        
	        if(is_int((int)$resultado[0])){
	            $respuesta = $resultado[0];
	            
	            $mensaje = "Agregado Correctamente";
	        }
	        
	    }
	    
	    
	    
	    if((int)$respuesta > 0 ){
	        
	        echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
	        exit();
	    }
	    
	    echo "Error al Agregar Exámenes Realizados.";
	    exit();
	    
	    
	}
	
	
	
	public function search_antecendentes_detalle(){
	    
	    session_start();
	    $empleados = new ffspEmpleadosModel();
	    
	    $where_to="";
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $fic_id = (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'0';
	    
	    
	    if($action == 'ajax' && $fic_id>0)
	    {
	        $columnas  = "a.*, b.*";
	        
	        $tablas    = "ffsp_tbl_ficha_antecedentes_detalle a, ffsp_tbl_antecedentes b";
	        
	        $where     = "a.ante_id= b.ante_id AND a.fic_id='$fic_id'";
	        
	        $id        = "a.fic_ant_det_id";
	        
	        $where_to=$where;
	            
	        
	        
	        $html="";
	        $resultSet=$empleados->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 2; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$empleados->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        if($cantidadResult > 0)
	        {
	            
	           
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:110px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_antecedentes_detalle' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 12px;">Exámen</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Realizado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Tiempo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Resultado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            $realizado = "";
	            foreach ($resultSet as $res)
	            {
	                if($res->fic_ant_det_realizado=='t'){
	                    
	                    $realizado="Si";
	                }else{
	                    $realizado="No";
	                }
	                
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 11px;">'.$res->ante_nombre.'</td>';
	                $html.='<td style="font-size: 11px;">'.$realizado.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fic_ant_det_tiempo.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->fic_ant_det_resultado.'</td>';
	                
	                $html.='<td style="font-size: 11px;"><a onclick="editAntecedenteDetalle('.$res->ante_id.', '.$res->fic_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
	                $html.='<td style="font-size: 11px;"><a onclick="delAntecedenteDetalle('.$res->fic_ant_det_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"search_antecedentes_detalle").'';
	            $html.='</div>';
	            
	            
	            
	        }else{
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
	            $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	            $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay registros...</b>';
	            $html.='</div>';
	            $html.='</div>';
	        }
	        
	        
	        echo $html;
	        
	    }
	    
	    
	    
	    
	}
	
	
	
	
	public function editAntecedentesDetalle(){
	    
	    session_start();
	    $empleados = new ffspEmpleadosModel();
	        
	    if(isset($_POST["fic_id"]) && isset($_POST["ante_id"])){
	            
	        $ante_id = (int)$_POST["ante_id"];
	        $fic_id = (int)$_POST["fic_id"];
	            
	            $query = "SELECT a.*
                          FROM ffsp_tbl_ficha_antecedentes_detalle a
                          WHERE a.fic_id='$fic_id' AND a.ante_id='$ante_id'";
	            
	            $resultado  = $empleados->enviaquery($query);
	            
	            echo json_encode(array('data'=>$resultado));
	            
	        }
	     
	}
	
	
	public function delAntecedentesDetalle(){
	    
	    session_start();
	    $ficha_antecedentes = new ffspFichaAntecedentesDetalleModel();
	       
	        if(isset($_POST["fic_ant_det_id"])){
	            
	            $fic_ant_det_id = (int)$_POST["fic_ant_det_id"];
	            
	            $resultado  = $ficha_antecedentes->eliminarBy("fic_ant_det_id ",$fic_ant_det_id);
	            
	            if( $resultado > 0 ){
	                
	                echo json_encode(array('data'=>$resultado));
	                
	            }else{
	                
	                echo $resultado;
	            }
	             
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