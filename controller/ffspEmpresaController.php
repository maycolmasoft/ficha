<?php

class ffspEmpresaController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $empresa = new ffspEmpresaModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("Usuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "ffspEmpresa";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $empresa->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Empresa"
                
            ));
            exit();
        }
        
        $rsEmpresa = $empresa->getBy(" 1 = 1 ");
        
        
        $this->view("ffspEmpresa",array(
            "resultSet"=>$rsEmpresa
            
        ));
        
        
    }
    

    
    public function InsertaEmpresa(){
        
        session_start();
        
        $empresa = new ffspEmpresaModel();
        
        $nombre_controladores = "ffspEmpresa";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $empresa->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            $_emp_nombre = (isset($_POST["emp_nombre"])) ? $_POST["emp_nombre"] : "";
            $_emp_ruc = (isset($_POST["emp_ruc"])) ? $_POST["emp_ruc"] : "";
            $_emp_ciudad = (isset($_POST["emp_ciudad"])) ? $_POST["emp_ciudad"] : "";
            $_emp_id = (isset($_POST["emp_id"])) ? $_POST["emp_id"] : 0 ;
            
            $funcion = "ins_ffsp_tbl_empresa";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_emp_id == 0){
                
                $parametros = " '$_emp_nombre','$_emp_ruc','$_emp_ciudad','$_emp_id'";
                $empresa->setFuncion($funcion);
                $empresa->setParametros($parametros);
                $resultado = $empresa->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Empresa Ingresado Correctamente";
                }
                
                
            }elseif ($_emp_id > 0){
                
                $parametros = " '$_emp_nombre','$_emp_ruc','$_emp_ciudad','$_emp_id'";
                $empresa->setFuncion($funcion);
                $empresa->setParametros($parametros);
                $resultado = $empresa->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Empresa Actualizado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Empresa";
            exit();
            
        }
        else
        {
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Insertar Empresa"
                
            ));
        }
        
    }
    
  
    public function editEmpresa(){
        
        session_start();
        $empresa = new ffspEmpresaModel();
        $nombre_controladores = "ffspEmpresa";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $empresa->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer))
        {
            
            
            if(isset($_POST["emp_id"])){
                
                $emp_id = (int)$_POST["emp_id"];
                
                $query = "SELECT * FROM ffsp_tbl_empresa WHERE emp_id = $emp_id";
                
                $resultado  = $empresa->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
            
        }
        else
        {
            echo "Usuario no tiene permisos-Editar";
        }
        
    }
    
    

    public function delEmpresa(){
        
        session_start();
        $empresa = new ffspEmpresaModel();
        $nombre_controladores = "ffspEmpresa";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $empresa->getPermisosBorrar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            if(isset($_POST["emp_id"])){
                
                $emp_id = (int)$_POST["emp_id"];
                
                $resultado  = $empresa->eliminarBy("emp_id", $emp_id);
                
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
    
    
    public function consultaEmpresa(){
        
        session_start();
        $id_rol=$_SESSION["id_rol"];
        $empresa = new ffspEmpresaModel();
        
        $where_to="";
     
        $columnas  = "emp_id, emp_nombre, emp_ruc, emp_ciudad";
        $tablas    = "public.ffsp_tbl_empresa";
        $where     = " 1 = 1";
        $id        = "ffsp_tbl_empresa.emp_nombre";
        
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        if($action == 'ajax')
        {
            
            
            if(!empty($search)){
                
                
                $where1=" AND emp_nombre ILIKE '".$search."%'";
                
                $where_to=$where.$where1;
                
            }else{
                
                $where_to=$where;
                
            }
            
            $html="";
            $resultSet=$empresa->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 10; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$empresa->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
                $html.='<div class="pull-left" style="margin-left:15px;">';
                $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                $html.='</div>';
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:400px; overflow-y:scroll;">';
                $html.= "<table id='tabla_empresa' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Nombre</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Ruc</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Cuidad</th>';
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
                    $html.='<td style="font-size: 14px;">'.$res->emp_nombre.'</td>';
                    $html.='<td style="font-size: 14px;">'.$res->emp_ruc.'</td>';
                    $html.='<td style="font-size: 14px;">'.$res->emp_ciudad.'</td>';
                    
                    $html.='<td style="font-size: 18px;">
                            <a onclick="editEmpresa('.$res->emp_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 18px;">
                            <a onclick="delEmpresa('.$res->emp_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaEmpresa").'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay empleados registrados...</b>';
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