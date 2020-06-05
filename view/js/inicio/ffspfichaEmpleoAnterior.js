$(document).ready(function(){
	search_ficha_empleo_anterior();
	cargaFactoresRiesgo();
	
})
   function AgregarEmpleoAnterior(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_emp_ant_empresa = document.getElementById('fic_emp_ant_empresa').value;
	 	   var _fic_emp_ant_puesto_trabajo = document.getElementById('fic_emp_ant_puesto_trabajo').value;
	 	   var _fic_emp_ant_actividades_desempenia = document.getElementById('fic_emp_ant_actividades_desempenia').value;
	 	   var _fic_emp_ant_tiempo_trabajo = document.getElementById('fic_emp_ant_tiempo_trabajo').value;
	 	   var _fac_id = document.getElementById('fac_id').value;
	 	   var _fic_emp_ant_observaciones = document.getElementById('fic_emp_ant_observaciones').value;
		 	
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_fic_emp_ant_empresa=="" || _fic_emp_ant_empresa.length == 0){
			   $("#mensaje_fic_emp_ant_empresa").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_emp_ant_puesto_trabajo=="" || _fic_emp_ant_puesto_trabajo.length == 0){
			   $("#mensaje_fic_emp_ant_puesto_trabajo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_emp_ant_actividades_desempenia=="" || _fic_emp_ant_actividades_desempenia.length == 0){
			   $("#mensaje_fic_emp_ant_actividades_desempenia").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_emp_ant_tiempo_trabajo=="" || _fic_emp_ant_tiempo_trabajo.length == 0){
			   $("#mensaje_fic_emp_ant_tiempo_trabajo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fac_id == 0){
	 		   $("#mensaje_fac_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   if(_fic_emp_ant_observaciones=="" || _fic_emp_ant_observaciones.length == 0){
			   $("#mensaje_fic_emp_ant_observaciones").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	  
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 
	 	 			fic_id:_fic_id,
	 	 			fic_emp_ant_empresa:_fic_emp_ant_empresa,
	 	 			fic_emp_ant_puesto_trabajo:_fic_emp_ant_puesto_trabajo,
	 	 			fic_emp_ant_actividades_desempenia:_fic_emp_ant_actividades_desempenia,
	 	 			fic_emp_ant_tiempo_trabajo:_fic_emp_ant_tiempo_trabajo,
	 	 			fac_id:_fac_id,
	 	 			fic_emp_ant_observaciones:_fic_emp_ant_observaciones
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaEmpleoAnterior&action=InsertafichaEmpleoAnterior",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_emp_ant_empresa").val("");
	 				$("#fic_emp_ant_puesto_trabajo").val("");
	 				$("#fic_emp_ant_actividades_desempenia").val("");
	 				$("#fic_emp_ant_tiempo_trabajo").val("");
	 				$("#fac_id").val("0");
	 				$("#fic_emp_ant_observaciones").val("");
	 				
	 				search_ficha_empleo_anterior(1);
	 				
	 				swal({
	 			  		  title: "Agregando Empleos Anteriores",
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

	    
	    
	    

	    function search_ficha_empleo_anterior(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaEmpleoAnterior").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaEmpleoAnterior&action=search_ficha_empleo_anterior",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_empleo_anterior_registrados").html(datos);	
	    		 $("#consultafichaEmpleoAnterior").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaEmpleoAnterior(fac_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaEmpleoAnterior&action=editfichaEmpleoAnterior",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fac_id:fac_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#fic_emp_ant_empresa").val(array.fic_emp_ant_empresa);			
	    			$("#fic_emp_ant_puesto_trabajo").val(array.fic_emp_ant_puesto_trabajo);
	    			$("#fic_emp_ant_actividades_desempenia").val(array.fic_emp_ant_actividades_desempenia);
	    			$("#fic_emp_ant_tiempo_trabajo").val(array.fic_emp_ant_tiempo_trabajo);
	    			$("#fac_id").val(array.fac_id);
	    			$("#fic_emp_ant_observaciones").val(array.fic_emp_ant_observaciones);
	    			
	    			
	    			$("html, body").animate({ scrollTop: $("#fac_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaEmpleoAnterior(fic_emp_ant_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaEmpleoAnterior&action=delfichaEmpleoAnterior",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_emp_ant_id:fic_emp_ant_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Empleo _Anterior",
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
	    		search_ficha_empleo_anterior(1);
	    	})
	    	
	    	return false;
	    }

function cargaFactoresRiesgo(){
	
	let $ddlEmpresa= $("#fac_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaEmpleoAnterior&action=cargaFactoresRiesgo",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.fac_id +" >" + value.fac_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





