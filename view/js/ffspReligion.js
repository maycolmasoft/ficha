$(document).ready(function(){
	consultaReligion();
})

$("#frm_religion").on("submit",function(event){
	
	let _rel_nombre = document.getElementById('rel_nombre').value;
	var _rel_id = document.getElementById('rel_id').value;
	var parametros = {rel_nombre:_rel_nombre,rel_id:_rel_id}
	
	if(_rel_nombre == ""){
		$("#mensaje_nombre_religion").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspReligion&action=InsertaReligion",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Religion",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#rel_id").val(0);
		document.getElementById("frm_religion").reset();	
		consultaReligion();
	})

	event.preventDefault()
})

function editReligion(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspReligion&action=editReligion",
		type:"POST",
		dataType:"json",
		data:{rel_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#rel_nombre").val(array.rel_nombre);			
			$("#rel_id").val(array.rel_id);
			$("html, body").animate({ scrollTop: $(rel_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaReligion();
	})
	
	return false;
	
}

function delReligion(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspReligion&action=delReligion",
		type:"POST",
		dataType:"json",
		data:{rel_id:id}
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
		consultaReligion();
	})
	
	return false;
}

function consultaReligion(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspReligion&action=consultaReligion",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#religion_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



