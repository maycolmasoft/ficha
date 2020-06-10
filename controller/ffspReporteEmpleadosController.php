<?php

class ffspReporteEmpleadosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
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
	    
	    
	    $this->view("ffsp_consulta_reporte_empleados",array(
	        "resultSet"=>""
	        
	    ));
	    
	    
	}
	

	public function search(){
	    
	    session_start();
	    $id_rol=$_SESSION["id_rol"];
	    
	    $empleados = new ffspEmpleadosModel();
	    
	    $where_to="";
	    $columnas  = "c.*, ffsp_tbl_empresa.*,
                    (select a.fic_id 
                    from ffsp_tbl_ficha a
                    inner join ffsp_tbl_tipo_ficha b on a.tip_id=b.tip_id
                    where b.tip_id=1 and c.empl_id=a.empl_id
                     ) as inicio,
                     (select a.fic_id 
                    from ffsp_tbl_ficha a
                    inner join ffsp_tbl_tipo_ficha b on a.tip_id=b.tip_id
                    where b.tip_id=2 and c.empl_id=a.empl_id
                     ) as continuidad,
                     (select a.fic_id 
                    from ffsp_tbl_ficha a
                    inner join ffsp_tbl_tipo_ficha b on a.tip_id=b.tip_id
                    where b.tip_id=3 and c.empl_id=a.empl_id
                     ) as reingreso
                    ";
	    
	    $tablas    = "public.ffsp_tbl_empleados c,
                      public.ffsp_tbl_identidad_genero,
                      public.ffsp_tbl_discapacidad,
                      public.ffsp_tbl_empresa,
                      public.ffsp_tbl_orientacion_sexual,
                      public.ffsp_tbl_religion,
                      public.ffsp_tbl_sexo";
	    
	    $where     = "ffsp_tbl_identidad_genero.ide_id = c.ide_id AND
                      ffsp_tbl_discapacidad.empl_id = c.empl_id AND
                      ffsp_tbl_empresa.emp_id = c.emp_id AND
                      ffsp_tbl_orientacion_sexual.ori_id = c.ori_id AND
                      ffsp_tbl_religion.rel_id = c.rel_id AND
                      ffsp_tbl_sexo.sex_id = c.sex_id";
	    
	    $id        = "c.empl_primer_apellido";
	    
	    
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
	            $html.='<th style="text-align: left;  font-size: 12px;">Dni</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Empleado</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Empresa</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Fecha de Ingreso</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Lugar de Trabajo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Area de Trabajo</th>';
	            $html.='<th style="text-align: left;  font-size: 12px;">Acciones</th>';
	            
	            $html.='</tr>';
	            $html.='</thead>';
	            $html.='<tbody>';
	            
	            $i=0;
	            
	            foreach ($resultSet as $res)
	            {
	                $i++;
	                $html.='<tr>';
	                
	                $html.='<td style="font-size: 11px;">'.$res->empl_dni.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->empl_primer_apellido.' '.$res->empl_segundo_apellido.' '.$res->empl_primer_nombre.' '.$res->empl_segundo_nombre.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->emp_nombre.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->empl_fecha_ingreso.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->empl_lugar_trabajo.'</td>';
	                $html.='<td style="font-size: 11px;">'.$res->empl_area_trabajo.'</td>';
	                
	                $html.='<td style="font-size: 14px;">';
	                
	                
	                $html.='<br><div class="btn-group">';
	                
	                if((int)$res->inicio > 0 ){
	                   
	                    $html.='<a target="_blank" href="index.php?controller=ReporteFicha&action=ReporteFicha&fic_id='.$res->inicio.'&sex_id='.$res->sex_id.'" title="Ficha Inicio"><img src="view/images/logo_pdf.png" width="31" height="25"></a>';
	                }else{
	                    $html.='<a href="javascript:void(0);" title="Ficha Inicio" disabled></a>';
	                    
	                }
	                
	                
	                if((int)$res->continuidad > 0 ){
	                    
	                    $html.='<a target="_blank" href="index.php?controller=ReporteFicha&action=ReporteContinuidad&fic_id='.$res->continuidad.'&sex_id='.$res->sex_id.'" title="Ficha Continuidad"><img src="view/images/logo_pdf.png" width="31" height="25"></a>';
	                    
	                 }else{
	                     $html.='<a href="javascript:void(0);" title="Ficha Continuidad" disabled></a>';
	                     
	                }
	                
	                if((int)$res->reingreso > 0 ){
	                    $html.='<a target="_blank" href="index.php?controller=ReporteFicha&action=ReporteReintegro&fic_id='.$res->reingreso.'&sex_id='.$res->sex_id.'" title="Ficha Reingreso"><img src="view/images/logo_pdf.png" width="31" height="25"></a>';
	                    
	                }else{
	                    $html.='<a href="javascript:void(0);" title="Ficha Reingreso" disabled></a>';
	                    
	                }
	                $html.='</div>';
	                
	                
	                
	                $html.='</td>';
	                
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
	
	
	
}
?>