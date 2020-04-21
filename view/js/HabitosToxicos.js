$(document).ready(function(){
	consultaHabitosToxicos();
})

$("#frm_habitos_toxicos").on("submit",function(event){
	
	let _hab_nombre = document.getElementById('hab_nombre').value;
	var _hab_id = document.getElementById('hab_id').value;
	var parametros = {hab_nombre:_hab_nombre,hab_id:_hab_id}
	
	if(_hab_nombre == ""){
		$("#mensaje_nombre_habitos_toxicos").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=HabitosToxicos&action=InsertaHabitosToxicos",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Habitos Toxicos",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#hab_id").val(0);
		document.getElementById("frm_habitos_toxicos").reset();	
		consultaHabitosToxicos();
	})

	event.preventDefault()
})

function editHabitosToxicos(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=HabitosToxicos&action=editHabitosToxicos",
		type:"POST",
		dataType:"json",
		data:{hab_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#hab_nombre").val(array.hab_nombre);			
			$("#hab_id").val(array.hab_id);
			$("html, body").animate({ scrollTop: $(hab_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaHabitosToxicos();
	})
	
	return false;
	
}

function delHabitosToxicos(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=HabitosToxicos&action=delHabitosToxicos",
		type:"POST",
		dataType:"json",
		data:{hab_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Habitos Toxicos",
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
		consultaHabitosToxicos();
	})
	
	return false;
}

function consultaHabitosToxicos(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=HabitosToxicos&action=consultaHabitosToxicos",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#habitos_toxicos_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



