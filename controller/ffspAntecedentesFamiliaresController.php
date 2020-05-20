<?php

class ffspAntecedentesFamiliaresController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $antecedentes_familiares = new ffspAntecedentesFamiliaresModel();
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("ffspUsuarios","sesion_caducada");
            return;
        }
        $nombre_controladores = "ffspAntecedentesFamiliares";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $antecedentes_familiares->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Antecedentes Familiares"
                
            ));
            exit();
        }
        
        $rsAntecedentesFamiliares = $antecedentes_familiares->getBy(" 1 = 1 ");
        
        
        $this->view("ffspAntecedentesFamiliares",array(
            "resultSet"=>$rsAntecedentesFamiliares
            
        ));
        
        
    }
    

    
    public function InsertaAntecedentesFamiliares(){
        
        session_start();
        
        $antecedentes_familiares = new ffspAntecedentesFamiliaresModel();
        
        $nombre_controladores = "ffspAntecedentesFamiliares";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $antecedentes_familiares->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            $_ant_nombre = (isset($_POST["ant_nombre"])) ? $_POST["ant_nombre"] : "";
            $_ant_id = (isset($_POST["ant_id"])) ? $_POST["ant_id"] : 0 ;
            
            $funcion = "ins_ffsp_tbl_antecedentes_familiares";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_ant_id == 0){
                
                $parametros = " '$_ant_nombre','$_ant_id'";
                $antecedentes_familiares->setFuncion($funcion);
                $antecedentes_familiares->setParametros($parametros);
                $resultado = $antecedentes_familiares->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Antecedentes Familiares Ingresado Correctamente";
                }
                
                
            }elseif ($_ant_id > 0){
                
                $parametros = " '$_ant_nombre','$_ant_id'";
                $antecedentes_familiares->setFuncion($funcion);
                $antecedentes_familiares->setParametros($parametros);
                $resultado = $antecedentes_familiares->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Antecedentes Familiares Actualizado Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Antecedentes Familiares";
            exit();
            
        }
        else
        {
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Insertar Antecedentes Familiares"
                
            ));
        }
        
    }
    
  
    public function editAntecedentesFamiliares(){
        
        session_start();
        $antecedentes_familiares = new ffspAntecedentesFamiliaresModel();
        $nombre_controladores = "ffspAntecedentesFamiliares";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $antecedentes_familiares->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer))
        {
            
            
            if(isset($_POST["ant_id"])){
                
                $ant_id = (int)$_POST["ant_id"];
                
                $query = "SELECT * FROM ffsp_tbl_antecedentes_familiares WHERE ant_id = $ant_id";
                
                $resultado  = $antecedentes_familiares->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
            
        }
        else
        {
            echo "Usuario no tiene permisos-Editar";
        }
        
    }
    
    

    public function delAntecedentesFamiliares(){
        
        session_start();
        $antecedentes_familiares = new ffspAntecedentesFamiliaresModel();
        $nombre_controladores = "ffspAntecedentesFamiliares";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $antecedentes_familiares->getPermisosBorrar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            if(isset($_POST["ant_id"])){
                
                $ant_id = (int)$_POST["ant_id"];
                
                $resultado  = $antecedentes_familiares->eliminarBy("ant_id", $ant_id);
                
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
    
    
    public function consultaAntecedentesFamiliares(){
        
        session_start();
        $id_rol=$_SESSION["id_rol"];
        $antecedentes_familiares = new ffspAntecedentesFamiliaresModel();
        
        $where_to="";
     
        $columnas  = "ant_id, ant_nombre";
        $tablas    = "public.ffsp_tbl_antecedentes_familiares";
        $where     = " 1 = 1";
        $id        = "ffsp_tbl_antecedentes_familiares.ant_nombre";
        
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        if($action == 'ajax')
        {
            
            
            if(!empty($search)){
                
                
                $where1=" AND ant_nombre ILIKE '".$search."%'";
                
                $where_to=$where.$where1;
                
            }else{
                
                $where_to=$where;
                
            }
            
            $html="";
            $resultSet=$antecedentes_familiares->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 10; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$antecedentes_familiares->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
                $html.='<div class="pull-left" style="margin-left:15px;">';
                $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                $html.='</div>';
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:400px; overflow-y:scroll;">';
                $html.= "<table id='tabla_antecedentes_familiares' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Nombre</th>';
                
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
                    $html.='<td style="font-size: 14px;">'.$res->ant_nombre.'</td>';
                    
                    
                    /*comentario up */
                    
                    $html.='<td style="font-size: 18px;">
                            <a onclick="editAntecedentesFamiliares('.$res->ant_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 18px;">
                            <a onclick="delAntecedentesFamiliares('.$res->ant_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaAntecedentesFamiliares").'';
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