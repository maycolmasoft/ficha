$(document).ready(function(){

	search_ficha_antecedentes_familiares(1);
	cargaAntecendentesFamiliares();
	
})
   function AgregarAntecedentesFamiliares(){
	 	   
	 	    
	 	   var _fic_id = document.getElementById('fic_id').value;
	 	   var _ant_id = document.getElementById('ant_id').value;
	 	   var _fic_ant_fam_descripcion = document.getElementById('fic_ant_fam_descripcion').value;
	 	
	 	   
	 	   if(_fic_id == 0){
	 		   $("#mensaje_fic_id").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 		}
	 	   if(_ant_id == 0){
	 		   $("#mensaje_ant_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
	 			return false;
	 	   }
	 	   
	 	   if(_fic_ant_fam_descripcion=="" || _fic_ant_fam_descripcion.length == 0){
	 			   $("#mensaje_fic_ant_fam_descripcion").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
	 				return false; 
	 	   }
	 	   
	 	
	 	   $("#aplicar").attr({disabled:true});
	 		
	 	   
	 	 	var parametros = {
	 	 			
	 	 			fic_id:_fic_id,
	 	 			ant_id:_ant_id,
	 	 			fic_ant_fam_descripcion:_fic_ant_fam_descripcion
	 	 			
	 		         }
	  
	 		$.ajax({
	 			beforeSend:function(){},
	 			url:"index.php?controller=ffspfichaAntecedentesFamiliares&action=InsertafichaAntecedentesFamiliares",
	 			type:"POST",
	 			dataType:"json",
	 			data:parametros
	 		}).done(function(datos){
	 			
	 			if(datos.respuesta > 0){
	 				
	 				
	 				$("#ant_id").val("0");
	 				$("#fic_ant_fam_descripcion").val("");
	 				
	 				search_ficha_antecedentes_familiares(1);
	 				
	 				swal({
	 			  		  title: "Agregando Antecedentes Familiares",
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

	    
	    
	    

	    function search_ficha_antecedentes_familiares(_page = 1){
	    	
	    	 var _fic_id = document.getElementById('fic_id').value;
	    	  
	    	
	    	$.ajax({
	    		beforeSend:function(){$("#loadfichaAntecedentesFamiliares").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		    	    
	    		url:"index.php?controller=ffspfichaAntecedentesFamiliares&action=search_ficha_antecedentes_familiares",
	    		type:"POST",
	    		data:{page:_page,peticion:'ajax', fic_id:_fic_id}
	    	}).done(function(datos){		
	    		
	    		$("#ficha_antecedentes_familiares_registrados").html(datos);	
	    		 $("#loadfichaAntecedentesFamiliares").html("");
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    		
	    	})
	    }
	    
	    
	    function editfichaAntecedentesFamiliares(ant_id, fic_id){
	    	
	    	var tiempo = tiempo || 1000;
	    		
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaAntecedentesFamiliares&action=editfichaAntecedentesFamiliares",
	    		type:"POST",
	    		dataType:"json",
	    		data:{ant_id:ant_id, fic_id:fic_id}
	    	}).done(function(datos){
	    		
	    		if(!jQuery.isEmptyObject(datos.data)){
	    			
	    			var array = datos.data[0];		
	    			
	    			$("#ant_id").val(array.ant_id);			
	    			$("#fic_ant_fam_descripcion").val(array.fic_ant_fam_descripcion);
	    			
	    			
	    			$("html, body").animate({ scrollTop: $("#ant_id").offset().top-120 }, tiempo);			
	    		}
	    		
	    		
	    		
	    		
	    	}).fail(function(xhr,status,error){
	    		
	    		var err = xhr.responseText
	    		console.log(err);
	    	}).always(function(){
	    		
	    		$("#divLoaderPage").removeClass("loader")
	    		
	    	})
	    	
	    	return false;
	    	
	    }

	    
	    function delfichaAntecedentesFamiliares(fic_ant_fam_id){
	    	
			
	    	$.ajax({
	    		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
	    		url:"index.php?controller=ffspfichaAntecedentesFamiliares&action=delfichaAntecedentesFamiliares",
	    		type:"POST",
	    		dataType:"json",
	    		data:{fic_ant_fam_id:fic_ant_fam_id}
	    	}).done(function(datos){		
	    		
	    		if(datos.data > 0){
	    			
	    			swal({
	    		  		  title: "Antecedentes Familiares",
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
	    		search_ficha_antecedentes_familiares(1);
	    	})
	    	
	    	return false;
	    }

function cargaAntecendentesFamiliares(){
	
	let $ddlEmpresa= $("#ant_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspfichaAntecedentesFamiliares&action=cargaAntecedentesFamiliares",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.ant_id +" >" + value.ant_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}





