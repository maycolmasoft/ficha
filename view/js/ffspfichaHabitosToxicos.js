$(document).ready(function(){
	search_ficha_habitos_toxicos();
	cargaHabitosToxicos();
	
})
   function AgregarHabitosToxicos(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _hab_id = document.getElementById('hab_id').value;
	 	   var _fic_hab_tox_consume = document.getElementById('fic_hab_tox_consume').value;
	 	   var _fic_hab_tox_tiempo = document.getElementById('fic_hab_tox_tiempo').value;
	 	   var _fic_hab_tox_cantidad = document.getElementById('fic_hab_tox_cantidad').value;
	 	   var _fic_hab_tox_ex_consumidor = document.getElementById('fic_hab_tox_ex_consumidor').value;
	 	   var _fic_hab_tox_tiempo_abstinencia = document.getElementById('fic_hab_tox_tiempo_abstinencia').value;
	 	
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_hab_id == 0){
	 		   $("#mensaje_hab_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   if(_fic_hab_tox_consume == 0){
	 		   $("#mensaje_fic_hab_tox_consume").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   if(_fic_hab_tox_tiempo=="" || _fic_hab_tox_tiempo.length == 0){
	 			   $("#mensaje_fic_hab_tox_tiempo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 	   }
	 	   if(_fic_hab_tox_cantidad=="" || _fic_hab_tox_cantidad.length == 0){
			   $("#mensaje_fic_hab_tox_cantidad").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_hab_tox_ex_consumidor=="" || _fic_hab_tox_ex_consumidor.length == 0){
			   $("#mensaje_fic_hab_tox_ex_consumidor").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_hab_tox_tiempo_abstinencia=="" || _fic_hab_tox_tiempo_abstinencia.length == 0){
			   $("#mensaje_fic_hab_tox_tiempo_abstinencia").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 			
	 	 			fic_id:_fic_id,
	 	 			hab_id:_hab_id,
	 	 			fic_hab_tox_consume:_fic_hab_tox_consume,
	 	 			fic_hab_tox_tiempo:_fic_hab_tox_tiempo,
	 	 			fic_hab_tox_cantidad:_fic_hab_tox_cantidad,
	 	 			fic_hab_tox_ex_consumidor:_fic_hab_tox_ex_consumidor,
	 	 			fic_hab_tox_tiempo_abstinencia:_fic_hab_tox_tiempo_abstinencia
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaHabitosToxicos&action=InsertafichaHabitosToxicos",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#hab_id").val("0");
	 				$("#fic_hab_tox_consume").val("0");
	 				$("#fic_hab_tox_tiempo").val("");
	 				$("#fic_hab_tox_cantidad").val("");
	 				$("#fic_hab_tox_ex_consumidor").val("");
	 				$("#fic_hab_tox_tiempo_abstinencia").val("");
	 				
	 				search_ficha_habitos_toxicos(1);
	 				
	 				swal({
	 			  		  title: "Agregando Habitos Toxicos",
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

	    
	    
	    

	    function search_ficha_habitos_toxicos(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaHabitosToxicos").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaHabitosToxicos&action=search_ficha_habitos_toxicos",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_habitos_toxicos_registrados").html(datos);	
	    		 $("#consultafichaHabitosToxicos").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaHabitosToxicos(hab_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaHabitosToxicos&action=editfichaHabitosToxicos",
	    		type:"POST",
	    		dataType:"json",
	    		data:{hab_id:hab_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#hab_id").val(array.hab_id);			
	    			//$("#fic_hab_tox_consume").val(array.fic_hab_tox_consume);
	    			$("#fic_hab_tox_tiempo").val(array.fic_hab_tox_tiempo);
	    			$("#fic_hab_tox_cantidad").val(array.fic_hab_tox_cantidad);
	    			$("#fic_hab_tox_ex_consumidor").val(array.fic_hab_tox_ex_consumidor);
	    			$("#fic_hab_tox_tiempo_abstinencia").val(array.fic_hab_tox_tiempo_abstinencia);
	    			
	    			
	    			var fic_hab_tox_consume = ( array.fic_hab_tox_consume == 't' ) ? "TRUE" : "FALSE";
	    			
	    			$("#fic_hab_tox_consume").val(fic_hab_tox_consume);	
	    			
	    			$("html, body").animate({ scrollTop: $("#hab_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaHabitosToxicos(fic_hab_tox_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaHabitosToxicos&action=delfichaHabitosToxicos",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_hab_tox_id:fic_hab_tox_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Hábitos Tóxicos Realizados",
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
	    		search_ficha_habitos_toxicos(1);
	    	})
	    	
	    	return false;
	    }

function cargaHabitosToxicos(){
	
	let $ddlEmpresa= $("#hab_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaHabitosToxicos&action=cargaHabitosToxicos",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.hab_id +" >" + value.hab_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





