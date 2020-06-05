$(document).ready(function(){
	search_ficha_estilo_vida();
	cargaEstiloVida();
	
})
   function AgregarEstiloVida(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _est_vid_id = document.getElementById('est_vid_id').value;
	 	   var _fic_est_vid_practica = document.getElementById('fic_est_vid_practica').value;
	 	   var _fic_est_vid_cual = document.getElementById('fic_est_vid_cual').value;
	 	   var _fic_est_vid_tiempo_cantidad = document.getElementById('fic_est_vid_tiempo_cantidad').value;
	 	
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_est_vid_id == 0){
	 		   $("#mensaje_est_vid_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   if(_fic_est_vid_practica == 0){
	 		   $("#mensaje_fic_est_vid_practica").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   if(_fic_est_vid_cual=="" || _fic_est_vid_cual.length == 0){
	 			   $("#mensaje_fic_est_vid_cual").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 	   }
	 	   if(_fic_est_vid_tiempo_cantidad=="" || _fic_est_vid_tiempo_cantidad.length == 0){
			   $("#mensaje_fic_est_vid_tiempo_cantidad").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	  
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 			
	 	 			fic_id:_fic_id,
	 	 			est_vid_id:_est_vid_id,
	 	 			fic_est_vid_practica:_fic_est_vid_practica,
	 	 			fic_est_vid_cual:_fic_est_vid_cual,
	 	 			fic_est_vid_tiempo_cantidad:_fic_est_vid_tiempo_cantidad
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaEstiloVida&action=InsertafichaEstiloVida",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#est_vid_id").val("0");
	 				$("#fic_est_vid_practica").val("0");
	 				$("#fic_est_vid_cual").val("");
	 				$("#fic_est_vid_tiempo_cantidad").val("");
	 				
	 				search_ficha_estilo_vida(1);
	 				
	 				swal({
	 			  		  title: "Agregando Estilo Vida",
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

	    
	    
	    

	    function search_ficha_estilo_vida(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaEstiloVida").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaEstiloVida&action=search_ficha_estilo_vida",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_estilo_vida_registrados").html(datos);	
	    		 $("#consultafichaEstiloVida").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaEstiloVida(est_vid_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaEstiloVida&action=editfichaEstiloVida",
	    		type:"POST",
	    		dataType:"json",
	    		data:{est_vid_id:est_vid_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#est_vid_id").val(array.est_vid_id);			
	    			$("#fic_est_vid_cual").val(array.fic_est_vid_cual);
	    			$("#fic_est_vid_tiempo_cantidad").val(array.fic_est_vid_tiempo_cantidad);
	    			
	    			
	    			var fic_est_vid_practica = ( array.fic_est_vid_practica == 't' ) ? "TRUE" : "FALSE";
	    			
	    			$("#fic_est_vid_practica").val(fic_est_vid_practica);	
	    			
	    			$("html, body").animate({ scrollTop: $("#est_vid_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaEstiloVida(fic_est_vid_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaEstiloVida&action=delfichaEstiloVida",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_est_vid_id:fic_est_vid_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Estilo Vida Realizados",
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
	    		search_ficha_estilo_vida(1);
	    	})
	    	
	    	return false;
	    }

function cargaEstiloVida(){
	
	let $ddlEmpresa= $("#est_vid_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaEstiloVida&action=cargaEstiloVida",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.est_vid_id +" >" + value.est_vid_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





