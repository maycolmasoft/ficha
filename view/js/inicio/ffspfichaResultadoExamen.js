$(document).ready(function(){
	search_ficha_resultado_examen();

})
   function AgregarResultadoExamen(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_res_exa_examen = document.getElementById('fic_res_exa_examen').value;
	 	   var _fic_res_exa_fecha = document.getElementById('fic_res_exa_fecha').value;
	 	   var _fic_res_exa_resultados = document.getElementById('fic_res_exa_resultados').value;
	 	
	 	 
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_fic_res_exa_examen=="" || _fic_res_exa_examen.length == 0){
			   $("#mensaje_fic_res_exa_examen").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_res_exa_fecha=="" || _fic_res_exa_fecha.length == 0){
			   $("#mensaje_fic_res_exa_fecha").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_res_exa_resultados=="" || _fic_res_exa_resultados.length == 0){
			   $("#mensaje_fic_res_exa_resultados").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 
	 	 			
	 	 			
	 	 			fic_id:_fic_id,
	 	 			fic_res_exa_examen:_fic_res_exa_examen,
	 	 			fic_res_exa_fecha:_fic_res_exa_fecha,
	 	 			fic_res_exa_resultados:_fic_res_exa_resultados
	 	 		
	 	 			
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaResultadoExamen&action=InsertafichaResultadoExamen",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_res_exa_examen").val("");
	 				$("#fic_res_exa_fecha").val("");
	 				$("#fic_res_exa_resultados").val("");
	 				
	 				
	 				
	 				search_ficha_resultado_examen(1);
	 				
	 				swal({
	 			  		  title: "Agregando Resultados de Examen",
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

	    
	    
	    

	    function search_ficha_resultado_examen(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#loadfichaResultadoExamen").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaResultadoExamen&action=search_ficha_resultado_examen",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_resultado_examen_registrados").html(datos);	
	    		 $("#loadfichaResultadoExamen").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaResultadoExamen(fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaResultadoExamen&action=editfichaResultadoExamen",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			
	    			
	    			$("#fic_res_exa_examen").val(array.fic_res_exa_examen);
	    			$("#fic_res_exa_fecha").val(array.fic_res_exa_fecha);
	    			$("#fic_res_exa_resultados").val(array.fic_res_exa_resultados);
	    		
					
	    			
	    			$("html, body").animate({ scrollTop: $("#fic_res_exa_examen").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaResultadoExamen(fic_res_exa_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaResultadoExamen&action=delfichaResultadoExamen",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_res_exa_id:fic_res_exa_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Resultados de Examen",
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
	    		search_ficha_resultado_examen(1);
	    	})
	    	
	    	return false;
	    }




