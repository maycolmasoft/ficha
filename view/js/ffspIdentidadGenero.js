$(document).ready(function(){
	consultaIdentidadGenero();
})

$("#frm_IdentidadGenero").on("submit",function(event){
	
	let _ide_nombre = document.getElementById('ide_nombre').value;
	var _ide_id = document.getElementById('ide_id').value;
	var parametros = {ide_nombre:_ide_nombre,ide_id:_ide_id}
	
	if(_ide_nombre == ""){
		$("#mensaje_nombre_identidad_genero").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspIdentidadGenero&action=InsertaIdentidadGenero",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Identidad Genero",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#ide_id").val(0);
		document.getElementById("frm_IdentidadGenero").reset();	
		consultaIdentidadGenero();
	})

	event.preventDefault()
})

function editIdentidadGenero(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspIdentidadGenero&action=editIdentidadGenero",
		type:"POST",
		dataType:"json",
		data:{ide_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#ide_nombre").val(array.ide_nombre);			
			$("#ide_id").val(array.ide_id);
			$("html, body").animate({ scrollTop: $(ide_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaIdentidadGenero();
	})
	
	return false;
	
}

function delIdentidadGenero(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspIdentidadGenero&action=delIdentidadGenero",
		type:"POST",
		dataType:"json",
		data:{ide_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Religion",
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
		consultaIdentidadGenero();
	})
	
	return false;
}

function consultaIdentidadGenero(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspIdentidadGenero&action=consultaIdentidadGenero",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#identidad_genero_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



