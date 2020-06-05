 var fic_id=0;

$(document).ready(function(){
	
	
	cargaIdentidadGenero();
	cargaEmpresa();
	cargaOrientacionSexual();
	cargaReligion();
	cargaSexo();
	cargarEmpleados();
	search_antecedentes_detalle(1);
	cargarficha_datos();
	cargarAntecedentesEdicionFinal();
	CKEDITOR.replace('fic_motivo_consulta');
	CKEDITOR.instances.fic_motivo_consulta.setData(""); 
	CKEDITOR.replace('fic_antecedentes_personales');
	CKEDITOR.instances.fic_antecedentes_personales.setData(""); 
	
	CKEDITOR.replace('fic_actividades_extra_laborales');
	CKEDITOR.instances.fic_actividades_extra_laborales.setData(""); 
	
	CKEDITOR.replace('fic_enfermedad_actual');
	CKEDITOR.instances.fic_enfermedad_actual.setData(""); 
	
	CKEDITOR.replace('fic_recomendacion_tratamiento');
	CKEDITOR.instances.fic_recomendacion_tratamiento.setData(""); 
	
	
    $('.textarea').wysihtml5()
    
	
})



    
    
    
 
  
function cargarEmpleados(){
	    
     fic_id=document.getElementById('fic_id').value;
   //  var _fic_id = document.getElementById('fic_id').value;
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffsp_ficha&action=cargarEmpleados",
		type:"POST",
		dataType:"json",
		data:{fic_id:fic_id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			
			$("#emp_id").val(array.emp_id);
			$("#emp_ruc").val(array.emp_ruc);
			$("#emp_ciudad").val(array.emp_ciudad);
			
			
			$("#empl_primer_nombre").val(array.empl_primer_nombre);			
			$("#empl_segundo_nombre").val(array.empl_segundo_nombre);
			$("#empl_primer_apellido").val(array.empl_primer_apellido);
			$("#empl_segundo_apellido").val(array.empl_segundo_apellido);
			$("#ide_id").val(array.ide_id);
			$("#empl_dni").val(array.empl_dni);
			$("#empl_edad").val(array.empl_edad);
			$("#empl_grupo_sanguineo").val(array.empl_grupo_sanguineo);
			$("#empl_fecha_ingreso").val(array.empl_fecha_ingreso);
			$("#empl_lugar_trabajo").val(array.empl_lugar_trabajo);
			$("#empl_area_trabajo").val(array.empl_area_trabajo);
			$("#empl_actividades_trabajo").val(array.empl_actividades_trabajo);

			var valor_dis_tiene = ( array.dis_tiene == 't' ) ? "SI" : "NO";
			
			 if (valor_dis_tiene == 'SI') {
	                document.getElementById('nombre_discapacidad').style.display = "block"
	                document.getElementById('porcentaje_discapacidad').style.display = "block"
	                $("#dis_nombre").val(array.dis_nombre);	
	                $("#dis_porcentaje").val(array.dis_porcentaje);	
			 }else{
                document.getElementById('nombre_discapacidad').style.display = "none"
                document.getElementById('porcentaje_discapacidad').style.display = "none"
            	$("#dis_nombre").val('');	
                $("#dis_porcentaje").val('');	
                
            }
			$("#dis_tiene").val(valor_dis_tiene);	
			$("#ori_id").val(array.ori_id);
			$("#rel_id").val(array.rel_id);
			$("#sex_id").val(array.sex_id);
			
			if(array.sex_id==2){
				
				$("#hombre").hide();
			}else{
				
				$("#mujer").hide();
			}
			
			
			$("#empl_id").val(array.empl_id);
			
			$("html, body").animate({ scrollTop: $(empl_primer_nombre).offset().top-120 }, tiempo);	
			
			cargaExamenes();
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	

	
}



function cargaIdentidadGenero(){
	
	let $ddlIdentidadGenero= $("#ide_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaIdentidadGenero",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlIdentidadGenero.empty();
		$ddlIdentidadGenero.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlIdentidadGenero.append("<option value= " +value.ide_id +" >" + value.ide_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlIdentidadGenero.empty();
	})
	
}

$("#ide_id").on("focus",function(){
	$("#mensaje_identidad_genero").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})




function cargaEmpresa(){
	
	let $ddlEmpresa= $("#emp_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaEmpresa",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.emp_id +" >" + value.emp_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}

$("#emp_id").on("focus",function(){
	$("#mensaje_empresa").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


function cargaOrientacionSexual(){
	
	let $ddlOrientacionSexual= $("#ori_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaOrientacionSexual",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlOrientacionSexual.empty();
		$ddlOrientacionSexual.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlOrientacionSexual.append("<option value= " +value.ori_id +" >" + value.ori_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlOrientacionSexual.empty();
	})
	
}

$("#ori_id").on("focus",function(){
	$("#mensaje_orientacion_sexual").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


function cargaReligion(){
	
	let $ddlReligion= $("#rel_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaReligion",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlReligion.empty();
		$ddlReligion.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlReligion.append("<option value= " +value.rel_id +" >" + value.rel_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlReligion.empty();
	})
	
}

$("#rel_id").on("focus",function(){
	$("#mensaje_religion").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})



function cargaSexo(){
	
	let $ddlSexo= $("#sex_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaSexo",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlSexo.empty();
		$ddlSexo.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlSexo.append("<option value= " +value.sex_id +" >" + value.sex_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlSexo.empty();
	})
	
}

$("#sex_id").on("focus",function(){
	$("#mensaje_sexo").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})



      $("#sex_id").click(function() {
			
          var sex_id = $(this).val();
			
          if(sex_id == 2 )
          {
        	  cargaExamenes();
           $("#hombre").hide();
           $("#mujer").show();
           
          }
       	 else
          {
       		 cargaExamenes();
       	   $("#mujer").hide();
       	   $("#hombre").show();
       	 
		  }
          
	    });
	    
	    $("#sex_id").change(function() {
			    
              var sex_id = $(this).val();
				 
              if(sex_id == 2)
              {
            	  cargaExamenes();
            	  $("#hombre").hide();
                  $("#mujer").show(); 
                 
              }
           	   else
              {
           		cargaExamenes();
           		 $("#mujer").hide();
             	 $("#hombre").show(); 
             	
              }
              
              
		    });
	 	
	   
	    function ToggleDiv(id) {
            if (id == 'SI') {
                document.getElementById('nombre_discapacidad').style.display = "block"
                document.getElementById('porcentaje_discapacidad').style.display = "block"                    
            }else if (id == 'NO'){
            	document.getElementById('nombre_discapacidad').style.display = "none"
            	document.getElementById('porcentaje_discapacidad').style.display = "none"  
            		
            	//limpiar
            	$("#dis_nombre").val("");
            	$("#dis_porcentaje").val("");
            	
            		
            }else{
                document.getElementById('nombre_discapacidad').style.display = "none"
                document.getElementById('porcentaje_discapacidad').style.display = "none"
                	
                	//limpiar
                $("#dis_nombre").val("");
            	$("#dis_porcentaje").val("");
            	
            }
 }


	    function cargaExamenes(){
	    	
	    	let $ddlExamen= $("#ante_id");
	    	var sex_id=$('#sex_id').val();
	    	
	    
	    	$.ajax({
	    		beforeSend:function(){},
	    		url:"index.php?controller=ffsp_ficha&action=cargaExamenes",
	    		type:"POST",
	    		dataType:"json",
	    		data:{sex_id:sex_id}
	    	}).done(function(datos){		
	    		
	    		$ddlExamen.empty();
	    		$ddlExamen.append("<option value='0' >--Seleccione--</option>");
	    		
	    		$.each(datos.data, function(index, value) {
	    			$ddlExamen.append("<option value= " +value.ante_id +" >" + value.ante_nombre  + "</option>");	
	      		});
	    		
	    	}).fail(function(xhr,status,error){
	    		var err = xhr.responseText
	    		console.log(err)
	    		$ddlExamen.empty();
	    	})
	    	
	    }

	    

	    function AgregarC(){
	 	   
	 	    
	 	   var _empl_id = document.getElementById('empl_id').value;
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _ante_id = document.getElementById('ante_id').value;
	 	   var _fic_ant_det_realizado = document.getElementById('fic_ant_det_realizado').value;
	 	   var _fic_ant_det_tiempo = document.getElementById('fic_ant_det_tiempo').value;
	 	   var _fic_ant_det_resultado = document.getElementById('fic_ant_det_resultado').value;
	  	
	 	   
	 	   if(_fic_id == '' || _fic_id == 0){
	 		   $("#mensaje_primer_nombre").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 		if(_empl_id == '' || _empl_id == 0){
	 			   $("#mensaje_primer_nombre").notify("Error no hay empleado",{ position:"buttom left", autoHideDelay: 2000});
	 				return false;
	 		}
	 		
	 	   if(_ante_id == 0){
	 		   $("#mensaje_ante_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   

	 	   if(_fic_ant_det_realizado == 0){
	 		   $("#mensaje_fic_ant_det_realizado").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   
	 	   
	 	   if(_fic_ant_det_realizado=='TRUE'){
	 		   
	 		   if(_fic_ant_det_tiempo=="" || _fic_ant_det_tiempo.length == 0){
	 			   $("#mensaje_fic_ant_det_tiempo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 		   }
	 		   
	 		   if(_fic_ant_det_resultado=="" || _fic_ant_det_resultado.length == 0){
	 			   $("#mensaje_fic_ant_det_resultado").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 		   }
	 		   
	 	   }
	 	   
	 	   
	 	 	$("#aplicar").attr({disabled:true});
	 		
	 	 	var parametros = {ante_id:_ante_id,
	 	 			fic_ant_det_realizado:_fic_ant_det_realizado,
	 	 			fic_ant_det_tiempo:_fic_ant_det_tiempo,
	 	 			fic_ant_det_resultado:_fic_ant_det_resultado,
	 	 	          empl_id:_empl_id,
	 		          fic_id:_fic_id
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffsp_ficha&action=InsertaAntecedentesDetalle_C",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				$("#ante_id").val("0");
	 				$("#fic_ant_det_realizado").val("0");
	 				$("#fic_ant_det_tiempo").val("");
	 				$("#fic_ant_det_resultado").val("");
	 			 	
	 				search_antecedentes_detalle(1);
	 				
	 				swal({
	 			  		  title: "Agregando Exámenes Realizados",
	 			  		  text: datos.mensaje,
	 			  		  icon: "success",
	 			  		  button: "Aceptar",
	 			  		
	 			  		});
	 				
	 			}
	 			 
	 		
	 		
	 		}).fail(function(xhr,status,error){
	 			
	 			var err = xhr.responseText
	 			console.log(err);
	 			
	 		})
	 	  
	    }

	    
	    
	    

	    function search_antecedentes_detalle(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#load_antecedentes_sexo_registrados").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
	    	    
	    		url:"index.php?controller=ffsp_ficha&action=search_antecendentes_detalle",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#antecedentes_sexo_registrados").html(datos);	
	    		 $("#load_antecedentes_sexo_registrados").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editAntecedenteDetalle(ante_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffsp_ficha&action=editAntecedentesDetalle",
	    		type:"POST",
	    		dataType:"json",
	    		data:{ante_id:ante_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			$("#ante_id").val(array.ante_id);			
	    			$("#fic_ant_det_tiempo").val(array.fic_ant_det_tiempo);
	    			$("#fic_ant_det_resultado").val(array.fic_ant_det_resultado);
	    			
	    			var valor_dis_tiene = ( array.fic_ant_det_realizado == 't' ) ? "TRUE" : "FALSE";
	    			
	    			$("#fic_ant_det_realizado").val(valor_dis_tiene);			
	    			
	    			$("html, body").animate({ scrollTop: $("#ante_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delAntecedenteDetalle(fic_ant_det_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffsp_ficha&action=delAntecedentesDetalle",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_ant_det_id:fic_ant_det_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Exámenes Realizados",
	    		  		  text: "Registro Eliminado",
	    		  		  icon: "success",
	    		  		  button: "Aceptar",
	    		  		});
	    					
	    		}
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		search_antecedentes_detalle(1);
	    	})
	    	
	    	return false;
	    }
	    
	    
	    
	    
	    
	    

	    function cargarficha_datos(){
	    	    
	         fic_id=document.getElementById('fic_id').value;
	       //  var _fic_id = document.getElementById('fic_id').value;
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffsp_ficha&action=cargarDatosFicha",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			CKEDITOR.instances.fic_motivo_consulta.setData(array.fic_motivo_consulta);
	    			CKEDITOR.instances.fic_antecedentes_personales.setData(array.fic_antecedentes_personales);
	    			CKEDITOR.instances.fic_actividades_extra_laborales.setData(array.fic_actividades_extra_laborales);
	    			CKEDITOR.instances.fic_enfermedad_actual.setData(array.fic_enfermedad_actual);
	    			CKEDITOR.instances.fic_recomendacion_tratamiento.setData(array.fic_recomendacion_tratamiento);
	    			
	    			
	    			
	    		}
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	

	    	
	    }

	    
	    
	    
	    
	    
	    
	    
	    
	    

	    function cargarAntecedentesEdicionFinal(){
	    	    
	         fic_id=document.getElementById('fic_id').value;
	    	 var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffsp_ficha&action=cargarDatosFichaAntecedentes",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			var fic_ant_menarquia = ( array.fic_ant_menarquia == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_menarquia").val(fic_ant_menarquia);			
	    			
	    			$("#fic_ant_ciclos").val(array.fic_ant_ciclos);
	    			$("#fic_ant_fecha_ultima_mestruacion").val(array.fic_ant_fecha_ultima_mestruacion);
	    			
	    			var fic_ant_gestas = ( array.fic_ant_gestas == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_gestas").val(fic_ant_gestas);			
	    			
	    			var fic_ant_partos = ( array.fic_ant_partos == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_partos").val(fic_ant_partos);			
	    			
	    			var fic_ant_cesareas = ( array.fic_ant_cesareas == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_cesareas").val(fic_ant_cesareas);			
	    			
	    			var fic_ant_abortos = ( array.fic_ant_abortos == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_abortos").val(fic_ant_abortos);			
	    		
	    			var fic_ant_hijos_vivos = ( array.fic_ant_hijos_vivos == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_hijos_vivos").val(fic_ant_hijos_vivos);			
	    			
	    			var fic_ant_hijos_muertos = ( array.fic_ant_hijos_muertos == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_hijos_muertos").val(fic_ant_hijos_muertos);			
	    			
	    			var fic_ant_vida_sexual = ( array.fic_ant_vida_sexual == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_vida_sexual").val(fic_ant_vida_sexual);			
	    			
	    			  
	    			
	    			var fic_ant_metodo_planificacion_familiar = ( array.fic_ant_metodo_planificacion_familiar == 't' ) ? "TRUE" : "FALSE";
	    			$("#fic_ant_metodo_planificacion_familiar").val(fic_ant_metodo_planificacion_familiar);			
	    			
	    			$("#fic_ant_tipo_metodo_planificacion_familiar").val(array.fic_ant_tipo_metodo_planificacion_familiar);
	    			
	    			
	    		}
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	

	    	
	    }

	    
	    
	    
	    
	    
	    
	    
	    
	    
	    
	       