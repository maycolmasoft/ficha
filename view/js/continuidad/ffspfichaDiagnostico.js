$(document).ready(function(){
	search_ficha_diagnostico();
	cargaTipoDiagnostico();
	
})
   function AgregarDiagnostico(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _fic_diag_descripcion = document.getElementById('fic_diag_descripcion').value;
	 	   var _fic_diag_cie = document.getElementById('fic_diag_cie').value;
	 	   var _tip_diag_id = document.getElementById('tip_diag_id').value;
	 	   
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_fic_diag_descripcion=="" || _fic_diag_descripcion.length == 0){
			   $("#mensaje_fic_diag_descripcion").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	   if(_fic_diag_cie=="" || _fic_diag_cie.length == 0){
			   $("#mensaje_fic_diag_cie").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
	 	   }
	 	  if(_tip_diag_id == 0){
	 		   $("#mensaje_tip_diag_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	 
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 		   
	 	 			
	 	 			fic_id:_fic_id,
	 	 			fic_diag_descripcion:_fic_diag_descripcion,
	 	 			fic_diag_cie:_fic_diag_cie,
	 	 			tip_diag_id:_tip_diag_id
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaDiagnostico&action=InsertafichaDiagnostico",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#fic_diag_descripcion").val("");
	 				$("#fic_diag_cie").val("");
	 				$("#tip_diag_id").val("0");
	 			
	 				search_ficha_diagnostico(1);
	 				
	 				swal({
	 			  		  title: "Agregando Diagnostico",
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

	    
	    
	    

	    function search_ficha_diagnostico(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#consultafichaDiagnostico").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaDiagnostico&action=search_ficha_diagnostico",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_diagnostico_registrados").html(datos);	
	    		 $("#consultafichaDiagnostico").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaDiagnostico(tip_diag_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaDiagnostico&action=editfichaDiagnostico",
	    		type:"POST",
	    		dataType:"json",
	    		data:{tip_diag_id:tip_diag_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#fic_diag_descripcion").val(array.fic_diag_descripcion);			
	    			$("#fic_diag_cie").val(array.fic_diag_cie);
	    			$("#tip_diag_id").val(array.tip_diag_id);
	    			
	    			
	    			
	    			$("html, body").animate({ scrollTop: $("#fic_diag_descripcion").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaDiagnostico(fic_diag_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaDiagnostico&action=delfichaDiagnostico",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_diag_id:fic_diag_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Diagnostico",
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
	    		search_ficha_diagnostico(1);
	    	})
	    	
	    	return false;
	    }

function cargaTipoDiagnostico(){
	
	let $ddlEmpresa= $("#tip_diag_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaDiagnostico&action=cargaTipoDiagnostico",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.tip_diag_id +" >" + value.tip_diag_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





