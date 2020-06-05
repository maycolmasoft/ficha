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
            $adjacents  = 9; //brecha entre p�ginas despu�s de varios adyacentes
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
        
        $columnas = "   ffsp_tbl_ficha.empl_id, 
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
                        ffsp_tbl_orientacion_sexual.ori_id, 
                        ffsp_tbl_orientacion_sexual.ori_nombre, 
                        ffsp_tbl_religion.rel_id, 
                        ffsp_tbl_religion.rel_nombre, 
                        ffsp_tbl_sexo.sex_id, 
                        ffsp_tbl_sexo.sex_nombre, 
                        ffsp_tbl_tipo_ficha.tip_id, 
                        ffsp_tbl_tipo_ficha.tip_nombre, 
                        ffsp_tbl_empresa.emp_id, 
                        ffsp_tbl_empresa.emp_nombre, 
                        ffsp_tbl_empresa.emp_ruc, 
                        ffsp_tbl_empresa.emp_ciudad, 
                        ffsp_tbl_ficha.fic_fecha_registro, 
                        ffsp_tbl_ficha.fic_motivo_consulta, 
                        ffsp_tbl_ficha.fic_antecedentes_personales, 
                        ffsp_tbl_ficha.fic_id,
                        ffsp_tbl_ficha.fic_actividades_extra_laborales, 
                        ffsp_tbl_ficha.fic_enfermedad_actual,
                        ffsp_tbl_ficha.fic_motivo_consulta";
        
        $tablas = "   public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_empleados, 
                      public.ffsp_tbl_empresa, 
                      public.ffsp_tbl_tipo_ficha, 
                      public.ffsp_tbl_identidad_genero, 
                      public.ffsp_tbl_orientacion_sexual, 
                      public.ffsp_tbl_religion, 
                      public.ffsp_tbl_sexo";
        $where= "     ffsp_tbl_empleados.empl_id = ffsp_tbl_ficha.empl_id AND
                      ffsp_tbl_empresa.emp_id = ffsp_tbl_ficha.emp_id AND
                      ffsp_tbl_tipo_ficha.tip_id = ffsp_tbl_ficha.tip_id AND
                      ffsp_tbl_identidad_genero.ide_id = ffsp_tbl_empleados.ide_id AND
                      ffsp_tbl_orientacion_sexual.ori_id = ffsp_tbl_empleados.ori_id AND
                      ffsp_tbl_religion.rel_id = ffsp_tbl_empleados.rel_id AND
                      ffsp_tbl_sexo.sex_id = ffsp_tbl_empleados.sex_id AND  ffsp_tbl_ficha.fic_id='$fic_id'";
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
        //$datos_reporte['DISCAPACIDAD_EMPLEADO']=$rsdatos[0]->dis_nombre;
        $datos_reporte['FECHA_INGRESO']=$rsdatos[0]->empl_fecha_ingreso;
        $datos_reporte['PUESTO_TRABAJO']=$rsdatos[0]->empl_lugar_trabajo;
        $datos_reporte['AREA_TRABAJO']=$rsdatos[0]->empl_area_trabajo;
        $datos_reporte['ACTIVIDADES_TRABAJO']=$rsdatos[0]->empl_actividades_trabajo;
        $datos_reporte['ACTIVIDADES_EXTRA']=$rsdatos[0]->fic_actividades_extra_laborales;
        $datos_reporte['EMFERMEDAD_ACTUAL']=$rsdatos[0]->fic_enfermedad_actual;
        $datos_reporte['MOTIVO_CONSULTA']=$rsdatos[0]->fic_motivo_consulta; 
        
       
        
        
       /* 
        $sex_id=(isset($_REQUEST['sex_id'])&& $_REQUEST['sex_id'] !=NULL)?$_REQUEST['sex_id']:'';
        $fic_id=(isset($_REQUEST['fic_id'])&& $_REQUEST['fic_id'] !=NULL)?$_REQUEST['fic_id']:'';
        
        // traendo todos los examenes que existen
        $columnas="a.*";
        $tablas="ffsp_tbl_antecedentes a";
        $where="a.sex_id=1";
        $id="a.ante_id";
        
        
        $resultExamenes=$examenes->getCondiciones($columnas, $tablas, $where, $id);
       
        $html='';
        
        
        $html.='<table class="1" border=1>';
        $html.='<tr>';
        $html.='<th font-size: 11px;">EXAMENES REALIZADOS</th>';
        $html.='<th font-size: 11px;">SI/NO</th>';
        $html.='<th font-size: 11px;">TIEMPO</th>';
        $html.='<th font-size: 11px;">RESULTADO</th>';
        $html.='</tr>';
        
        foreach  ($resultExamenes as $res){
            
            $ante_id= $res->ante_id;
            
            $html.='<tr >';
            $html.='<td colspan="2" style="text-align: center; font-size: 11px;">'.$res->ante_nombre.'</td>';
            
            
            $resultFichaExa=$examenes->getWhere("ante_id='$ante_id' AND fic_id='$fic_id'");
            
            if(!empty($resultFichaExa)){
                //mas a imprimir
                
                foreach ($resultFichaExa as $res1  ){
                    
                    $html.='<td font-size: 11px;">'.$res->fic_ant_det_realizado.'</td>';
                    $html.='<td font-size: 11px;">'.$res->fic_ant_det_tiempo.'</td>';
                    $html.='<td font-size: 11px;">'.$res->fic_ant_det_resultado.'</td>';
                    
                }
                
                
            }else{
                
                $html.='<td font-size: 11px;">&nbsp;</td>';
                $html.='<td font-size: 11px;">&nbsp;</td>';
                $html.='<td font-size: 11px;">&nbsp;</td>';
                
                
                //manda a dibujar vacios xq no hay
            }
           
            $html.='</tr>';
            
        }
        
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_ANTECEDENTES']= $html;
        
        
        
        */
        
        /// Empleos Anteriores
        
        
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_ficha_empleos_anteriores.fic_emp_ant_id, 
                      ffsp_tbl_ficha_empleos_anteriores.fic_emp_ant_empresa, 
                      ffsp_tbl_ficha_empleos_anteriores.fic_emp_ant_puesto_trabajo, 
                      ffsp_tbl_ficha_empleos_anteriores.fic_emp_ant_actividades_desempenia, 
                      ffsp_tbl_ficha_empleos_anteriores.fic_emp_ant_tiempo_trabajo, 
                      ffsp_tbl_factores_riesgo_cabecera.fac_nombre, 
                      ffsp_tbl_ficha_empleos_anteriores.fic_emp_ant_observaciones";
        
        $tablas = "   public.ffsp_tbl_ficha_empleos_anteriores, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_factores_riesgo_cabecera";
        $where= "     ffsp_tbl_ficha_empleos_anteriores.fic_id = ffsp_tbl_ficha.fic_id AND
                      ffsp_tbl_factores_riesgo_cabecera.fac_id = ffsp_tbl_ficha_empleos_anteriores.fac_id 
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_empleos_anteriores = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
       
        
        foreach ($rsdatos_empleos_anteriores as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->fic_emp_ant_empresa.'</td>';
            $html.='<td class="3">'.$res->fic_emp_ant_puesto_trabajo.'</td>';
            $html.='<td class="3">'.$res->fic_emp_ant_actividades_desempenia.'</td>';
            $html.='<td class="3">'.$res->fic_emp_ant_tiempo_trabajo.'</td>';
            $html.='<td class="3">'.$res->fac_nombre.'</td>';
            $html.='<td class="3">'.$res->fic_emp_ant_observaciones.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_EMPLEOS_ANTERIORES']= $html;
        
        /// Detale si es mujer
        
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_sexo.sex_id, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_menarquia, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_ciclos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_fecha_ultima_mestruacion, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_gestas, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_partos, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_cesareas, 
                      ffsp_tbl_ficha_antecedentes.fic_ant_abortos";
        
        $tablas = "   public.ffsp_tbl_ficha_antecedentes, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_sexo";
        $where= "     ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_antecedentes.fic_id AND
                      ffsp_tbl_sexo.sex_id = ffsp_tbl_ficha_antecedentes.sex_id;                                                    
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_antecedentes_mujer = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $sexo=$rsdatos[0]->sex_id;
        
        
        if($sexo=="2"){
            $html='';
            $html.='<table class="1" border=1>';
            $html.='<tr >';
            $html.='<td class="4">Menarquía</td>';
            $html.='<td class="4">Ciclos</td>';
            $html.='<td class="4">Fecha Ultima Menstruacion</td>';
            $html.='<td class="4">Gestas</td>';
            $html.='<td class="4">Partos</td>';
            $html.='<td class="4">Cesáreas</td>';
            $html.='<td class="4">Abortos</td>';
            $html.='</td>';
            $html.='</tr>';
            
            
            foreach ($rsdatos_antecedentes_mujer as $res)
            {
                
                $html.='<tr >';
                $html.='<td class="3">'.$res->fic_ant_menarquia.'</td>';
                $html.='<td class="3">'.$res->fic_ant_ciclos.'</td>';
                $html.='<td class="3">'.$res->fic_ant_fecha_ultima_mestruacion.'</td>';
                $html.='<td class="3">'.$res->fic_ant_gestas.'</td>';
                $html.='<td class="3">'.$res->fic_ant_partos.'</td>';
                $html.='<td class="3">'.$res->fic_ant_cesareas.'</td>';
                $html.='<td class="3">'.$res->fic_ant_abortos.'</td>';
                $html.='</td>';
                $html.='</tr>';
            }
            
            $html.='</table>';
            
            $datos_reporte['DETALLE_ANTECEDENTES_GINECO']= $html;
            
        }
        
        
        
        
        ///DETALLE ANTECEDENTES FAMILIARES
        
        
        $columnas = " ffsp_tbl_antecedentes_familiares.ant_id, 
                      ffsp_tbl_antecedentes_familiares.ant_numero, 
                      ffsp_tbl_antecedentes_familiares.ant_nombre, 
                      ffsp_tbl_ficha_antecedentes_familiares.fic_ant_fam_descripcion, 
                      ffsp_tbl_ficha.fic_id";
        
        $tablas = "   public.ffsp_tbl_ficha_antecedentes_familiares, 
                      public.ffsp_tbl_antecedentes_familiares, 
                      public.ffsp_tbl_ficha";
        $where= "     ffsp_tbl_ficha_antecedentes_familiares.fic_id = ffsp_tbl_ficha.fic_id AND
                      ffsp_tbl_antecedentes_familiares.ant_id = ffsp_tbl_ficha_antecedentes_familiares.ant_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_antecedentes_familiares = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_antecedentes_familiares as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->ant_numero.'</td>';
            $html.='<td class="3">'.$res->ant_nombre.'</td>';
            $html.='<td class="3">'.$res->fic_ant_fam_descripcion.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_ANTECEDENTES_FAMILIARES']= $html;
        
        
        
        
        ///DETALLE ESTILO DE VIDA
        
        
        $columnas = " ffsp_tbl_estilo_vida.est_vid_id, 
                      ffsp_tbl_estilo_vida.est_vid_nombre, 
                      ffsp_tbl_ficha_estilo_vida.fic_est_vid_practica, 
                      ffsp_tbl_ficha_estilo_vida.fic_est_vid_cual, 
                      ffsp_tbl_ficha_estilo_vida.fic_est_vid_tiempo_cantidad, 
                      ffsp_tbl_ficha.fic_id";
        
        $tablas = "   public.ffsp_tbl_estilo_vida, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_ficha_estilo_vida";
        $where= "     ffsp_tbl_ficha_estilo_vida.fic_id = ffsp_tbl_ficha.fic_id AND
                      ffsp_tbl_ficha_estilo_vida.est_vid_id = ffsp_tbl_estilo_vida.est_vid_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_estilo_vida = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_estilo_vida as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->est_vid_nombre.'</td>';
            $html.='<td class="3">'.$res->fic_est_vid_practica.'</td>';
            $html.='<td class="3">'.$res->fic_est_vid_cual.'</td>';
            $html.='<td class="3">'.$res->fic_est_vid_tiempo_cantidad.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_ESTILO_DE_VIDA']= $html;
        
        
        
        ///EMFERMEDADES PROFESIONALES
        
        
        $columnas = " ffsp_tbl_ficha_enfermedades_profesionales.fic_enf_pro_id,
                      ffsp_tbl_ficha.fic_id,
                      ffsp_tbl_ficha_enfermedades_profesionales.fic_enf_pro_fue_calificado,
                      ffsp_tbl_ficha_enfermedades_profesionales.fic_enf_pro_especificar,
                      ffsp_tbl_ficha_enfermedades_profesionales.fic_enf_pro_fecha,
                      ffsp_tbl_ficha_enfermedades_profesionales.fic_enf_pro_observaciones";
        
        $tablas = "   public.ffsp_tbl_ficha_enfermedades_profesionales,
                      public.ffsp_tbl_ficha";
        $where= "      ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_enfermedades_profesionales.fic_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_emfermedades_profesionales = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_emfermedades_profesionales as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->fic_enf_pro_fue_calificado.'</td>';
            $html.='<td class="3">'.$res->fic_enf_pro_especificar.'</td>';
            $html.='<td class="3">'.$res->fic_enf_pro_fecha.'</td>';
            $html.='<td class="3">'.$res->fic_enf_pro_observaciones.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_EMFERMEDADES_PROFESIONALES']= $html;
        
        
        
        
        //ACCIDENTES DE TRABAJO
        
        
        
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_ficha_accidentes_trabajo.fic_acc_tra_fue_calificado, 
                      ffsp_tbl_ficha_accidentes_trabajo.fic_acc_tra_especificar, 
                      ffsp_tbl_ficha_accidentes_trabajo.fic_acc_tra_fecha, 
                      ffsp_tbl_ficha_accidentes_trabajo.fic_acc_tra_observaciones";
        
        $tablas = "   public.ffsp_tbl_ficha_accidentes_trabajo, 
                      public.ffsp_tbl_ficha";
        $where= "     ffsp_tbl_ficha_accidentes_trabajo.fic_id = ffsp_tbl_ficha.fic_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_accidentes_trabajo = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_accidentes_trabajo as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->fic_acc_tra_fue_calificado.'</td>';
            $html.='<td class="3">'.$res->fic_acc_tra_especificar.'</td>';
            $html.='<td class="3">'.$res->fic_acc_tra_fecha.'</td>';
            $html.='<td class="3">'.$res->fic_acc_tra_observaciones.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['ACCIDENTES_TRABAJO']= $html;
        
        
        
        
        
        
        
        ///REVISION ORGANOS
        
        
        $columnas = " ffsp_tbl_organos.org_id, 
                      ffsp_tbl_organos.org_nombre, 
                      ffsp_tbl_organos.org_numero, 
                      ffsp_tbl_ficha_revision_organos.fic_rev_org_id, 
                      ffsp_tbl_ficha_revision_organos.fic_rev_org_descripcion, 
                      ffsp_tbl_ficha.fic_id";
        
        $tablas = "   public.ffsp_tbl_ficha_revision_organos, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_organos";
        $where= "     ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_revision_organos.fic_id AND
                      ffsp_tbl_organos.org_id = ffsp_tbl_ficha_revision_organos.org_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_revision_organos = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        $html.='<tr >';
        $html.='<td class="4">Número</td>';
        $html.='<td class="4">Nombre</td>';
        $html.='<td class="4">Descripción</td>';
        $html.='</td>';
        $html.='</tr>';
        
        
        
        foreach ($rsdatos_revision_organos as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->org_numero.'</td>';
            $html.='<td class="3">'.$res->org_nombre.'</td>';
            $html.='<td class="3">'.$res->fic_rev_org_descripcion.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_REVISION_ORGANOS']= $html;
        
        
        $columnas = " ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_id, 
                      ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_presion_arterial, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_temperatura, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_frecuencia_cardiaca, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_saturacion_oxigeno, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_frecuencia_respiratoria, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_peso, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_talla, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_indice_masa_corporal, 
                      ffsp_tbl_ficha_constantes_vitales.fic_cons_vit_perimetro_abdominal";
        
        $tablas = "   public.ffsp_tbl_ficha_constantes_vitales, 
                      public.ffsp_tbl_ficha";
        $where= "     ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_constantes_vitales.fic_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_constantes = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        $datos_reporte['PRSION_VITAL_CONSTANTE']=$rsdatos_constantes[0]->fic_cons_vit_presion_arterial;
        $datos_reporte['TEMPERATURA_CONSTANTE']=$rsdatos_constantes[0]->fic_cons_vit_temperatura;
        $datos_reporte['FRECUENCIA_CARDIACA']=$rsdatos_constantes[0]->fic_cons_vit_frecuencia_cardiaca;
        $datos_reporte['SATURACION_OXIGENO']=$rsdatos_constantes[0]->fic_cons_vit_saturacion_oxigeno;
        $datos_reporte['FRECUENCIA_RESPIRATORIA']=$rsdatos_constantes[0]->fic_cons_vit_frecuencia_respiratoria;
        $datos_reporte['PESO_CONSTANTE']=$rsdatos_constantes[0]->fic_cons_vit_peso;
        $datos_reporte['TALLA_CONSTANTE']=$rsdatos_constantes[0]->fic_cons_vit_talla;
        $datos_reporte['MASA_CORPORAL']=$rsdatos_constantes[0]->fic_cons_vit_indice_masa_corporal;
        $datos_reporte['PERIMETRO_ABDOMINAL']=$rsdatos_constantes[0]->fic_cons_vit_perimetro_abdominal;
       
        
        
        ///EXAMEN_FISICO_REGIONAL
        
        
        $columnas = " ffsp_tbl_examen_fisico_regional_cabecera.exa_id, 
                      ffsp_tbl_examen_fisico_regional_cabecera.exa_nombre, 
                      ffsp_tbl_examen_fisico_regional_detalle.exam_id, 
                      ffsp_tbl_examen_fisico_regional_detalle.exam_nombre, 
                      ffsp_tbl_ficha_examen_fisico_regional.fic_exa_fis_reg_observacion, 
                      ffsp_tbl_ficha.fic_id
";
        
        $tablas = "   public.ffsp_tbl_ficha_examen_fisico_regional, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_examen_fisico_regional_cabecera, 
                      public.ffsp_tbl_examen_fisico_regional_detalle";
        $where= "     ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_examen_fisico_regional.fic_id AND
                      ffsp_tbl_examen_fisico_regional_detalle.exam_id = ffsp_tbl_ficha_examen_fisico_regional.exam_id AND
                      ffsp_tbl_examen_fisico_regional_detalle.exa_id = ffsp_tbl_examen_fisico_regional_cabecera.exa_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_examen_regional = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        $html.='<tr >';
        $html.='<td class="4">Nombre</td>';
        $html.='<td class="4">Detalle</td>';
        $html.='<td class="4">Descripción</td>';
        $html.='</td>';
        $html.='</tr>';
        
        
        
        foreach ($rsdatos_examen_regional as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->exa_nombre.'</td>';
            $html.='<td class="3">'.$res->exam_nombre.'</td>';
            $html.='<td class="3">'.$res->fic_exa_fis_reg_observacion.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_EXAMEN_FISICO_REGIONAL']= $html;
        
        
        ///RESULTADO_EXAMEN
        
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_ficha_resultado_examenes.fic_res_exa_examen, 
                      ffsp_tbl_ficha_resultado_examenes.fic_res_exa_fecha, 
                      ffsp_tbl_ficha_resultado_examenes.fic_res_exa_resultados";
        
        $tablas = "   public.ffsp_tbl_ficha_resultado_examenes, 
                      public.ffsp_tbl_ficha";
        $where= "     ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_resultado_examenes.fic_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_resultado_examen = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_resultado_examen as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->fic_res_exa_examen.'</td>';
            $html.='<td class="3">'.$res->fic_res_exa_fecha.'</td>';
            $html.='<td class="3">'.$res->fic_res_exa_resultados.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DETALLE_RESULTADO_EXAMEN']= $html;
        
        
        ///DIAGNOSTICO
        
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_ficha_diagnostico.fic_diag_descripcion, 
                      ffsp_tbl_ficha_diagnostico.fic_diag_cie, 
                      ffsp_tbl_tipo_diagnostico.tip_diag_nombre";
        
        $tablas = "   public.ffsp_tbl_ficha_diagnostico, 
                      public.ffsp_tbl_tipo_diagnostico, 
                      public.ffsp_tbl_ficha";
        $where= "     ffsp_tbl_ficha_diagnostico.fic_id = ffsp_tbl_ficha.fic_id AND
                      ffsp_tbl_tipo_diagnostico.tip_diag_id = ffsp_tbl_ficha_diagnostico.tip_diag_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_diagnostico = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_diagnostico as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->fic_diag_descripcion.'</td>';
            $html.='<td class="3">'.$res->fic_diag_cie.'</td>';
            $html.='<td class="3">'.$res->tip_diag_nombre.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['DIAGNOSTICO']= $html;
        
        
        ///APTITUD MEDICA
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_aptitud_medica.apt_med_id, 
                      ffsp_tbl_aptitud_medica.apt_med_nombre, 
                      ffsp_tbl_ficha_aptitud_medica.fic_apt_med_observacion, 
                      ffsp_tbl_ficha_aptitud_medica.fic_apt_med_limitacion";
        
        $tablas = "   public.ffsp_tbl_ficha_aptitud_medica, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_aptitud_medica";
        $where= "     ffsp_tbl_ficha.fic_id = ffsp_tbl_ficha_aptitud_medica.fic_id AND
                      ffsp_tbl_aptitud_medica.apt_med_id = ffsp_tbl_ficha_aptitud_medica.apt_med_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_aptitud_medica = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        /*
        $datos_reporte['NOMBRE_APTITUD']=$rsdatos_aptitud_medica[0]->apt_med_nombre;
        $datos_reporte['OBSERVACION_APTITUD']=$rsdatos_aptitud_medica[0]->apt_med_nombre;
        $datos_reporte['LIMITACION_APTITUD']=$rsdatos_aptitud_medica[0]->apt_med_nombre;
       */
        
        
        $columnas = " ffsp_tbl_ficha.fic_id,
                      ffsp_tbl_ficha.fic_antecedentes_personales,
                      ffsp_tbl_ficha.fic_recomendacion_tratamiento,
                      usuarios.id_usuarios, 
                      usuarios.nombre_usuarios, 
                      usuarios.cedula_usuarios, 
                      CAST(ffsp_tbl_ficha.fic_fecha_registro as DATE)";
        
        $tablas = "  public.ffsp_tbl_ficha, 
                     public.usuarios";
        $where= "    ffsp_tbl_ficha.usu_id = usuarios.id_usuarios
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_usuarios = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        
        $hora = $rsdatos_usuarios[0]->fic_fecha_registro;
      
       
        
        
       
        $datos_reporte['NOMBRE_USUARIO']=$rsdatos_usuarios[0]->nombre_usuarios;
        $datos_reporte['FECHA_REGISTRO']=$rsdatos_usuarios[0]->fic_fecha_registro;
        $datos_reporte['CODIGO_REGISTRO']=$rsdatos_usuarios[0]->fic_id;
        $datos_reporte['HORA_REGISTRO']=$rsdatos_usuarios[0]->fic_fecha_registro;
        $datos_reporte['TRATAMIENTO']=$rsdatos_usuarios[0]->fic_recomendacion_tratamiento;
        $datos_reporte['ANTECEDENTES_CLINICOS']=$rsdatos_usuarios[0]->fic_antecedentes_personales;
      
        ///FACTORES DE RIESGO
        
        
        $columnas = " ffsp_tbl_ficha.fic_id, 
                      ffsp_tbl_ficha_factores_riesgo.fic_fact_ries_puesto_trabajo, 
                      ffsp_tbl_ficha_factores_riesgo.fic_fact_ries_actividades, 
                      ffsp_tbl_factores_riesgo_cabecera.fac_id, 
                      ffsp_tbl_factores_riesgo_cabecera.fac_nombre, 
                      ffsp_tbl_ficha_factores_riesgo_detalle.fic_fact_ries_det_otros, 
                      ffsp_tbl_ficha_factores_riesgo.fic_fact_ries_medidas_preventivas";
        
        $tablas = "   public.ffsp_tbl_ficha_factores_riesgo, 
                      public.ffsp_tbl_ficha_factores_riesgo_detalle, 
                      public.ffsp_tbl_ficha, 
                      public.ffsp_tbl_factores_riesgo_cabecera";
        $where= "     ffsp_tbl_ficha_factores_riesgo.fic_id = ffsp_tbl_ficha.fic_id AND
                      ffsp_tbl_ficha_factores_riesgo_detalle.fic_fact_ries_id = ffsp_tbl_ficha_factores_riesgo.fic_fact_ries_id AND
                      ffsp_tbl_factores_riesgo_cabecera.fac_id = ffsp_tbl_ficha_factores_riesgo_detalle.fact_id
                      AND  ffsp_tbl_ficha.fic_id='$fic_id'";
        $id="ffsp_tbl_ficha.fic_id";
        
        $rsdatos_factores_riesgo = $ficha->getCondiciones($columnas, $tablas, $where, $id);
        
        
        $html='';
        
        
        $html.='<table class="1" border=1>';
        
        
        foreach ($rsdatos_factores_riesgo as $res)
        {
            
            $html.='<tr >';
            $html.='<td class="3">'.$res->fic_fact_ries_puesto_trabajo.'</td>';
            $html.='<td class="3">'.$res->fic_fact_ries_actividades.'</td>';
            $html.='<td class="3">'.$res->fac_nombre.'</td>';
            $html.='<td class="3">'.$res->fic_fact_ries_det_otros.'</td>';
            $html.='<td class="3">'.$res->fic_fact_ries_medidas_preventivas.'</td>';
            $html.='</td>';
            $html.='</tr>';
        }
        
        $html.='</table>';
        
        $datos_reporte['FACTORES_DE_RIESGO']= $html;
      
        
       
        
        
        
        $this->verReporte("ReporteFicha1", array('datos_reporte'=>$datos_reporte ));
        
        
        
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