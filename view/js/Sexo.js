$(document).ready(function(){
	consultaSexo();
})

$("#frm_sexo").on("submit",function(event){
	
	let _sex_nombre = document.getElementById('sex_nombre').value;
	var _sex_id = document.getElementById('sex_id').value;
	var parametros = {sex_nombre:_sex_nombre,sex_id:_sex_id}
	
	if(_sex_nombre == ""){
		$("#mensaje_nombre_sexo").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=Sexo&action=InsertaSexo",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Sexo",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#sex_id").val(0);
		document.getElementById("frm_sexo").reset();	
		consultaSexo();
	})

	event.preventDefault()
})

function editSexo(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Sexo&action=editSexo",
		type:"POST",
		dataType:"json",
		data:{sex_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#sex_nombre").val(array.sex_nombre);			
			$("#sex_id").val(array.sex_id);
			$("html, body").animate({ scrollTop: $(sex_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaSexo();
	})
	
	return false;
	
}

function delSexo(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Sexo&action=delSexo",
		type:"POST",
		dataType:"json",
		data:{sex_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Sexo",
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
		consultaSexo();
	})
	
	return false;
}

function consultaSexo(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Sexo&action=consultaSexo",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#sexo_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



