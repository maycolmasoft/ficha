$(document).ready(function(){
	search_ficha_factor_riesgo_detalle(1);
	cargaFactorRiesgoFicha();
	cargaFactorRiesgoCabeza();
	
	
})

	
	
  function AgregarFactorRiesgoDetalle(){
	   
	    
	   var _fic_fact_ries_id = document.getElementById('fic_fact_ries_id').value;
	   var _fact_id = document.getElementById('fact_id').value;
	   var _fic_fact_ries_det_otros = document.getElementById('fic_fact_ries_det_otros').value;
	
	   
	   if(_fic_fact_ries_id == 0){
		   $("#mensaje_fic_fact_ries_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
		}
	   if(_fact_id == 0){
		   $("#mensaje_fact_id").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	
	   $("#aplicar").attr({disabled:true});
		
	   
	 	var parametros = {
	 			
	 			fic_fact_ries_id:_fic_fact_ries_id,
	 			fact_id:_fact_id,
	 			fic_fact_ries_det_otros:_fic_fact_ries_det_otros
	 			
		         }
 
		$.ajax({
			beforeSend:function(){},
			url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=InsertafichaFactorRiesgoDetalle",
			type:"POST",
			dataType:"json",
			data:parametros
		}).done(function(datos){
			
			if(datos.respuesta > 0){
				
				
				$("#fac_id_detalle").val("0");
				$("#fact_id").val("0");
				$("#fic_fact_ries_det_otros").val("");
				
				
				
				search_ficha_factor_riesgo_detalle(1);
			      
				
				swal({
			  		  title: "Agregando Factor Riesgo Detalle",
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


  function search_ficha_factor_riesgo_detalle(_page = 1){
  	
  	 var _fic_id = document.getElementById('fic_id').value;
  	 var _fic_fact_ries_id = document.getElementById('fic_fact_ries_id').value;
  	  
  	
  	$.ajax({
  		beforeSend:function(){$("#consultafichaFactorRiesgoDetalle").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
	    	    
  		url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=search_ficha_factor_riesgo_detalle",
  		type:"POST",
  		data:{page:_page,peticion:'ajax', fic_fact_ries_id:_fic_fact_ries_id, fic_id:_fic_id}
  	}).done(function(datos){		
  		
  		$("#ficha_factor_riesgo_detalle_registrados").html(datos);	
  		 $("#consultafichaFactorRiesgoDetalle").html("");
  		
  	}).fail(function(xhr,status,error){
  		
  		var err = xhr.responseText
  		console.log(err);
  		
  	})
  }
  
  function editfichaFactorRiesgoDetalle(fact_id, fic_fact_ries_id){
  	
  	var tiempo = tiempo || 1000;
  		
  	$.ajax({
  		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
  		url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=editfichaFactorRiesgoDetalle",
  		type:"POST",
  		dataType:"json",
  		data:{fact_id:fact_id, fic_fact_ries_id:fic_fact_ries_id}
  	}).done(function(datos){
  		
  		if(!jQuery.isEmptyObject(datos.data)){
  			
  			var array = datos.data[0];		
  			
  			$("#fact_id").val(array.fact_id);			
  			$("#fic_fact_ries_det_otros").val(array.fic_fact_ries_det_otros);
  			
  			
  		
  			
  			$("html, body").animate({ scrollTop: $("#fic_fact_ries_det_otros").offset().top-120 }, tiempo);			
  		}
  		
  		
  		
  		
  	}).fail(function(xhr,status,error){
  		
  		var err = xhr.responseText
  		console.log(err);
  	}).always(function(){
  		
  		$("#divLoaderPage").removeClass("loader")
  		
  	})
  	
  	return false;
  	
  }

  function delfichaFactorRiesgoDetalle(fic_fact_ries_det_id){
  	
		
  	$.ajax({
  		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
  		url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=delfichaFactorRiesgoDetalle",
  		type:"POST",
  		dataType:"json",
  		data:{fic_fact_ries_det_id:fic_fact_ries_det_id}
  	}).done(function(datos){		
  		
  		if(datos.data > 0){
  			
  			swal({
  		  		  title: "Factor Riesgo Detalle Realizados",
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
  		search_ficha_factor_riesgo_detalle(1);
  	})
  	
  	return false;
  }


  function cargaFactorRiesgoFicha(){
  	
  	let $ddlEmpresa= $("#fic_fact_ries_id");
  	var fic_id = document.getElementById('fic_id').value;
  		
  	$.ajax({
  		beforeSend:function(){},
  		url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=cargaFactorRiesgoFicha",
  		type:"POST",
  		dataType:"json",
  		data:{fic_id:fic_id}
  	}).done(function(datos){		
  		
  		$ddlEmpresa.empty();
  		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
  		
  		$.each(datos.data, function(index, value) {
  			$ddlEmpresa.append("<option value= " +value.fic_fact_ries_id +" >" + value.fic_fact_ries_puesto_trabajo  + "</option>");	
    		});
  		
  	}).fail(function(xhr,status,error){
  		var err = xhr.responseText
  		console.log(err)
  		$ddlEmpresa.empty();
  	})
  	
  }
  function cargaFactorRiesgoCabeza(){
  	
  	let $ddlEmpresa1= $("#fac_id_detalle");
  	
  	$.ajax({
  		beforeSend:function(){},
  		url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=cargaFactorRiesgoCabeza",
  		type:"POST",
  		dataType:"json",
  		data:null
  	}).done(function(datos){		
  		
  		$ddlEmpresa1.empty();
  		$ddlEmpresa1.append("<option value='0' >--Seleccione--</option>");
  		
  		$.each(datos.data, function(index, value) {
  			$ddlEmpresa1.append("<option value= " +value.fac_id+" >" + value.fac_nombre  + "</option>");	
    		});
  		
  	}).fail(function(xhr,status,error){
  		var err = xhr.responseText
  		console.log(err)
  		$ddlEmpresa1.empty();
  	})
  	
  }
  function cargaFactorRiesgoDetalle(fac_id){
  	
  	let $ddlEmpresa2= $("#fact_id");
  	  
  	
  	$.ajax({
  		beforeSend:function(){},
  		url:"index.php?controller=ffspfichaFactorRiesgoDetalle&action=cargaFactorRiesgoDetalle",
  		type:"POST",
  		dataType:"json",
  		data:{fac_id:fac_id}
  	}).done(function(datos){		
  		
  		$ddlEmpresa2.empty();
  		$ddlEmpresa2.append("<option value='0' >--Seleccione--</option>");
  		
  		$.each(datos.data, function(index, value) {
  			$ddlEmpresa2.append("<option value= " +value.fact_id +" >" + value.fact_nombre  + "</option>");	
    		});
  		
  	}).fail(function(xhr,status,error){
  		var err = xhr.responseText
  		console.log(err)
  		$ddlEmpresa2.empty();
  		$ddlEmpresa2.append("<option value='0' >--Seleccione--</option>");
  		
  	})
  	
  }


  $("#fac_id_detalle").click(function() {
  	
      var fac_id_detalle = $(this).val();
      
  	cargaFactorRiesgoDetalle(fac_id_detalle);
      
      
      
      
    });
    
    $("#fac_id_detalle").change(function() {
  		    
          var fac_id_detalle = $(this).val();

      	cargaFactorRiesgoDetalle(fac_id_detalle);
          
  	    });
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        if ((target == '#detalle')) {
        	cargaFactorRiesgoFicha();
        	
        } 
    });
    
    $("#fic_fact_ries_id").click(function() {
      	
        var fic_fact_ries_id = $(this).val();
        
        search_ficha_factor_riesgo_detalle(1);
        
        
        
        
      });
      
      $("#fic_fact_ries_id").change(function() {
    		    
            var fic_fact_ries_id = $(this).val();

            search_ficha_factor_riesgo_detalle(1);
            
    	    });
  