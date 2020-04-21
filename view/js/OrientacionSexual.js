$(document).ready(function(){
	consultaOrientacionSexual();
})

$("#frm_orientacion_sexual").on("submit",function(event){
	
	let _ori_nombre = document.getElementById('ori_nombre').value;
	var _ori_id = document.getElementById('ori_id').value;
	var parametros = {ori_nombre:_ori_nombre,ori_id:_ori_id}
	
	if(_ori_nombre == ""){
		$("#mensaje_ori_nombre").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=OrientacionSexual&action=InsertaOrientacionSexual",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Orientacion Sexual",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#ori_id").val(0);
		document.getElementById("frm_orientacion_sexual").reset();	
		consultaOrientacionSexual();
	})

	event.preventDefault()
})

function editOrientacionSexual(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=OrientacionSexual&action=editOrientacionSexual",
		type:"POST",
		dataType:"json",
		data:{ori_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#ori_nombre").val(array.ori_nombre);			
			$("#ori_id").val(array.ori_id);
			$("html, body").animate({ scrollTop: $(ori_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaOrientacionSexual();
	})
	
	return false;
	
}

function delOrientacionSexual(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=OrientacionSexual&action=delOrientacionSexual",
		type:"POST",
		dataType:"json",
		data:{ori_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Orientacion Sexual",
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
		consultaOrientacionSexual();
	})
	
	return false;
}

function consultaOrientacionSexual(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=OrientacionSexual&action=consultaOrientacionSexual",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#orientacion_sexual_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



