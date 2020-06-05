<?php

class ffspEmpleadosController extends ControladorBase{

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
		
		$nombre_controladores = "ffspEmpleados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $empleados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (empty($resultPer)){
		    
		    $this->view("Error",array(
		        "resultado"=>"No tiene Permisos de Acceso Empleados"
		        
		    ));
		    exit();
		}		    
			
		//$rsEmpleados = $empleados->getBy(" 1 = 1 ");
		
				
		$this->view("ffspEmpleados",array(
		    "resultSet"=>""
	
		));
			
	
	}
	

	public function InsertaEmpleados(){
			
		session_start();
		
		$empleados = new ffspEmpleadosModel();
		
		$nombre_controladores = "ffspEmpleados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $empleados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer)){	
		    
		    $_empl_primer_nombre = (isset($_POST["empl_primer_nombre"])) ? $_POST["empl_primer_nombre"] : "";
		    $_empl_segundo_nombre = (isset($_POST["empl_segundo_nombre"])) ? $_POST["empl_segundo_nombre"] : "";
		    $_empl_primer_apellido = (isset($_POST["empl_primer_apellido"])) ? $_POST["empl_primer_apellido"] : "";
		    $_empl_segundo_apellido = (isset($_POST["empl_segundo_apellido"])) ? $_POST["empl_segundo_apellido"] : "";
		    $_ide_id = (isset($_POST["ide_id"])) ? $_POST["ide_id"] : 0 ;
		    $_empl_dni = (isset($_POST["empl_dni"])) ? $_POST["empl_dni"] : "";
		    $_empl_edad = (isset($_POST["empl_edad"])) ? $_POST["empl_edad"] : 0 ;
		    $_empl_grupo_sanguineo = (isset($_POST["empl_grupo_sanguineo"])) ? $_POST["empl_grupo_sanguineo"] : "";
		    $_empl_fecha_ingreso = (isset($_POST["empl_fecha_ingreso"])) ? $_POST["empl_fecha_ingreso"] : 0 ;
		    $_empl_lugar_trabajo = (isset($_POST["empl_lugar_trabajo"])) ? $_POST["empl_lugar_trabajo"] : "";
		    $_empl_area_trabajo = (isset($_POST["empl_area_trabajo"])) ? $_POST["empl_area_trabajo"] : "";
		    $_empl_actividades_trabajo = (isset($_POST["empl_actividades_trabajo"])) ? $_POST["empl_actividades_trabajo"] : "";
		    $_emp_id = (isset($_POST["emp_id"])) ? $_POST["emp_id"] : 0 ;
		    $_ori_id = (isset($_POST["ori_id"])) ? $_POST["ori_id"] : 0 ;
		    $_rel_id = (isset($_POST["rel_id"])) ? $_POST["rel_id"] : 0 ;
		    $_sex_id = (isset($_POST["sex_id"])) ? $_POST["sex_id"] : 0 ;
		    $_empl_id = (isset($_POST["empl_id"])) ? $_POST["empl_id"] : 0 ; 
		    $_dis_tiene = (isset($_POST["dis_tiene"])) ? $_POST["dis_tiene"] : "NO" ;
		    $_dis_nombre = (isset($_POST["dis_nombre"])) ? $_POST["dis_nombre"] : "";
		    $_dis_porcentaje = (isset($_POST["dis_porcentaje"])) ? $_POST["dis_porcentaje"] : "";
		    
		    $funcion = "ins_ffsp_tbl_empleados";
			$respuesta = 0 ;
			$mensaje = ""; 
			
			if($_empl_id == 0){
			    
			    $parametros =  "'$_empl_primer_nombre',
                                '$_empl_segundo_nombre',
                                '$_empl_primer_apellido',
                                '$_empl_segundo_apellido',
                                '$_ide_id',
                                '$_empl_dni',
                                '$_empl_edad',
                                '$_empl_grupo_sanguineo',
                                '$_empl_fecha_ingreso',
                                '$_empl_lugar_trabajo',
                                '$_empl_area_trabajo',
                                '$_empl_actividades_trabajo',
                                '$_emp_id',
                                '$_ori_id',
                                '$_rel_id',
                                '$_sex_id',
                                '$_empl_id'";
			    $empleados->setFuncion($funcion);
			    $empleados->setParametros($parametros);
			    $resultado = $empleados->llamafuncionPG();
			    
			    if(is_int((int)$resultado[0])){
			        $respuesta = $resultado[0];
			        $id_empleado = $resultado[0];
			        if( $id_empleado > 0  )
			        {
			            //aqui mandara a llamar al otra funcion de la discapcidad
			            $_dis_tiene  = ($_dis_tiene == "SI") ? 't' : 'f';
			            $_dis_porcentaje = ( strlen($_dis_porcentaje) == 0 ) ? 0 : $_dis_porcentaje;
			            $funcion = "ins_ffsp_tbl_discapacidad";
			            $parametros = "'$_dis_nombre',
                                        '$_dis_porcentaje',
                                        '$_dis_tiene',
                                        '$id_empleado'";
			            $qryDis   = $empleados->getconsultaPG($funcion,$parametros);
			            $resultado2  = $empleados->llamarconsultaPG($qryDis);
			        }
			        $mensaje = "Empleados Ingresado Correctamente";
			    }	
			    
			   
			}elseif ($_empl_id > 0){
		
			    $parametros =  "'$_empl_primer_nombre',
                                '$_empl_segundo_nombre',
                                '$_empl_primer_apellido',
                                '$_empl_segundo_apellido',
                                '$_ide_id',
                                '$_empl_dni',
                                '$_empl_edad',
                                '$_empl_grupo_sanguineo',
                                '$_empl_fecha_ingreso',
                                '$_empl_lugar_trabajo',
                                '$_empl_area_trabajo',
                                '$_empl_actividades_trabajo',
                                '$_emp_id',
                                '$_ori_id',
                                '$_rel_id',
                                '$_sex_id',
                                '$_empl_id'";
			    $empleados->setFuncion($funcion);
			    $empleados->setParametros($parametros);
			    $resultado = $empleados->llamafuncionPG();
			    
			    if(is_int((int)$resultado[0])){
			        $respuesta = $resultado[0];
			        $mensaje = "Empleados Actualizado Correctamente";
			        
		            //aqui mandara a llamar al otra funcion de la discapcidad
		            $_dis_tiene  = ($_dis_tiene == "SI") ? 't' : 'f';
		            $_dis_porcentaje = ( strlen($_dis_porcentaje) == 0 ) ? 0 : $_dis_porcentaje;
		            $funcion = "ins_ffsp_tbl_discapacidad";
		            $parametros = "'$_dis_nombre',
                                    '$_dis_porcentaje',
                                    '$_dis_tiene',
                                    '$_empl_id'";
		            $qryDis   = $empleados->getconsultaPG($funcion,$parametros);
		            $resultado2  = $empleados->llamarconsultaPG($qryDis);
			        
			        
			    }	
			    
			    
			}
			
			
	
			if((int)$respuesta > 0 ){
			    
			    echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
			    exit();
			}
			
			echo "Error al Ingresar Empleados";
			exit();
			
		}
		else
		{
		    $this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Empleados"
		
			));
		}
		
	}
	

	public function editEmpleados(){
	    
	    session_start();
	    $empleados = new ffspEmpleadosModel();
	    $nombre_controladores = "ffspEmpleados";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $empleados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    	     
	    if (!empty($resultPer))
	    {
	        
	        
	        if(isset($_POST["empl_id"])){
	            
	            $empl_id = (int)$_POST["empl_id"];
	            
	            $query = "SELECT ffsp_tbl_discapacidad.dis_id, 
                          ffsp_tbl_discapacidad.dis_nombre, 
                          ffsp_tbl_discapacidad.dis_porcentaje, 
                          ffsp_tbl_discapacidad.dis_tiene, 
                          ffsp_tbl_empleados.empl_id, 
                          ffsp_tbl_empleados.empl_primer_nombre, 
                          ffsp_tbl_empleados.empl_segundo_nombre, 
                          ffsp_tbl_empleados.empl_primer_apellido, 
                          ffsp_tbl_empleados.empl_segundo_apellido, 
                          ffsp_tbl_empleados.ide_id, 
                          ffsp_tbl_empleados.empl_dni, 
                          ffsp_tbl_empleados.empl_edad, 
                          ffsp_tbl_empleados.empl_grupo_sanguineo, 
                          ffsp_tbl_empleados.empl_fecha_ingreso, 
                          ffsp_tbl_empleados.empl_lugar_trabajo, 
                          ffsp_tbl_empleados.empl_area_trabajo, 
                          ffsp_tbl_empleados.empl_actividades_trabajo, 
                          ffsp_tbl_empleados.emp_id, 
                          ffsp_tbl_empleados.ori_id, 
                          ffsp_tbl_empleados.rel_id, 
                          ffsp_tbl_empleados.sex_id 
                          FROM  public.ffsp_tbl_discapacidad, 
                          public.ffsp_tbl_empleados 
                          WHERE ffsp_tbl_empleados.empl_id = ffsp_tbl_discapacidad.empl_id AND ffsp_tbl_empleados.empl_id = $empl_id";

	            $resultado  = $empleados->enviaquery($query);	            
	           
	            echo json_encode(array('data'=>$resultado));	            
	            
	        }
	       	        
	        
	    }
	    else
	    {
	        echo "Usuario no tiene permisos-Editar";
	    }
	    
	}
	

	public function delEmpleados(){
	    
	    session_start();
	    $discapacidad = new ffspDiscapacidadModel();
	    $empleados = new ffspEmpleadosModel();
	    $nombre_controladores = "ffspEmpleados";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $empleados->getPermisosBorrar("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (!empty($resultPer)){	        
	        
	        if(isset($_POST["empl_id"])){
	            
	            $empl_id = (int)$_POST["empl_id"];
	            
	            try {
	                
    	            $empleados->beginTran();
    	             
    	            $resultado1  = $discapacidad->eliminarBy("empl_id ",$empl_id);
    	            $resultado  = $empleados->eliminarBy("empl_id ",$empl_id);
    	           
    	            
    	            $empleados->endTran('COMMIT');
    	            
    	            if( $resultado > 0 ){
    	                
    	                echo json_encode(array('data'=>$resultado));
    	                
    	            }
	            
	            } catch (Exception $e) {
	                
	                $empleados->endTran();
	                echo $e->getMessage();
	                die();
	                
	            }
	            
	            
	            
	            
	        }
	        
	        
	    }else{
	        
	        echo "Usuario no tiene permisos-Eliminar";
	    }
	    
	    
	    
	}
	
	
	public function consultaEmpleados(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $empleados = new ffspEmpleadosModel();
	    
	    $where_to="";
	    $columnas  = "ffsp_tbl_empleados.empl_id, 
                      ffsp_tbl_empleados.empl_primer_nombre, 
                      ffsp_tbl_empleados.empl_segundo_nombre, 
                      ffsp_tbl_empleados.empl_primer_apellido, 
                      ffsp_tbl_empleados.empl_segundo_apellido, 
                      ffsp_tbl_identidad_genero.ide_id, 
                      ffsp_tbl_identidad_genero.ide_nombre, 
                      ffsp_tbl_empleados.empl_dni, 
                      ffsp_tbl_empleados.empl_edad, 
                      ffsp_tbl_empleados.empl_grupo_sanguineo, 
                      ffsp_tbl_empleados.empl_fecha_ingreso, 
                      ffsp_tbl_empleados.empl_lugar_trabajo, 
                      ffsp_tbl_empleados.empl_area_trabajo, 
                      ffsp_tbl_empleados.empl_actividades_trabajo, 
                      ffsp_tbl_empresa.emp_id, 
                      ffsp_tbl_empresa.emp_nombre, 
                      ffsp_tbl_empresa.emp_ruc, 
                      ffsp_tbl_empresa.emp_ciudad, 
                      ffsp_tbl_orientacion_sexual.ori_id, 
                      ffsp_tbl_orientacion_sexual.ori_nombre, 
                      ffsp_tbl_religion.rel_id, 
                      ffsp_tbl_religion.rel_nombre, 
                      ffsp_tbl_sexo.sex_id, 
                      ffsp_tbl_sexo.sex_nombre";
	    
	    $tablas    = "public.ffsp_tbl_empleados, 
                      public.ffsp_tbl_identidad_genero, 
                      public.ffsp_tbl_empresa, 
                      public.ffsp_tbl_orientacion_sexual, 
                      public.ffsp_tbl_religion, 
                      public.ffsp_tbl_sexo";
                    	    
	    $where     = "ffsp_tbl_identidad_genero.ide_id = ffsp_tbl_empleados.ide_id AND
                      ffsp_tbl_empresa.emp_id = ffsp_tbl_empleados.emp_id AND
                      ffsp_tbl_orientacion_sexual.ori_id = ffsp_tbl_empleados.ori_id AND
                      ffsp_tbl_religion.rel_id = ffsp_tbl_empleados.rel_id AND
                      ffsp_tbl_sexo.sex_id = ffsp_tbl_empleados.sex_id";
	    
	    $id        = "ffsp_tbl_empleados.empl_primer_apellido";
	    
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';	    
	    
	    if($action == 'ajax')
	    {
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND empl_dni ILIKE '".$search."%'";
	            
	            $where_to=$where.$where1;
	            
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$empleados->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$empleados->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $total_pages = ceil($cantidadResult/$per_page);	        
	        
	        if($cantidadResult > 0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:400px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_empleados' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Primer Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Segundo Nombre</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Primer Apellido</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Segundo Apellido</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Identidad de Genero</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">DNI</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Edad</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Grupo Sanguineo</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Fecha de Ingreso</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Lugar de Trabajo</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Area de Trabajo</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Actividades Trabajo</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Empresa</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Orientacion Sexual</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Religion</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Sexo</th>';
	            
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
	                $html.='<td style="font-size: 14px;">'.$res->empl_primer_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_segundo_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_primer_apellido.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_segundo_apellido.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->ide_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_dni.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_edad.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_grupo_sanguineo.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_fecha_ingreso.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_lugar_trabajo.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_area_trabajo.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_actividades_trabajo.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->emp_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->ori_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->rel_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->sex_nombre.'</td>';
	                
	                
	               
	                /*comentario up */
	                
                    $html.='<td style="font-size: 18px;">
                            <a onclick="editEmpleados('.$res->empl_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 18px;">
                            <a onclick="delEmpleados('.$res->empl_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
	                    
	               
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaEmpleados").'';
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
	
	public function cargaIdentidadGenero(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	    
	    $query = " SELECT ide_id, ide_nombre FROM ffsp_tbl_identidad_genero WHERE 1=1 ORDER BY ide_nombre";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}

	
	public function cargaEmpresa(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	    
	    $query = " SELECT emp_id, emp_nombre FROM ffsp_tbl_empresa WHERE 1=1 ORDER BY emp_nombre";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	
	public function  cargaTipoFicha(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	    
	    $query = " SELECT tip_id, tip_nombre FROM ffsp_tbl_tipo_ficha WHERE 1=1 ORDER BY tip_id";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	public function cargaOrientacionSexual(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	    
	    $query = " SELECT ori_id, ori_nombre FROM ffsp_tbl_orientacion_sexual WHERE 1=1 ORDER BY ori_nombre";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	public function cargaReligion(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	    
	    $query = " SELECT rel_id, rel_nombre FROM ffsp_tbl_religion WHERE 1=1 ORDER BY rel_nombre";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	public function cargaSexo(){
	    
	    $empleados = null;
	    $empleados = new ffspEmpleadosModel();
	    
	    $query = " SELECT sex_id, sex_nombre FROM ffsp_tbl_sexo WHERE 1=1 ORDER BY sex_nombre";
	    
	    $resulset = $empleados->enviaquery($query);
	    
	    if(!empty($resulset) && count($resulset)>0){
	        
	        echo json_encode(array('data'=>$resulset));
	        
	    }
	}
	
	
	
	public function index2(){
	    
	    $empleados = new ffspEmpleadosModel();
	    
	    session_start();
	    
	    if(empty( $_SESSION)){
	        
	        $this->redirect("ffspUsuarios","sesion_caducada");
	        return;
	    }
	    
	    $nombre_controladores = "ffspEmpleados";
	    $id_rol= $_SESSION['id_rol'];
	    $resultPer = $empleados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	    
	    if (empty($resultPer)){
	        
	        $this->view("Error",array(
	            "resultado"=>"No tiene Permisos de Acceso Empleados"
	            
	        ));
	        exit();
	    }
	    
	    //	$rsEmpleados = $empleados->getBy(" 1 = 1 ");
	    
	    
	    $this->view("ffsp_consulta_empleados",array(
	        "resultSet"=>""
	        
	    ));
	    
	    
	}
	
	public function IniciarFicha(){
	    
	    
	    session_start();
	    
	    $empleados = new ffspEmpleadosModel();
	    
	    
	    $_empl_id = (isset($_POST["empl_id"])) ? $_POST["empl_id"] : 0 ;
	    $_emp_id = (isset($_POST["emp_id"])) ? $_POST["emp_id"] : 0 ;
	    $_tip_id = (isset($_POST["tip_id"])) ? $_POST["tip_id"] : 0 ;
	    
	    date_default_timezone_set('America/Guayaquil');
	    $fechaActual = date('d-m-Y H:i:s');
	    
	    
	    if(!isset($_SESSION['id_usuarios'])){
	        echo 'Sessión Caducada.';
	        exit();
	    }
	    
	    if($_empl_id==0){
	        echo 'Seleccione Empleado';
	        exit();
	    }
	    
	    if($_emp_id==0){
	        echo 'Seleccione Empresa';
	        exit();
	    }
	    
	    if($_tip_id==0){
	        echo 'Seleccione Tipo Ficha';
	        exit();
	    }
	    
	    
	    $query = " SELECT b.tip_nombre FROM ffsp_tbl_ficha a, ffsp_tbl_tipo_ficha b WHERE a.tip_id=b.tip_id and a.empl_id='$_empl_id' and a.tip_id='$_tip_id'";
	    $resulset = $empleados->enviaquery($query);
	    
	    
	    if(!empty($resulset)){
	        
	        $nombre=$resulset[0]->tip_nombre;
	        $mensaje='Empleado ya tiene registrada una ficha de '.$nombre;
	        echo json_encode(array('valor' => 0, 'mensaje'=>$mensaje));
	        exit();
	        
	    }else{
	        
	        $_id_usuarios=$_SESSION['id_usuarios'];
	        
	        $funcion = "ins_ffsp_tbl_ficha";
	        $mensaje = "Ficha Iniciada Correctamente.";
	        
	        $parametros =  "'$_empl_id',
                                '$_tip_id',
                                '$_emp_id',
                                '$fechaActual',
                                '$_id_usuarios'";
	        $empleados->setFuncion($funcion);
	        $empleados->setParametros($parametros);
	        $resultado = $empleados->llamafuncionPG();
	        
	        if(is_int((int)$resultado[0])){
	            
	            echo json_encode(array('valor' => $resultado[0], 'mensaje'=>$mensaje, 'tipo'=>$_tip_id));
	            return;
	            
	            
	        }else{
	            
	            echo "Error al Ingresar Ficha";
	            exit();
	        }
	        
	        
	    }
	    
	    
	    
	}
	
	public function search(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $empleados = new ffspEmpleadosModel();
	    
	    $where_to="";
	    $columnas  = "ffsp_tbl_empleados.empl_id,
                      ffsp_tbl_empleados.empl_primer_nombre,
                      ffsp_tbl_empleados.empl_segundo_nombre,
                      ffsp_tbl_empleados.empl_primer_apellido,
                      ffsp_tbl_empleados.empl_segundo_apellido,
                      ffsp_tbl_identidad_genero.ide_id,
                      ffsp_tbl_identidad_genero.ide_nombre,
                      ffsp_tbl_empleados.empl_dni,
                      ffsp_tbl_empleados.empl_edad,
                      ffsp_tbl_empleados.empl_grupo_sanguineo,
                      ffsp_tbl_empleados.empl_fecha_ingreso,
                      ffsp_tbl_empleados.empl_lugar_trabajo,
                      ffsp_tbl_empleados.empl_area_trabajo,
                      ffsp_tbl_empleados.empl_actividades_trabajo,
                      ffsp_tbl_discapacidad.dis_id,
                      ffsp_tbl_discapacidad.dis_nombre,
                      ffsp_tbl_discapacidad.dis_tiene,
                      ffsp_tbl_discapacidad.dis_porcentaje,
                      ffsp_tbl_empresa.emp_id,
                      ffsp_tbl_empresa.emp_nombre,
                      ffsp_tbl_empresa.emp_ruc,
                      ffsp_tbl_empresa.emp_ciudad,
                      ffsp_tbl_orientacion_sexual.ori_id,
                      ffsp_tbl_orientacion_sexual.ori_nombre,
                      ffsp_tbl_religion.rel_id,
                      ffsp_tbl_religion.rel_nombre,
                      ffsp_tbl_sexo.sex_id,
                      ffsp_tbl_sexo.sex_nombre";
	    
	    $tablas    = "public.ffsp_tbl_empleados,
                      public.ffsp_tbl_identidad_genero,
                      public.ffsp_tbl_discapacidad,
                      public.ffsp_tbl_empresa,
                      public.ffsp_tbl_orientacion_sexual,
                      public.ffsp_tbl_religion,
                      public.ffsp_tbl_sexo";
	    
	    $where     = "ffsp_tbl_identidad_genero.ide_id = ffsp_tbl_empleados.ide_id AND
                      ffsp_tbl_discapacidad.empl_id = ffsp_tbl_empleados.empl_id AND
                      ffsp_tbl_empresa.emp_id = ffsp_tbl_empleados.emp_id AND
                      ffsp_tbl_orientacion_sexual.ori_id = ffsp_tbl_empleados.ori_id AND
                      ffsp_tbl_religion.rel_id = ffsp_tbl_empleados.rel_id AND
                      ffsp_tbl_sexo.sex_id = ffsp_tbl_empleados.sex_id";
	    
	    $id        = "ffsp_tbl_empleados.empl_primer_apellido";
	    
	    
	    $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
	    $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
	    
	    if($action == 'ajax')
	    {
	        
	        
	        if(!empty($search)){
	            
	            
	            $where1=" AND empl_dni ILIKE '".$search."%'";
	            
	            $where_to=$where.$where1;
	            
	        }else{
	            
	            $where_to=$where;
	            
	        }
	        
	        $html="";
	        $resultSet=$empleados->getCantidad("*", $tablas, $where_to);
	        $cantidadResult=(int)$resultSet[0]->total;
	        
	        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	        
	        $per_page = 10; //la cantidad de registros que desea mostrar
	        $adjacents  = 9; //brecha entre páginas después de varios adyacentes
	        $offset = ($page - 1) * $per_page;
	        
	        $limit = " LIMIT   '$per_page' OFFSET '$offset'";
	        
	        $resultSet=$empleados->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	        $total_pages = ceil($cantidadResult/$per_page);
	        
	        if($cantidadResult > 0)
	        {
	            
	            $html.='<div class="pull-left" style="margin-left:15px;">';
	            $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	            $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	            $html.='</div>';
	            $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
	            $html.='<section style="height:400px; overflow-y:scroll;">';
	            $html.= "<table id='tabla_empleados' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
	            $html.= "<thead>";
	            $html.= "<tr>";
	            $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Dni</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Empleado</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Empresa</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Fecha de Ingreso</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Lugar de Trabajo</th>';
	            $html.='<th style="text-align: left;  font-size: 15px;">Area de Trabajo</th>';
	            
	            
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
	                $html.='<td style="font-size: 14px;">'.$res->empl_dni.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_primer_apellido.' '.$res->empl_segundo_apellido.' '.$res->empl_primer_nombre.' '.$res->empl_segundo_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->emp_nombre.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_fecha_ingreso.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_lugar_trabajo.'</td>';
	                $html.='<td style="font-size: 14px;">'.$res->empl_area_trabajo.'</td>';
	                
	                /*comentario up */
	                
	                $html.='<td style="font-size: 15px;"><span class="pull-right"><button id="btn_abrir" class="btn btn-success" type="button" data-toggle="modal" data-target="#mod_ficha" data-id="'.$res->empl_id.'" data-cedu="'.$res->empl_dni.'" data-nombre="'.$res->empl_primer_apellido.' '.$res->empl_segundo_apellido.' '.$res->empl_primer_nombre.' '.$res->empl_segundo_nombre.'"  title="Ingresar Ficha" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></button></span></td>';
	                
	                
	                $html.='</tr>';
	            }
	            
	            
	            
	            $html.='</tbody>';
	            $html.='</table>';
	            $html.='</section></div>';
	            $html.='<div class="table-pagination pull-right">';
	            $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaEmpleados").'';
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
	
	
	
	
}
?>