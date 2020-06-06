$(document).ready(function(){
	search_ficha_revision_organos(1);
	carga_organos();
	
})
   function AgregarRevisionOrganos(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _org_id = document.getElementById('org_id').value;
	 	   var _fic_rev_org_descripcion = document.getElementById('fic_rev_org_descripcion').value;
	 	
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_org_id == 0){
	 		   $("#mensaje_org_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   
	 	   if(_fic_rev_org_descripcion=="" || _fic_rev_org_descripcion.length == 0){
	 			   $("#mensaje_fic_rev_org_descripcion").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 	   }
	 	   
	 	
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 			
	 	 			fic_id:_fic_id,
	 	 			org_id:_org_id,
	 	 			fic_rev_org_descripcion:_fic_rev_org_descripcion
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaRevisionOrganos&action=InsertafichaRevisionOrganos",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#org_id").val("0");
	 				$("#fic_rev_org_descripcion").val("");
	 				
	 				search_ficha_revision_organos(1);
	 				
	 				swal({
	 			  		  title: "Agregando Revisión Organos",
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

	    
	    
	    

	    function search_ficha_revision_organos(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#loadfichaRevisionOrganos").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaRevisionOrganos&action=search_ficha_revision_organos",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_revision_organos_registrados").html(datos);	
	    		 $("#loadfichaRevisionOrganos").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaRevisionOrganos(org_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaRevisionOrganos&action=editfichaRevisionOrganos",
	    		type:"POST",
	    		dataType:"json",
	    		data:{org_id:org_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#org_id").val(array.org_id);			
	    			$("#fic_rev_org_descripcion").val(array.fic_rev_org_descripcion);
	    			
	    			
	    			$("html, body").animate({ scrollTop: $("#org_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaRevisionOrganos(fic_rev_org_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaRevisionOrganos&action=delfichaRevisionOrganos",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_rev_org_id:fic_rev_org_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Revisión Organos",
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
	    		search_ficha_revision_organos(1);
	    	})
	    	
	    	return false;
	    }

function carga_organos(){
	
	let $ddlEmpresa= $("#org_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaRevisionOrganos&action=cargaOrganos",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.org_id +" >" + value.org_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





