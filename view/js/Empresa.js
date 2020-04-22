$(document).ready(function(){
	consultaEmpresa();
})

$("#frm_empresa").on("submit",function(event){
	
	let _emp_nombre = document.getElementById('emp_nombre').value;
	let _emp_ruc = document.getElementById('emp_ruc').value;
	let _emp_ciudad = document.getElementById('emp_ciudad').value;
	var _emp_id = document.getElementById('emp_id').value;
	var parametros = {emp_nombre:_emp_nombre,emp_ruc:_emp_ruc,emp_ciudad:_emp_ciudad,emp_id:_emp_id}
	
	if(_emp_nombre == ""){
		$("#mensaje_nombre_empresa").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	if(_emp_ruc == ""){
		$("#mensaje_ruc_empresa").text("Ingrese un Ruc").fadeIn("Slow");
		return false;
	}
	if(_emp_ciudad == ""){
		$("#mensaje_ciudad_empresa").text("Ingrese una Ciudad").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=Empresa&action=InsertaEmpresa",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Empresa",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#emp_id").val(0);
		document.getElementById("frm_empresa").reset();	
		consultaEmpresa();
	})

	event.preventDefault()
})

function editEmpresa(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Empresa&action=editEmpresa",
		type:"POST",
		dataType:"json",
		data:{emp_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#emp_nombre").val(array.emp_nombre);			
			$("#emp_ruc").val(array.emp_ruc);			
			$("#emp_ciudad").val(array.emp_ciudad);			
			$("#emp_id").val(array.emp_id);
			$("html, body").animate({ scrollTop: $(emp_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaEmpresa();
	})
	
	return false;
	
}

function delEmpresa(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Empresa&action=delEmpresa",
		type:"POST",
		dataType:"json",
		data:{emp_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Empresa",
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
		consultaEmpresa();
	})
	
	return false;
}

function consultaEmpresa(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=Empresa&action=consultaEmpresa",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#empresa_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



