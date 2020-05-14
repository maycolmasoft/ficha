$(document).ready(function(){
	consultaDiscapacidad();
})

$("#frm_Discapacidad").on("submit",function(event){
	
	let _dis_descripcion = document.getElementById('dis_descripcion').value;
	let _dis_tipo = document.getElementById('dis_tipo').value;
	let _dis_porcentaje = document.getElementById('dis_porcentaje').value;
	var _dis_id = document.getElementById('dis_id').value;
	var parametros = {dis_descripcion:_dis_descripcion,dis_tipo:_dis_tipo,dis_porcentaje:_dis_porcentaje,dis_id:_dis_id}
	
	if(_dis_descripcion == ""){
		$("#mensaje_dis_descripcion").text("Ingrese una Descripción").fadeIn("Slow");
		return false;
	}
	
	if(_dis_tipo == ""){
		$("#mensaje_dis_tipo").text("Ingrese un tipo").fadeIn("Slow");
		return false;
	}
	
	if(_dis_porcentaje == ""){
		$("#mensaje_dis_porcentaje").text("Ingrese un Porcentaje").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspDiscapacidad&action=InsertaDiscapacidad",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Discapacidad",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#dis_id").val(0);
		document.getElementById("frm_Discapacidad").reset();	
		consultaDiscapacidad();
	})

	event.preventDefault()
})

function editDiscapacidad(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspDiscapacidad&action=editDiscapacidad",
		type:"POST",
		dataType:"json",
		data:{dis_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#dis_descripcion").val(array.dis_descripcion);
			$("#dis_tipo").val(array.dis_tipo);	
			$("#dis_porcentaje").val(array.dis_porcentaje);	
			$("#dis_id").val(array.ide_id);
			$("html, body").animate({ scrollTop: $(dis_descripcion).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaDiscapacidad();
	})
	
	return false;
	
}

function delDiscapacidad(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspDiscapacidad&action=delDiscapacidad",
		type:"POST",
		dataType:"json",
		data:{dis_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Discapacidad",
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
		consultaDiscapacidad();
	})
	
	return false;
}

function consultaDiscapacidad(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspDiscapacidad&action=consultaDiscapacidad",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#discapacidad_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



