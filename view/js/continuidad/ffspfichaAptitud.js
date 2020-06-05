$(document).ready(function(){
	search_ficha_aptitud();
	cargaAptitud();
	
})
   function AgregarAptitud(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _apt_med_id = document.getElementById('apt_med_id').value;
	 	   var _fic_apt_med_observacion = document.getElementById('fic_apt_med_observacion').value;
	 	   var _fic_apt_med_limitacion = document.getElementById('fic_apt_med_limitacion').value;
	 	   
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	  if(_apt_med_id == 0){
	 		   $("#mensaje_apt_med_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   if(_fic_apt_med_observacion=="" || _fic_apt_med_observacion.length == 0){
			   $("#mensaje_fic_apt_med_observacion").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_apt_med_limitacion=="" || _fic_apt_med_limitacion.length == 0){
			   $("#mensaje_fic_apt_med_limitacion").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	  
	 	 
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 		   
	 	 			
	 	 			fic_id:_fic_id,
	 	 			apt_med_id:_apt_med_id,
	 	 			fic_apt_med_observacion:_fic_apt_med_observacion,
	 	 			fic_apt_med_limitacion:_fic_apt_med_limitacion
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaAptitud&action=InsertafichaAptitud",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#apt_med_id").val("0");
	 				$("#fic_apt_med_observacion").val("");
	 				$("#fic_apt_med_limitacion").val("");
	 			
	 				search_ficha_aptitud(1);
	 				
	 				swal({
	 			  		  title: "Agregando Aptitud",
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

	    
	    
	    

	    function search_ficha_aptitud(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaAptitud").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaAptitud&action=search_ficha_aptitud",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_aptitud_registrados").html(datos);	
	    		 $("#consultafichaAptitud").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaAptitud(apt_med_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaAptitud&action=editfichaAptitud",
	    		type:"POST",
	    		dataType:"json",
	    		data:{apt_med_id:apt_med_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#apt_med_id").val(array.apt_med_id);			
	    			$("#fic_apt_med_observacion").val(array.fic_apt_med_observacion);
	    			$("#fic_apt_med_limitacion").val(array.fic_apt_med_limitacion);
	    			
	    			
	    			
	    			$("html, body").animate({ scrollTop: $("#fic_apt_med_observacion").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaAptitud(fic_apt_med_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaAptitud&action=delfichaAptitud",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_apt_med_id:fic_apt_med_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Aptitud",
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
	    		search_ficha_aptitud(1);
	    	})
	    	
	    	return false;
	    }

function cargaAptitud(){
	
	let $ddlEmpresa= $("#apt_med_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaAptitud&action=cargaAptitud",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.apt_med_id +" >" + value.apt_med_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





