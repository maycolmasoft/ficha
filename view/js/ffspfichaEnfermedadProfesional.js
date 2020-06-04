$(document).ready(function(){
	search_ficha_enfermedad_profesional();

})
   function AgregarEnfermedadProfesional(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_enf_pro_fue_calificado = document.getElementById('fic_enf_pro_fue_calificado').value;
	 	   var _fic_enf_pro_especificar = document.getElementById('fic_enf_pro_especificar').value;
	 	   var _fic_enf_pro_fecha = document.getElementById('fic_enf_pro_fecha').value;
	 	   var _fic_enf_pro_observaciones = document.getElementById('fic_enf_pro_observaciones').value;
	 	   
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	  if(_fic_enf_pro_fue_calificado == 0){
	 		   $("#mensaje_fic_enf_pro_fue_calificado").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	  if(_fic_enf_pro_especificar=="" || _fic_enf_pro_especificar.length == 0){
			   $("#mensaje_fic_enf_pro_especificar").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	 if(_fic_enf_pro_fecha=="" || _fic_enf_pro_fecha.length == 0){
			   $("#mensaje_fic_enf_pro_fecha").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	if(_fic_enf_pro_observaciones=="" || _fic_enf_pro_observaciones.length == 0){
			   $("#mensaje_fic_enf_pro_observaciones").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 
	 	 			fic_id:_fic_id,
	 	 			fic_enf_pro_fue_calificado:_fic_enf_pro_fue_calificado,
	 	 			fic_enf_pro_especificar:_fic_enf_pro_especificar,
	 	 			fic_enf_pro_fecha:_fic_enf_pro_fecha,
	 	 			fic_enf_pro_observaciones:_fic_enf_pro_observaciones
	 	 			
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaEnfermedadProfesional&action=InsertafichaEnfermedadProfesional",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_enf_pro_fue_calificado").val("");
	 				$("#fic_enf_pro_especificar").val("");
	 				$("#fic_enf_pro_fecha").val("");
	 				$("#fic_enf_pro_observaciones").val("");
	 				
	 				
	 				search_ficha_enfermedad_profesional(1);
	 				
	 				swal({
	 			  		  title: "Agregando Enfermedades Profesionales",
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

	    
	    
	    

	    function search_ficha_enfermedad_profesional(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaEnfermedadProfesional").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaEnfermedadProfesional&action=search_ficha_enfermedad_profesional",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_enfermedad_profesional_registrados").html(datos);	
	    		 $("#consultafichaEnfermedadProfesional").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaEnfermedadProfesional(fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaEnfermedadProfesional&action=editfichaEnfermedadProfesional",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#fic_enf_pro_especificar").val(array.fic_enf_pro_especificar);
	    			$("#fic_enf_pro_fecha").val(array.fic_enf_pro_fecha);
	    			$("#fic_enf_pro_observaciones").val(array.fic_enf_pro_observaciones);
					
	    			var fic_enf_pro_fue_calificado = ( array.fic_enf_pro_fue_calificado == 't' ) ? "TRUE" : "FALSE";
	    			
	    			$("#fic_enf_pro_fue_calificado").val(fic_enf_pro_fue_calificado);	
	    			
	    			$("html, body").animate({ scrollTop: $("#fic_enf_pro_fue_calificado").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaEnfermedadProfesional(fic_enf_pro_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaEnfermedadProfesional&action=delfichaEnfermedadProfesional",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_enf_pro_id:fic_enf_pro_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Enfermedades Profesionales",
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
	    		search_ficha_enfermedad_profesional(1);
	    	})
	    	
	    	return false;
	    }




