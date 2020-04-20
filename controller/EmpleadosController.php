<?php
class EmpleadosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function dateDifference($date_1 , $date_2 , $differenceFormat = '%y Años, %m Meses, %d Dias' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        
        $interval = date_diff($datetime1, $datetime2);
        
        return $interval->format($differenceFormat);
        
    }
    
    
    public function dateDifference1($date_1 , $date_2 , $differenceFormat = '%m' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        
        $interval = date_diff($datetime1, $datetime2);
        
        return $interval->format($differenceFormat);
        
    }
    
    public function dateDifference2($date_1 , $date_2 , $differenceFormat = '%y' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        
        $interval = date_diff($datetime1, $datetime2);
        
        return $interval->format($differenceFormat);
        
    }
    
    
    public function cargar_ficha(){
        
        session_start();
        $empleados = new EmpleadosModel();
        
       
        
        $_id_empleados = (isset($_REQUEST['id_empleados'])&& $_REQUEST['id_empleados'] !=NULL)?$_REQUEST['id_empleados']:0;
        $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
        $html="";
        
        if($action == 'ajax')
        {
            
            if($_id_empleados > 0){
                
                
                $columnas = "empleados.id_empleados,
                                      empleados.identificacion_empleados,
                                      empleados.apellidos_empleados,
                                      empleados.nombres_empleados,
                                      empleados.fecha_nacimiento_empleados,
                                      sexo.id_sexo,
                                      sexo.nombre_sexo,
                                      empleados.fecha_empieza_a_laborar,
                                      empleados.salario_basico,
                                      empleados.creado";
                
                $tablas   = "public.empleados,
                                     public.sexo";
                
                $id       = "empleados.id_empleados";
                
                
                
                $where    = " sexo.id_sexo = empleados.id_sexo AND empleados.id_empleados = '$_id_empleados' ";
                $resultSet = $empleados->getCondiciones($columnas ,$tablas ,$where, $id);
                
                
                if(!empty($resultSet)){
                    
                    $cedula = $resultSet[0]->identificacion_empleados;
                    $apellidos = $resultSet[0]->apellidos_empleados;
                    $nombres = $resultSet[0]->nombres_empleados;
                    $fecha_nacimiento = $resultSet[0]->fecha_nacimiento_empleados;
                    $sexo = $resultSet[0]->nombre_sexo;
                    $fecha_labora = $resultSet[0]->fecha_empieza_a_laborar;
                    $anio_ini_labora = date("Y", strtotime($resultSet[0]->fecha_empieza_a_laborar));
                    $salario = $resultSet[0]->salario_basico;
                    
                    
                    
                    
                    $hoy=date("Y-m-d");
                    $anio_actual= date("Y");
                    
                    //edad
                    $edad=$this->dateDifference($fecha_nacimiento, $hoy);
                    // antiguedad
                    $antiguedad=$this->dateDifference($fecha_labora, $hoy);
                    //aporte al iess 
                    $aporte_iess= $salario * 0.203;
                    
                    //decimo tercero
                    $meses=0;
                    
                    if($anio_ini_labora == $anio_actual){
                        
                        $meses=$this->dateDifference1($fecha_labora, $hoy);
                        
                    }
                    
                    if($anio_ini_labora < $anio_actual){
                        
                        
                        $fecha_labora1=$anio_actual."-01-01";
                       
                        $meses=$this->dateDifference1($fecha_labora1, $hoy);
                        
                        $meses = $meses+1;
                        
                    }
                    
                    
                    $decimo_tercero = $salario * $meses;
                    $decimo_tercero = $decimo_tercero / 12;
                    $decimo_tercero = round($decimo_tercero,2);
                    
                    
                    
                    
                    
                    
                    
                    //decimo cuarto
                    
                    
                    $decimo_cuarto = 394.00;
                    
                    
                    
                    
                    // fondos reserva  sueldo * 8.33%
                    
                    $fondos=0;
                    $anios_servi=0;
                    $anios_servi=$this->dateDifference2($fecha_labora, $hoy);
                    
                    if($anios_servi > 0){
                        
                        $fondos = $salario * 0.0833;
                       
                        $fondos = round($fondos,2);
                        
                        
                    }else{
                        
                        $fondos=0.00;
                    }
                   
                    
                    
                    
                    $solicitud="bg-olive";
                    
                       $html='<div id="disponible_participe" class="small-box '.$solicitud.'">
                       <div class="inner">
                       <table width="100%">
                       <td>
                        <table>
                        <tr>
                        <td width="50%"><font size="3" id="nombre_participe_credito">Empleado : '.$apellidos.' '.$nombres.'&nbsp</font></td>
                        </tr>
                        <tr>
                        <td id="cedula_credito"><font size="3"> Cédula : '.$cedula.'</font></td>
                        </tr>
                        
                        <tr>
                        <td colspan="2"><font size="3">Fecha de nacimiento : '.$fecha_nacimiento.'</font></td>
                        </tr>
                        <tr>
                        <td colspan="2"><font size="3">Edad : '.$edad.'</font></td>
                        </tr>
                        <tr>
                        <td colspan="2"><font size="3">Antiguedad : '.$antiguedad.'</font></td>
                        </tr>
                        <tr>
                        <td colspan="2"><font size="3">Salario : $ '.number_format((float)$salario, 2, '.', ',').'</font></td>
                        </tr>
                        </table>
                        
                        <br>
                        <table>
                        <tr>
                        <td ><font size="3">Aporte IESS : $ '.number_format((float)$aporte_iess, 2, '.', ',').'</font></td>
                        </tr>
                        <tr>
                        <td ><font size="3">Décimo Tercero : $ '.number_format((float)$decimo_tercero, 2, '.', ',').'</font></td>
                        </tr>
                        <tr>
                        <td ><font size="3">Décimo Cuarto : $ '.number_format((float)$decimo_cuarto, 2, '.', ',').'</font></td>
                        </tr>
                        <tr>
                        <td ><font size="3">Fondo Reserva : $ '.number_format((float)$fondos, 2, '.', ',').'</font></td>
                        </tr>
                        </table>
                        
                        </tr>
                        </table>
                       </div>
                       </div>';
                    
                    
                    echo $html;
                    die();
                    
                    
                }
                
                
                
              
                
                
            }
            
          
            
        }
        
        
        
    }
    
    
    
    public function index10(){
    
    	session_start();
    	$id_rol=$_SESSION["id_rol"];
    	$empleados = new EmpleadosModel();
    	$where_to="";
    	
    	
    	$columnas = "empleados.id_empleados,
                                      empleados.identificacion_empleados,
                                      empleados.apellidos_empleados,
                                      empleados.nombres_empleados,
                                      empleados.fecha_nacimiento_empleados,
                                      sexo.id_sexo,
                                      sexo.nombre_sexo,
                                      empleados.fecha_empieza_a_laborar,
                                      empleados.salario_basico,
                                      empleados.creado";
    	
    	$tablas   = "public.empleados,
                                     public.sexo";
    	
    	$id       = "empleados.id_empleados";
    	
    	
    	$where    = " sexo.id_sexo = empleados.id_sexo";
    	
    	
					    	
    
    	 
    	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
    	$search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
    	 
    	 
    	 
    	 
    	if($action == 'ajax')
    	{
    
    		if(!empty($search)){
    
    
    			$where1=" AND (empleados.identificacion_empleados ILIKE '".$search."%' OR empleados.apellidos_empleados ILIKE '".$search."%' OR empleados.nombres_empleados ILIKE '".$search."%' OR sexo.nombre_sexo ILIKE '".$search."%')";
    
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
    		$count_query   = $cantidadResult;
    		$total_pages = ceil($cantidadResult/$per_page);
    
    		 
    
    
    
    		if($cantidadResult>0)
    		{
    
    			$html.='<div class="pull-left" style="margin-left:11px;">';
    			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
    			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
    			$html.='</div>';
    			$html.='<div class="col-lg-12 col-md-12 col-xs-12">';
    			$html.='<section style="height:400px; overflow-y:scroll;">';
    			$html.= "<table id='tabla_empleados' class='tablesorter table table-striped table-bordered dt-responsive nowrap'>";
    			$html.= "<thead>";
    			$html.= "<tr>";
    			$html.='<th style="text-align: left;  font-size: 12px;">Cedula</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Apellidos y Nombres</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Nacimiento</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Género</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Fecha Empieza Labores</th>';
    			$html.='<th style="text-align: left;  font-size: 12px;">Salario</th>';
    			
    			
    			if($id_rol==1){
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			}else{
    				 
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    				$html.='<th style="text-align: left;  font-size: 12px;"></th>';
    			}
    
    			$html.='</tr>';
    			$html.='</thead>';
    			$html.='<tbody>';
    			 
    			$i=0;
    
    
    
    			foreach ($resultSet as $res)
    			{
    				$i++;
    				$html.='<tr>';
    				$html.='<td style="font-size: 11px;">'.$res->identificacion_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->apellidos_empleados.' '.$res->nombres_empleados.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->fecha_nacimiento_empleados)).'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->nombre_sexo.'</td>';
    				$html.='<td style="font-size: 11px;">'.date("d/m/Y", strtotime($res->fecha_empieza_a_laborar)).'</td>';
    				$html.='<td style="font-size: 11px;">'.$res->salario_basico.'</td>';
    				
    				
    				if($id_rol==1){
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=borrarId&id_empleados='.$res->id_empleados.'" class="btn btn-danger" title="Eliminar" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a></span></td>';
    					$html.='<td style="font-size: 15px;"><span class="pull-right"><button id="btn_abrir" class="btn btn-info" type="button" data-toggle="modal" data-target="#mod_calcular" data-id="'.$res->id_empleados.'"   title="Ficha" style="font-size:75%;"><i class="glyphicon glyphicon-print"></i></button></span></td>';
    					
    					 
    				}else{
    					 
    					$html.='<td style="font-size: 18px;"><span class="pull-right"><a href="index.php?controller=Empleados&action=index&id_empleados='.$res->id_empleados.'" class="btn btn-success" title="Editar" style="font-size:65%;"><i class="glyphicon glyphicon-edit"></i></a></span></td>';
    					$html.='<td style="font-size: 15px;"><span class="pull-right"><button id="btn_abrir" class="btn btn-info" type="button" data-toggle="modal" data-target="#mod_calcular" data-id="'.$res->id_empleados.'"   title="Ficha" style="font-size:75%;"><i class="glyphicon glyphicon-print"></i></button></span></td>';
    					
    				}
    				 
    				$html.='</tr>';
    			}
    
    
    			$html.='</tbody>';
    			$html.='</table>';
    			$html.='</section></div>';
    			$html.='<div class="table-pagination pull-right">';
    			$html.=''. $this->paginate_empleados_activos("index.php", $page, $total_pages, $adjacents).'';
    			$html.='</div>';
    
    
    			 
    		}else{
    			$html.='<div class="col-lg-6 col-md-6 col-xs-12">';
    			$html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
    			$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    			$html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados activos registrados...</b>';
    			$html.='</div>';
    			$html.='</div>';
    		}
    		 
    		 
    		echo $html;
    		die();
    
    	}
    
    
    }
    
    
    
    
      
		public function index(){
	
		session_start();
		if (isset(  $_SESSION['id_usuarios']) )
		{
			
			$empleados = new EmpleadosModel();
				
			
			$sexo = new SexoModel();
			$resultSexo=$sexo->getAll("nombre_sexo");
			
				
			
			$nombre_controladores = "Empleados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $empleados->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$resultEdit = "";
			
					if (isset ($_GET["id_empleados"])   )
					{
						$_id_empleados = $_GET["id_empleados"];
						
						$columnas = "empleados.id_empleados, 
                                      empleados.identificacion_empleados, 
                                      empleados.apellidos_empleados, 
                                      empleados.nombres_empleados, 
                                      empleados.fecha_nacimiento_empleados, 
                                      sexo.id_sexo, 
                                      sexo.nombre_sexo, 
                                      empleados.fecha_empieza_a_laborar, 
                                      empleados.salario_basico, 
                                      empleados.creado";
						
						$tablas   = "public.empleados, 
                                     public.sexo";
						
						$id       = "empleados.id_empleados";
						
						
						$where    = " sexo.id_sexo = empleados.id_sexo AND empleados.id_empleados = '$_id_empleados' "; 
						$resultEdit = $empleados->getCondiciones($columnas ,$tablas ,$where, $id); 
					}
			
					
					$this->view("Empleados",array(
							"resultEdit" =>$resultEdit, 
							"resultSexo"=>$resultSexo
					
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Empleados"
			
				));
			
			}
			
		
		}
		else{
       	
       	$this->redirect("Usuarios","sesion_caducada");
       	
       }
		
	}
	
	
	
	
	
	
	
	
	public function InsertaEmpleados(){
			
		session_start();
		
		if (isset(  $_SESSION['nombre_usuarios']) )
		{
			$empleados=new EmpleadosModel();
			
		if (isset ($_POST["identificacion_empleados"]))
		{
		
			$_identificacion_empleados  = $_POST["identificacion_empleados"];
			$_apellidos_empleados       = $_POST["apellidos_empleados"];
			$_nombres_empleados         = $_POST["nombres_empleados"];
			$_fecha_nacimiento_empleados   = $_POST["fecha_nacimiento_empleados"];
		    $_id_empleados              = $_POST["id_empleados"];
		    $_id_sexo  					= $_POST["id_sexo"];
		    
		    $_fecha_empieza_a_laborar   = $_POST["fecha_empieza_a_laborar"];
		    $_salario_basico   = $_POST["salario_basico"];
		    
		    
		    if($_id_empleados > 0){
		    	
		    		
		    		$colval = "identificacion_empleados= '$_identificacion_empleados',
		    		apellidos_empleados = '$_apellidos_empleados',
		    		nombres_empleados = '$_nombres_empleados',
		    		fecha_nacimiento_empleados = '$_fecha_nacimiento_empleados',
		    		id_sexo='$_id_sexo',
		    		fecha_empieza_a_laborar='$_fecha_empieza_a_laborar',
                    salario_basico='$_salario_basico'";
		    		$tabla = "empleados";
		    		$where = "id_empleados = '$_id_empleados'";
		    		$resultado=$empleados->UpdateBy($colval, $tabla, $where);
		    		 
		    		
		    	
		    }else{
		    	
		     	
		        	$funcion = "ins_empleados";
		        	$parametros = "
		        	'$_identificacion_empleados',
		        	'$_apellidos_empleados',
		        	'$_nombres_empleados',
		        	'$_fecha_nacimiento_empleados',
		        	'$_id_sexo',
		        	'$_fecha_empieza_a_laborar',
		        	'$_salario_basico'";
		        	$empleados->setFuncion($funcion);
		        	$empleados->setParametros($parametros);
		        	$resultado=$empleados->Insert();
		        
		  }
		  
		   
		    $this->redirect("Empleados", "index");
		}
		
	   }else{
	   	
	   	$error = TRUE;
	   	$mensaje = "Te sesión a caducado, vuelve a iniciar sesión.";
	   		
	   	$this->view("Login",array(
	   			"resultSet"=>"$mensaje", "error"=>$error
	   	));
	   		
	   		
	   	die();
	   	
	   }
	}
	
	
	


	public function AutocompleteCedula(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$empleados = new EmpleadosModel();
		$identificacion_empleados = $_GET['term'];
			
		$resultSet=$empleados->getBy("identificacion_empleados LIKE '$identificacion_empleados%'");
			
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
					
				$_identificacion_empleados[] = $res->identificacion_empleados;
			}
			echo json_encode($_identificacion_empleados);
		}
			
	}
	
	
	
	
	
	public function AutocompleteDevuelveNombres(){
			
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$empleados = new EmpleadosModel();
			
		$identificacion_empleados = $_POST['identificacion_empleados'];
		$resultSet=$empleados->getBy("identificacion_empleados = '$identificacion_empleados'");
			
		$respuesta = new stdClass();
			
		if(!empty($resultSet)){
	
			$respuesta->id_empleados = $resultSet[0]->id_empleados;
			$respuesta->identificacion_empleados = $resultSet[0]->identificacion_empleados;
			$respuesta->apellidos_empleados = $resultSet[0]->apellidos_empleados;
			$respuesta->nombres_empleados = $resultSet[0]->nombres_empleados;
			
			$respuesta->fecha_nacimiento_empleados = $resultSet[0]->fecha_nacimiento_empleados;
			$respuesta->id_sexo = $resultSet[0]->id_sexo;
			$respuesta->fecha_empieza_a_laborar = $resultSet[0]->fecha_empieza_a_laborar;
			$respuesta->salario_basico = $resultSet[0]->salario_basico;
			
			
			echo json_encode($respuesta);
		}
			
	}
	
	
	
	
	
	public function borrarId()
	{
		if(isset($_GET["id_empleados"]))
		{
			$id_empleados=(int)$_GET["id_empleados"];
			$empleados= new EmpleadosModel();
			
			$empleados->deleteBy("id_empleados", $id_empleados);
			//$empleados->UpdateBy("id_estado=2","empleados","id_empleados='$id_empleados'");
				
		}
	
		$this->redirect("Empleados", "index");
	}
	
	
	
	
	public function paginate_empleados_activos($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_activos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_activos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_empleados_activos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_empleados_activos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
	
	
	

	
	
	
	
	
	
	

	
	
	
	
	
	
	
}
?>
