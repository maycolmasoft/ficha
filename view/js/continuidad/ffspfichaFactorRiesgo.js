$(document).ready(function(){
	search_ficha_factor_riesgo();

})
   function AgregarFactorRiesgo(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_fact_ries_puesto_trabajo = document.getElementById('fic_fact_ries_puesto_trabajo').value;
	 	   var _fic_fact_ries_actividades = document.getElementById('fic_fact_ries_actividades').value;
	 	   var _fic_fact_ries_medidas_preventivas = document.getElementById('fic_fact_ries_medidas_preventivas').value;
	 	   
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	  if(_fic_fact_ries_puesto_trabajo=="" || _fic_fact_ries_puesto_trabajo.length == 0){
			   $("#mensaje_fic_fact_ries_puesto_trabajo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	 if(_fic_fact_ries_actividades=="" || _fic_fact_ries_actividades.length == 0){
			   $("#mensaje_fic_fact_ries_actividades").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	if(_fic_fact_ries_medidas_preventivas=="" || _fic_fact_ries_medidas_preventivas.length == 0){
			   $("#mensaje_fic_fact_ries_medidas_preventivas").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 
	 	 			fic_id:_fic_id,
	 	 			fic_fact_ries_puesto_trabajo:_fic_fact_ries_puesto_trabajo,
	 	 			fic_fact_ries_actividades:_fic_fact_ries_actividades,
	 	 			fic_fact_ries_medidas_preventivas:_fic_fact_ries_medidas_preventivas
	 	 			
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaFactorRiesgo&action=InsertafichaFactorRiesgo",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_fact_ries_puesto_trabajo").val("");
	 				$("#fic_fact_ries_actividades").val("");
	 				$("#fic_fact_ries_medidas_preventivas").val("");
	 				
	 				
	 				search_ficha_factor_riesgo(1);
	 				
	 				swal({
	 			  		  title: "Agregando Factores de Riesgo",
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

	    
	    
	    

	    function search_ficha_factor_riesgo(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaFactorRiesgo").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaFactorRiesgo&action=search_ficha_factor_riesgo",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_factor_riesgo_registrados").html(datos);	
	    		 $("#consultafichaFactorRiesgo").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaFactorRiesgo(fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaFactorRiesgo&action=editfichaFactorRiesgo",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    	
	    			$("#fic_fact_ries_puesto_trabajo").val(array.fic_fact_ries_puesto_trabajo);
	    			$("#fic_fact_ries_actividades").val(array.fic_fact_ries_actividades);
	    			$("#fic_fact_ries_medidas_preventivas").val(array.fic_fact_ries_medidas_preventivas);
					
	    				
	    			$("html, body").animate({ scrollTop: $("#fic_fact_ries_puesto_trabajo").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaFactorRiesgo(fic_fact_ries_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaFactorRiesgo&action=delfichaFactorRiesgo",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_fact_ries_id:fic_fact_ries_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Factores Riesgo",
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
	    		search_ficha_factor_riesgo(1);
	    	})
	    	
	    	return false;
	    }




