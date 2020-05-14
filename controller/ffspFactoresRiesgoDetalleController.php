<?php

class ffspFactoresRiesgoDetalleController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
	    $factores_riesgo_detalle = new ffspFactoresRiesgoDetalleModel();
				
		session_start();
		
		if(empty( $_SESSION)){
		    
		    $this->redirect("Usuarios","sesion_caducada");
		    return;
		}
		
		$nombre_controladores = "ffspFactoresRiesgoDetalle";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $factores_riesgo_detalle->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (empty($resultPer)){
		    
		    $this->view("Error",array(
		        "resultado"=>"No tiene Permisos de Acceso Factores Riesgo"
		        
		    ));
		    exit();
		}		    
			
		$rsFactoresRiesgoDetalle = $factores_riesgo_detalle->getBy(" 1 = 1 ");
		
				
		$this->view("ffspFactoresRiesgo",array(
		    "resultSet"=>$rsFactoresRiesgoDetalle
	
		));
			
	
	}
	

	public function InsertaFactoresRiesgoDetalle(){
			
		session_start();
		
		$factores_riesgo_detalle = new ffspFactoresRiesgoDetalleModel();
		
		$nombre_controladores = "ffspFactoresRiesgoDetalle";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $factores_riesgo_detalle->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer)){	
		    
		    $_fact_nombre = (isset($_POST["fact_nombre"])) ? $_POST["fact_nombre"] : "";
		    $_fac_id = (isset($_POST["fac_id"])) ? $_POST["fac_id"] : 0 ;
		    $_fact_id = (isset($_POST["fact_id"])) ? $_POST["fact_id"] : 0 ;
		    
		    $funcion = "ins_ffsp_tbl_factores_riesgo_detalle";
			$respuesta = 0 ;
			$mensaje = ""; 
			
			if($_fact_id == 0){
			    
			    $parametros = "'$_fact_nombre','$_fac_id','$_fact_id'";
			    $factores_riesgo_detalle->setFuncion($funcion);
			    $factores_riesgo_detalle->setParametros($parametros);
			    $resultado = $factores_riesgo_detalle->llamafuncionPG();
			    
			    if(is_int((int)$resultado[0])){
			        $respuesta = $resultado[0];
			        $mensaje = "Factores Riesgo Ingresado Correctamente";
			    }	
			    
			   
			}elseif ($_fact_id > 0){
		
			    $parametros = "'$_fact_nombre','$_fac_id','$_fact_id'";
			    $factores_riesgo_detalle->setFuncion($funcion);
			    $factores_riesgo_detalle->setParametros($parametros);
			    $resultado = $factores_riesgo_detalle->llamafuncionPG();
			    
			    if(is_int((int)$resultado[0])){
			        $respuesta = $resultado[0];
			        $mensaje = "Factores Riesgo Actualizado Correctamente";
			    }	
			    
			    
			}
			
			
	
			if((int)$respuesta > 0 ){
			    
			    echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
			    exit();
			}
			
			echo "Error al Ingresar Factores Riesgo";
			exit();
			
		}
		else
		{
		    echo 'revise sus permisos ';
		}
		
	}
	

	public function editFactoresRiesgoDetalle(){
	    
	    session_start();
	    $factores_riesgo_detalle = new ffspFactoresRiesgoDetalleModel();
	    $nombre_controladores = "ffspFactoresRiesgoDetalle";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $factores_riesgo_detalle->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    	     
	    if (!empty($resultPer))
	    {
	        
	        
	        if(isset($_POST["fact_id"])){
	            
	            $fact_id = (int)$_POST["fact_id"];
	            
	            $query = "SELECT * FROM ffsp_tbl_factores_riesgo_detalle WHERE fact_id = $fact_id";

	            $resultado  = $factores_riesgo_detalle->enviaquery($query);	            
	           
	            echo json_encode(array('data'=>$resultado));	            
	            
	        }
	       	        
	        
	    }
	    else
	    {
	        echo "Usuario no tiene permisos-Editar";
	    }
	    
	}
	

	public function delFactoresRiesgoDetalle(){
	    
	    session_start();
	    $factores_riesgo_detalle = new ffspFactoresRiesgoDetalleModel();
	    $nombre_controladores = "ffspFactoresRiesgoDetalle";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $factores_riesgo_detalle->getPermisosBorrar("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer)){	        
	        
	        if(isset($_POST["fact_id"])){
	            
	            $fact_id = (int)$_POST["fact_id"];
	            
	            $resultado  = $factores_riesgo_detalle->eliminarBy("fact_id ",$fact_id);
	           
	            if( $resultado > 0 ){
	                
	                echo json_encode(array('data'=>$resultado));
	                
	            }else{
	                
	                echo $resultado;
	            }
	            
	            
	            
	        }
	        
	        
	    }else{
	        
	        echo "Usuario no tiene permisos-Eliminar";
	    }
	    
	    
	    
	}
	
	
	public function consultaFactoresRiesgoDetalle(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $factores_riesgo_detalle = new ffspFactoresRiesgoDetalleModel();
	    
	    $where_to="";
	    $columnas  = "ffsp_tbl_factores_riesgo_detalle.fact_id, 
                      ffsp_tbl_factores_riesgo_detalle.fact_nombre, 
                      ffsp_tbl_factores_riesgo_cabecera.fac_id, 
                      ffsp_tbl_factores_riesgo_cabecera.fac_nombre";
	    
	    $tablas    = "public.ffsp_tbl_factores_riesgo_detalle, 
                      public.ffsp_tbl_factores_riesgo_cabecera";
	    
	    $where     = "ffsp_tbl_factores_riesgo_cabecera.fac_id = ffsp_tbl_factores_riesgo_detalle.fac_id";
	    
	    $id        = "ffsp_tbl_factores_riesgo_detalle.fact_nombre";
	    
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';	    
	    
	    if($action == 'ajax')
	    {
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND fact_nombre ILIKE '".$search."%'";
	            
	            $where_to=$where.$where1;
	            
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$factores_riesgo_detalle->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$factores_riesgo_detalle->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $total_pages = ceil($cantidadResult/$per_page);	        
	        
	        if($cantidadResult > 0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:400px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_factores_riesgo' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Factores Riesgo</th>';
	            
	            /*para administracion definir administrador MenuOperaciones Edit - Eliminar*/
	                
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
                $html.='<th style="text-align: left;  font-size: 12px;"></th>';
	            
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                $html.='<td style="font-size: 14px;">'.$i.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->fact_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->fac_nombre.'</td>';
	                
	               
	                /*comentario up */
	                
                    $html.='<td style="font-size: 18px;">
                            <a onclick="editFactoresRiesgoDetalle('.$res->fact_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 18px;">
                            <a onclick="delFactoresRiesgoDetalle('.$res->fact_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
	                    
	               
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaFactoresRiesgoDetalle").'';
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
	    
	    $factores_riesgo_detalle = null;
	    $factores_riesgo_detalle = new ffspFactoresRiesgoDetalleModel();
	    
	    $query = "SELECT fac_id, fac_nombre FROM ffsp_tbl_factores_riesgo_cabecera WHERE 1=1 ORDER BY fac_nombre";
	    
	    $resulset = $factores_riesgo_detalle->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	
}
?>