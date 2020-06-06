$(document).ready(function(){
	search_ficha_accidente_trabajo();

})
   function AgregarAccidenteTrabajo(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_acc_tra_fue_calificado = document.getElementById('fic_acc_tra_fue_calificado').value;
	 	   var _fic_acc_tra_especificar = document.getElementById('fic_acc_tra_especificar').value;
	 	   var _fic_acc_tra_fecha = document.getElementById('fic_acc_tra_fecha').value;
	 	   var _fic_acc_tra_observaciones = document.getElementById('fic_acc_tra_observaciones').value;
	 	   
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	  if(_fic_acc_tra_fue_calificado == 0){
	 		   $("#mensaje_fic_acc_tra_fue_calificado").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	  if(_fic_acc_tra_especificar=="" || _fic_acc_tra_especificar.length == 0){
			   $("#mensaje_fic_acc_tra_especificar").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	 if(_fic_acc_tra_fecha=="" || _fic_acc_tra_fecha.length == 0){
			   $("#mensaje_fic_acc_tra_fecha").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	if(_fic_acc_tra_observaciones=="" || _fic_acc_tra_observaciones.length == 0){
			   $("#mensaje_fic_acc_tra_observaciones").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	  }
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 
	 	 			fic_id:_fic_id,
	 	 			fic_acc_tra_fue_calificado:_fic_acc_tra_fue_calificado,
	 	 			fic_acc_tra_especificar:_fic_acc_tra_especificar,
	 	 			fic_acc_tra_fecha:_fic_acc_tra_fecha,
	 	 			fic_acc_tra_observaciones:_fic_acc_tra_observaciones
	 	 			
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaAccidenteTrabajo&action=InsertafichaAccidenteTrabajo",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_acc_tra_fue_calificado").val("");
	 				$("#fic_acc_tra_especificar").val("");
	 				$("#fic_acc_tra_fecha").val("");
	 				$("#fic_acc_tra_observaciones").val("");
	 				
	 				
	 				search_ficha_accidente_trabajo(1);
	 				
	 				swal({
	 			  		  title: "Agregando Accidentes de Trabajo",
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

	    
	    
	    

	    function search_ficha_accidente_trabajo(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaAccidenteTrabajo").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaAccidenteTrabajo&action=search_ficha_accidente_trabajo",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_accidente_trabajo_registrados").html(datos);	
	    		 $("#consultafichaAccidenteTrabajo").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaAccidenteTrabajo(fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaAccidenteTrabajo&action=editfichaAccidenteTrabajo",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    		
	    			$("#fic_acc_tra_especificar").val(array.fic_acc_tra_especificar);
	    			$("#fic_acc_tra_fecha").val(array.fic_acc_tra_fecha);
	    			$("#fic_acc_tra_observaciones").val(array.fic_acc_tra_observaciones);
					
	    			var fic_acc_tra_fue_calificado = ( array.fic_acc_tra_fue_calificado == 't' ) ? "TRUE" : "FALSE";
	    			
	    			$("#fic_acc_tra_fue_calificado").val(fic_acc_tra_fue_calificado);	
	    			
	    			$("html, body").animate({ scrollTop: $("#fic_acc_tra_fue_calificado").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaAccidenteTrabajo(fic_acc_tra_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaAccidenteTrabajo&action=delfichaAccidenteTrabajo",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_acc_tra_id:fic_acc_tra_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Accidentes de Trabajo",
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
	    		search_ficha_accidente_trabajo(1);
	    	})
	    	
	    	return false;
	    }




