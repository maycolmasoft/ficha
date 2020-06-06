$(document).ready(function(){
	search_ficha_constante_vital();

})
   function AgregarConstanteVital(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_cons_vit_presion_arterial = document.getElementById('fic_cons_vit_presion_arterial').value;
	 	   var _fic_cons_vit_temperatura = document.getElementById('fic_cons_vit_temperatura').value;
	 	   var _fic_cons_vit_frecuencia_cardiaca = document.getElementById('fic_cons_vit_frecuencia_cardiaca').value;
	 	   var _fic_cons_vit_saturacion_oxigeno = document.getElementById('fic_cons_vit_saturacion_oxigeno').value;
	 	   var _fic_cons_vit_frecuencia_respiratoria = document.getElementById('fic_cons_vit_frecuencia_respiratoria').value;
	 	   var _fic_cons_vit_peso = document.getElementById('fic_cons_vit_peso').value;
	 	   var _fic_cons_vit_talla = document.getElementById('fic_cons_vit_talla').value;
	 	   var _fic_cons_vit_indice_masa_corporal = document.getElementById('fic_cons_vit_indice_masa_corporal').value;
	 	   var _fic_cons_vit_perimetro_abdominal = document.getElementById('fic_cons_vit_perimetro_abdominal').value;
	 	
	 	 
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_fic_cons_vit_presion_arterial=="" || _fic_cons_vit_presion_arterial.length == 0){
			   $("#mensaje_fic_cons_vit_presion_arterial").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_cons_vit_temperatura=="" || _fic_cons_vit_temperatura.length == 0){
			   $("#mensaje_fic_cons_vit_temperatura").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_cons_vit_frecuencia_cardiaca=="" || _fic_cons_vit_frecuencia_cardiaca.length == 0){
			   $("#mensaje_fic_cons_vit_frecuencia_cardiaca").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	  if(_fic_cons_vit_saturacion_oxigeno=="" || _fic_cons_vit_saturacion_oxigeno.length == 0){
			   $("#mensaje_fic_cons_vit_saturacion_oxigeno").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	 if(_fic_cons_vit_frecuencia_respiratoria=="" || _fic_cons_vit_frecuencia_respiratoria.length == 0){
			   $("#mensaje_fic_cons_vit_frecuencia_respiratoria").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	if(_fic_cons_vit_peso=="" || _fic_cons_vit_peso.length == 0){
			   $("#mensaje_fic_cons_vit_peso").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	if(_fic_cons_vit_talla=="" || _fic_cons_vit_talla.length == 0){
			   $("#mensaje_fic_cons_vit_talla").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	if(_fic_cons_vit_indice_masa_corporal=="" || _fic_cons_vit_indice_masa_corporal.length == 0){
			   $("#mensaje_fic_cons_vit_indice_masa_corporal").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	if(_fic_cons_vit_perimetro_abdominal=="" || _fic_cons_vit_perimetro_abdominal.length == 0){
			   $("#mensaje_fic_cons_vit_perimetro_abdominal").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 
	 	 			
	 	 			
	 	 			fic_id:_fic_id,
	 	 			fic_cons_vit_presion_arterial:_fic_cons_vit_presion_arterial,
	 	 			fic_cons_vit_temperatura:_fic_cons_vit_temperatura,
	 	 			fic_cons_vit_frecuencia_cardiaca:_fic_cons_vit_frecuencia_cardiaca,
	 	 			fic_cons_vit_saturacion_oxigeno:_fic_cons_vit_saturacion_oxigeno,
	 	 			fic_cons_vit_frecuencia_respiratoria:_fic_cons_vit_frecuencia_respiratoria,
	 	 			fic_cons_vit_peso:_fic_cons_vit_peso,
	 	 			fic_cons_vit_talla:_fic_cons_vit_talla,
	 	 			fic_cons_vit_indice_masa_corporal:_fic_cons_vit_indice_masa_corporal,
	 	 			fic_cons_vit_perimetro_abdominal:_fic_cons_vit_perimetro_abdominal
	 	 			
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaConstanteVital&action=InsertafichaConstanteVital",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_cons_vit_presion_arterial").val("");
	 				$("#fic_cons_vit_temperatura").val("");
	 				$("#fic_cons_vit_frecuencia_cardiaca").val("");
	 				$("#fic_cons_vit_saturacion_oxigeno").val("");
	 				$("#fic_cons_vit_frecuencia_respiratoria").val("");
	 				$("#fic_cons_vit_peso").val("");
	 				$("#fic_cons_vit_talla").val("");
	 				$("#fic_cons_vit_indice_masa_corporal").val("");
	 				$("#fic_cons_vit_perimetro_abdominal").val("");
	 				
	 				
	 				search_ficha_constante_vital(1);
	 				
	 				swal({
	 			  		  title: "Agregando Constantes Vitales",
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

	    
	    
	    

	    function search_ficha_constante_vital(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#loadfichaConstanteVital").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaConstanteVital&action=search_ficha_constante_vital",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_constante_vital_registrados").html(datos);	
	    		 $("#loadfichaConstanteVital").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaConstanteVital(fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaConstanteVital&action=editfichaConstanteVital",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#fic_cons_vit_presion_arterial").val(array.fic_cons_vit_presion_arterial);
	    			$("#fic_cons_vit_temperatura").val(array.fic_cons_vit_temperatura);
	    			$("#fic_cons_vit_frecuencia_cardiaca").val(array.fic_cons_vit_frecuencia_cardiaca);
	    			$("#fic_cons_vit_saturacion_oxigeno").val(array.fic_cons_vit_saturacion_oxigeno);
	    			$("#fic_cons_vit_frecuencia_respiratoria").val(array.fic_cons_vit_frecuencia_respiratoria);
	    			$("#fic_cons_vit_peso").val(array.fic_cons_vit_peso);
	    			$("#fic_cons_vit_talla").val(array.fic_cons_vit_talla);
	    			$("#fic_cons_vit_indice_masa_corporal").val(array.fic_cons_vit_indice_masa_corporal);
	    			$("#fic_cons_vit_perimetro_abdominal").val(array.fic_cons_vit_perimetro_abdominal);
					
	    			
	    			$("html, body").animate({ scrollTop: $("#fic_cons_vit_presion_arterial").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaConstanteVital(fic_cons_vit_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaConstanteVital&action=delfichaConstanteVital",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_cons_vit_id:fic_cons_vit_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Constantes Vitales",
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
	    		search_ficha_constante_vital(1);
	    	})
	    	
	    	return false;
	    }




