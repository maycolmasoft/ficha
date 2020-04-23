$(document).ready(function(){
	consultaFactoresRiesgo();
})

$("#frm_factores_riesgo").on("submit",function(event){
	
	let _fac_nombre = document.getElementById('fac_nombre').value;
	var _fac_id = document.getElementById('fac_id').value;
	var parametros = {fac_nombre:_fac_nombre,fac_id:_fac_id}
	
	if(_fac_nombre == ""){
		$("#mensaje_nombre_factores_riesgo").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=FactoresRiesgo&action=InsertaFactoresRiesgo",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Factores Riesgo",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#fac_id").val(0);
		document.getElementById("frm_factores_riesgo").reset();	
		consultaFactoresRiesgo();
	})

	event.preventDefault()
})

function editFactoresRiesgo(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=FactoresRiesgo&action=editFactoresRiesgo",
		type:"POST",
		dataType:"json",
		data:{fac_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#fac_nombre").val(array.fac_nombre);			
			$("#fac_id").val(array.fac_id);
			$("html, body").animate({ scrollTop: $(fac_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaFactoresRiesgo();
	})
	
	return false;
	
}

function delFactoresRiesgo(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=FactoresRiesgo&action=delFactoresRiesgo",
		type:"POST",
		dataType:"json",
		data:{fac_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Factores Riesgo",
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
		consultaFactoresRiesgo();
	})
	
	return false;
}

function consultaFactoresRiesgo(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=FactoresRiesgo&action=consultaFactoresRiesgo",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#factores_riesgo_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



