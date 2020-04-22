$(document).ready(function(){
	consultaOrganos();
})

$("#frm_organo").on("submit",function(event){
	
	let _org_nombre = document.getElementById('org_nombre').value;
	var _org_id = document.getElementById('org_nombre').value;
	var parametros = {org_nombre:_org_nombre,org_nombre:_org_nombre}
	
	if(_org_nombre == ""){
		$("#mensaje_nombre_organo").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=Organos&action=InsertaOrganos",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Organos",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#org_id").val(0);
		document.getElementById("frm_organo").reset();	
		consultaOrganos();
	})

	event.preventDefault()
})

function editOrganos(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Organos&action=editOrganos",
		type:"POST",
		dataType:"json",
		data:{org_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#org_nombre").val(array.org_nombre);			
			$("#org_id").val(array.org_id);
			$("html, body").animate({ scrollTop: $(org_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaOrganos();
	})
	
	return false;
	
}

function delOrganos(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Organos&action=delOrganos",
		type:"POST",
		dataType:"json",
		data:{org_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Organos",
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
		consultaOrganos();
	})
	
	return false;
}

function consultaOrganos(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Organos&action=consultaOrganos",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#organos_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



