$(document).ready(function(){
	consultaExamenFisicoRegional();
})

$("#frm_examen_fisico_regional").on("submit",function(event){
	
	let _exa_nombre = document.getElementById('exa_nombre').value;
	var _exa_id = document.getElementById('exa_id').value;
	var parametros = {exa_nombre:_exa_nombre,exa_id:_exa_id}
	
	if(_exa_nombre == ""){
		$("#mensaje_nombre_examen").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ExamenFisicoRegional&action=InsertaExamenFisicoRegional",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Examen",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#exa_id").val(0);
		document.getElementById("frm_examen_fisico_regional").reset();	
		consultaExamenFisicoRegional();
	})

	event.preventDefault()
})

function editExamenFisicoRegional(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ExamenFisicoRegional&action=editExamenFisicoRegional",
		type:"POST",
		dataType:"json",
		data:{exa_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#exa_nombre").val(array.exa_nombre);			
			$("#exa_id").val(array.exa_id);
			$("html, body").animate({ scrollTop: $(exa_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaExamenFisicoRegional();
	})
	
	return false;
	
}

function delExamenFisicoRegional(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ExamenFisicoRegional&action=delExamenFisicoRegional",
		type:"POST",
		dataType:"json",
		data:{exa_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Examen",
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
		consultaExamenFisicoRegional();
	})
	
	return false;
}

function consultaExamenFisicoRegional(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ExamenFisicoRegional&action=consultaExamenFisicoRegional",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#examen_fisico_regional_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



