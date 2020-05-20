<?php

class DiscapacidadController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    public function index(){
        
        $discapacidad = new DiscapacidadModel();
        
        session_start();
        
        if(empty( $_SESSION)){
            
            $this->redirect("Usuarios","sesion_caducada");
            return;
        }
        
        $nombre_controladores = "Discapacidad";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $discapacidad->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (empty($resultPer)){
            
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Acceso Discapacidad"
                
            ));
            exit();
        }
        
        $rsDiscapacidad = $discapacidad->getBy(" 1 = 1 ");
        
        
        $this->view("Discapacidad",array(
            "resultSet"=>$rsDiscapacidad
            
        ));
        
        
    }
    

    
    public function InsertaDiscapacidad(){
        
        session_start();
        
        $discapacidad = new DiscapacidadModel();
        
        $nombre_controladores = "Discapacidad";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $discapacidad->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            $_dis_descripcion = (isset($_POST["dis_descripcion"])) ? $_POST["dis_descripcion"] : "";
            $_dis_tipo = (isset($_POST["dis_tipo"])) ? $_POST["dis_tipo"] : "";
            $_dis_porcentaje = (isset($_POST["dis_porcentaje"])) ? $_POST["dis_porcentaje"] : "";
            $_dis_id = (isset($_POST["dis_id"])) ? $_POST["dis_id"] : 0 ;
            
            $funcion = "ins_ffsp_tbl_discapacidad";
            $respuesta = 0 ;
            $mensaje = "";
            
            if($_dis_id == 0){
                
                $parametros = " '$_dis_descripcion','$_dis_tipo','$_dis_porcentaje','$_dis_id'";
                $discapacidad->setFuncion($funcion);
                $discapacidad->setParametros($parametros);
                $resultado = $discapacidad->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Discapacidad Ingresada Correctamente";
                }
                
                
            }elseif ($_dis_id > 0){
                
                $parametros = " '$_dis_descripcion','$_dis_tipo','$_dis_porcentaje','$_dis_id'";
                $discapacidad->setFuncion($funcion);
                $discapacidad->setParametros($parametros);
                $resultado = $discapacidad->llamafuncionPG();
                
                if(is_int((int)$resultado[0])){
                    $respuesta = $resultado[0];
                    $mensaje = "Discapacidad Actualizada Correctamente";
                }
                
                
            }
            
            
            
            if((int)$respuesta > 0 ){
                
                echo json_encode(array('respuesta'=>$respuesta,'mensaje'=>$mensaje));
                exit();
            }
            
            echo "Error al Ingresar Discapacidad";
            exit();
            
        }
        else
        {
            $this->view("Error",array(
                "resultado"=>"No tiene Permisos de Insertar Discapacidad"
                
            ));
        }
        
    }
    
  
    public function editDiscapacidad(){
        
        session_start();
        $discapacidad = new DiscapacidadModel();
        $nombre_controladores = "Discapacidad";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $discapacidad->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer))
        {
            
            
            if(isset($_POST["dis_id"])){
                
                $dis_id = (int)$_POST["dis_id"];
                
                $query = "SELECT * FROM ffsp_tbl_discapacidad WHERE dis_id = $dis_id";
                
                $resultado  = $discapacidad->enviaquery($query);
                
                echo json_encode(array('data'=>$resultado));
                
            }
            
            
        }
        else
        {
            echo "Usuario no tiene permisos-Editar";
        }
        
    }
    
    

    public function delDiscapacidad(){
        
        session_start();
        $discapacidad = new DiscapacidadModel();
        $nombre_controladores = "Discapacidad";
        $id_rol= $_SESSION['id_rol'];
        $resultPer = $discapacidad->getPermisosBorrar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        
        if (!empty($resultPer)){
            
            if(isset($_POST["dis_id"])){
                
                $dis_id= (int)$_POST["dis_id"];
                
                $resultado  = $discapacidad->eliminarBy("dis_id", $dis_id);
                
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
    
    
    public function consultaDiscapacidad(){
        
        session_start();
        $id_rol=$_SESSION["id_rol"];
        $discapacidad = new DiscapacidadModel();
        
        $where_to="";
     
        $columnas  = "dis_id, dis_descripcion, dis_tipo, dis_porcentaje";
        $tablas    = "public.ffsp_tbl_discapacidad";
        $where     = " 1 = 1";
        $id        = "ffsp_tbl_discapacidad.dis_descripcion";
        
        $action = (isset($_REQUEST['peticion'])&& $_REQUEST['peticion'] !=NULL)?$_REQUEST['peticion']:'';
        $search =  (isset($_REQUEST['search'])&& $_REQUEST['search'] !=NULL)?$_REQUEST['search']:'';
        
        if($action == 'ajax')
        {
            
            
            if(!empty($search)){
                
                
                $where1=" AND dis_descripcion ILIKE '".$search."%'";
                
                $where_to=$where.$where1;
                
            }else{
                
                $where_to=$where;
                
            }
            
            $html="";
            $resultSet=$discapacidad->getCantidad("*", $tablas, $where_to);
            $cantidadResult=(int)$resultSet[0]->total;
            
            $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
            
            $per_page = 10; //la cantidad de registros que desea mostrar
            $adjacents  = 9; //brecha entre páginas después de varios adyacentes
            $offset = ($page - 1) * $per_page;
            
            $limit = " LIMIT   '$per_page' OFFSET '$offset'";
            
            $resultSet=$discapacidad->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
            $total_pages = ceil($cantidadResult/$per_page);
            
            if($cantidadResult > 0)
            {
                
                $html.='<div class="pull-left" style="margin-left:15px;">';
                $html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
                $html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
                $html.='</div>';
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<section style="height:400px; overflow-y:scroll;">';
                $html.= "<table id='tabla_Discapacidad' class='tablesorter table table-striped table-bordered dt-responsive nowrap dataTables-example'>";
                $html.= "<thead>";
                $html.= "<tr>";
                $html.='<th style="text-align: left;  font-size: 15px;">#</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Discapacidad</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Tipo</th>';
                $html.='<th style="text-align: left;  font-size: 15px;">Porcentaje</th>';
                
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
                    $html.='<td style="font-size: 14px;">'.$res->dis_descripcion.'</td>';
                    $html.='<td style="font-size: 14px;">'.$res->dis_tipo.'</td>';
                    $html.='<td style="font-size: 14px;">'.$res->dis_porcentaje.'</td>';
                    
                    
                    /*comentario up */
                    
                    $html.='<td style="font-size: 18px;">
                            <a onclick="editDiscapacidad('.$res->dis_id.')" href="#" class="btn btn-warning" style="font-size:65%;"data-toggle="tooltip" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>';
                    $html.='<td style="font-size: 18px;">
                            <a onclick="delDiscapacidad('.$res->dis_id.')"   href="#" class="btn btn-danger" style="font-size:65%;"data-toggle="tooltip" title="Eliminar"><i class="glyphicon glyphicon-trash"></i></a></td>';
                    
                    
                    $html.='</tr>';
                }
                
                
                
                $html.='</tbody>';
                $html.='</table>';
                $html.='</section></div>';
                $html.='<div class="table-pagination pull-right">';
                $html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents,"consultaDiscapacidad").'';
                $html.='</div>';
                
                
                
            }else{
                $html.='<div class="col-lg-12 col-md-12 col-xs-12">';
                $html.='<div class="alert alert-warning alert-dismissable" style="margin-top:40px;">';
                $html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                $html.='<h4>Aviso!!!</h4> <b>Actualmente no hay Discapacidades registradas...</b>';
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
    
    
    public function ReporteFicha(){
        session_start();
       
        
        $ficha = new FichaModel();
        $fic_id =  (isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'';
        
        $datos_reporte = array();
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_empleados.empl_id, 
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
                      ffsp_tbl_discapacidad.dis_descripcion, 
                      ffsp_tbl_discapacidad.dis_tipo, 
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
                      ffsp_tbl_sexo.sex_nombre, 
                      ffsp_tbl_tipo_ficha.tip_id, 
                      ffsp_tbl_tipo_ficha.tip_nombre, 
                      ffsp_tbl_ficha_antecedentes.fic_id, 
                      ffsp_tbl_ficha_antecedentes.sex_id, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_menarquia, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_ciclos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_fecha_ultima_mestruacion, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_gestas, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_partos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_cesareas, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_abortos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_hijos_vivos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_hijos_muertos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_vida_sexual, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_metodo_planificacion_familiar, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_tipo_metodo_planificacion_familiar, 
                      ffsp_tbl_ficha_antecedentes_detalle.fic_ant_det_id, 
                      ffsp_tbl_ficha_antecedentes_detalle.fic_ant_det_realizado, 
                      ffsp_tbl_ficha_antecedentes_detalle.fic_ant_det_tiempo, 
                      ffsp_tbl_ficha_antecedentes_detalle.fic_ant_det_resultado";
        
        $tablas = "   public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_empleados, 
                      public.ffsp_tbl_tipo_ficha, 
                      public.usuarios, 
                      public.ffsp_tbl_identidad_genero, 
                      public.ffsp_tbl_discapacidad, 
                      public.ffsp_tbl_empresa, 
                      public.ffsp_tbl_orientacion_sexual, 
                      public.ffsp_tbl_religion, 
                      public.ffsp_tbl_sexo, 
                      public.ffsp_tbl_ficha_antecedentes, 
                      public.ffsp_tbl_ficha_antecedentes_detalle";
        $where= "     ffsp_tbl_empleados.empl_id = ffsp_tbl_ficha.empl_id AND
                      ffsp_tbl_tipo_ficha.tip_id = ffsp_tbl_ficha.tip_id AND
                      usuarios.id_usuarios = ffsp_tbl_ficha.usu_id AND
                      ffsp_tbl_identidad_genero.ide_id = ffsp_tbl_empleados.ide_id AND
                      ffsp_tbl_discapacidad.dis_id = ffsp_tbl_empleados.dis_id AND
                      ffsp_tbl_empresa.emp_id = ffsp_tbl_empleados.emp_id AND
                      ffsp_tbl_orientacion_sexual.ori_id = ffsp_tbl_empleados.ori_id AND
                      ffsp_tbl_religion.rel_id = ffsp_tbl_empleados.rel_id AND
                      ffsp_tbl_sexo.sex_id = ffsp_tbl_empleados.sex_id AND
                      ffsp_tbl_ficha_antecedentes.fic_id = ffsp_tbl_ficha.fic_id AND
                      ffsp_tbl_ficha_antecedentes_detalle.ante_id = ffsp_tbl_ficha_antecedentes.fic_ant_id AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $datos_reporte['FECHA_ACTUAL']=date('d-m-Y');
        $datos_reporte['NOMBRE_EMPRESA']=$rsdatos[0]->emp_nombre;
        $datos_reporte['RUC_EMPRESA']=$rsdatos[0]->emp_ruc;
        $datos_reporte['CIUDAD_EMPRESA']=$rsdatos[0]->emp_ciudad;
        $datos_reporte['PRI_APE_EMPLEADO']=$rsdatos[0]->empl_primer_apellido;
        $datos_reporte['SEG_APE_EMPLEADO']=$rsdatos[0]->empl_segundo_apellido;
        $datos_reporte['PRI_NOMBRE_EMPLEADO']=$rsdatos[0]->empl_primer_nombre;
        $datos_reporte['SEG_NOMBRE_EMPLEADO']=$rsdatos[0]->empl_segundo_nombre;
        $datos_reporte['SEXO_EMPLEADO']=$rsdatos[0]->sex_nombre;
        $datos_reporte['EDAD_EMPLEADO']=$rsdatos[0]->empl_edad;
        $datos_reporte['RELIGION_EMPLEADO']=$rsdatos[0]->rel_nombre;
        $datos_reporte['GRUPO_SANGUINEO_EMPLEADO']=$rsdatos[0]->empl_grupo_sanguineo;
        $datos_reporte['ORIENTACION_SEXUAL']=$rsdatos[0]->ori_nombre;
        $datos_reporte['IDENTIDAD_GENERO']=$rsdatos[0]->ide_nombre;
        $datos_reporte['DISCAPACIDAD_EMPLEADO']=$rsdatos[0]->dis_descripcion;
        $datos_reporte['FECHA_INGRESO']=$rsdatos[0]->empl_fecha_ingreso;
        $datos_reporte['PUESTO_TRABAJO']=$rsdatos[0]->empl_lugar_trabajo;
        $datos_reporte['AREA_TRABAJO']=$rsdatos[0]->empl_area_trabajo;
        $datos_reporte['ACTIVIDADES_TRABAJO']=$rsdatos[0]->empl_actividades_trabajo;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        $datos_reporte['DIRECCION_PARTICIPE']=$rsdatos[0]->direccion_participes;
        

        
        
        
        $this->verReporte("ReporteFicha1", array('datos_empresa'=>$datos_empresa, 'datos_cabecera'=>$datos_cabecera, 'datos_reporte'=>$datos_reporte ));
        
        
        
    }
    
    
    public function ReporteReintegro(){
        session_start();
        //$entidades = new EntidadesModel();
        //PARA OBTENER DATOS DE LA EMPRESA
        // $datos_empresa = array();
        // $rsdatosEmpresa = $entidades->getBy("id_entidades = 1");
        
        
        
        
        
        //$productos=new SaldoProductosModel();
        //$datos_reporte = array();
        
        
        
        // $html.='</table>';
        
        // $datos_reporte['DETALLE_PRODUCTOS']= $html;
        
        $this->verReporte("ReporteReintegro");
        
        
    }
    
    public function ReporteContinuidad(){
        session_start();
        //$entidades = new EntidadesModel();
        //PARA OBTENER DATOS DE LA EMPRESA
        // $datos_empresa = array();
        // $rsdatosEmpresa = $entidades->getBy("id_entidades = 1");
        
        
        
        
        
        //$productos=new SaldoProductosModel();
        //$datos_reporte = array();
        
        
        
        // $html.='</table>';
        
        // $datos_reporte['DETALLE_PRODUCTOS']= $html;
        
        $this->verReporte("ReporteContinuidad");
        
        
    }
    
    
    
}
?>