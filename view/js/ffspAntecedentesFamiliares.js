$(document).ready(function(){
	consultaAntecedentesFamiliares();
})

$("#frm_antecedentes_familiares").on("submit",function(event){
	
	let _ant_nombre = document.getElementById('ant_nombre').value;
	var _ant_id = document.getElementById('ant_id').value;
	var parametros = {ant_nombre:_ant_nombre,ant_id:_ant_id}
	
	if(_ant_nombre == ""){
		$("#mensaje_nombre_antecedentes_familiares").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspAntecedentesFamiliares&action=InsertaAntecedentesFamiliares",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Antecedentes Familiares",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#ant_id").val(0);
		document.getElementById("frm_antecedentes_familiares").reset();	
		consultaAntecedentesFamiliares();
	})

	event.preventDefault()
})

function editAntecedentesFamiliares(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspAntecedentesFamiliares&action=editAntecedentesFamiliares",
		type:"POST",
		dataType:"json",
		data:{ant_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#ant_nombre").val(array.ant_nombre);			
			$("#ant_id").val(array.ant_id);
			$("html, body").animate({ scrollTop: $(ant_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaAntecedentesFamiliares();
	})
	
	return false;
	
}

function delAntecedentesFamiliares(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspAntecedentesFamiliares&action=delAntecedentesFamiliares",
		type:"POST",
		dataType:"json",
		data:{ant_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Antecedentes Familiares",
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
		consultaAntecedentesFamiliares();
	})
	
	return false;
}

function consultaAntecedentesFamiliares(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspAntecedentesFamiliares&action=consultaAntecedentesFamiliares",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#antecedentes_familiares_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}



