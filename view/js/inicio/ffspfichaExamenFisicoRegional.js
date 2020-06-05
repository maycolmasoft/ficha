$(document).ready(function(){
	search_ficha_examen_regional(1);
	carga_examen_regional();
	
})
   function AgregarExamenRegional(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _exam_id = document.getElementById('exam_id').value;
	 	   var _fic_exa_fis_reg_observacion = document.getElementById('fic_exa_fis_reg_observacion').value;
	 	
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_exam_id == 0){
	 		   $("#mensaje_exam_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   
	 	   if(_fic_exa_fis_reg_observacion=="" || _fic_exa_fis_reg_observacion.length == 0){
	 			   $("#mensaje_fic_exa_fis_reg_observacion").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 	   }
	 	   
	 	
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 			
	 	 			fic_id:_fic_id,
	 	 			exam_id:_exam_id,
	 	 			fic_exa_fis_reg_observacion:_fic_exa_fis_reg_observacion
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaExamenFisicoRegional&action=InsertafichaExamenFisicoRegional",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#exam_id").val("0");
	 				$("#fic_exa_fis_reg_observacion").val("");
	 				
	 				search_ficha_examen_regional(1);
	 				
	 				swal({
	 			  		  title: "Agregando Exámen Físico Regional",
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

	    
	    
	    

	    function search_ficha_examen_regional(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#loadfichaExamenFisicoRegional").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaExamenFisicoRegional&action=search_ficha_examen_regional",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_examen_fisico_regional_registrados").html(datos);	
	    		 $("#loadfichaExamenFisicoRegional").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaExamenFisicoRegional(exam_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaExamenFisicoRegional&action=editfichaExamenFisicoRegional",
	    		type:"POST",
	    		dataType:"json",
	    		data:{exam_id:exam_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#exam_id").val(array.exam_id);			
	    			$("#fic_exa_fis_reg_observacion").val(array.fic_exa_fis_reg_observacion);
	    			
	    			
	    			$("html, body").animate({ scrollTop: $("#exam_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaExamenFisicoRegional(fic_exa_fis_reg_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaExamenFisicoRegional&action=delfichaExamenFisicoRegional",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_exa_fis_reg_id:fic_exa_fis_reg_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Exámen Físico Regional",
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
	    		search_ficha_examen_regional(1);
	    	})
	    	
	    	return false;
	    }

function carga_examen_regional(){
	
	let $ddlEmpresa= $("#exam_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaExamenFisicoRegional&action=carga_examen_regional",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.exam_id +" >" + value.exam_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





