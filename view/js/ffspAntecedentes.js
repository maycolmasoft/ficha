$(document).ready(function(){
	
	consultaAntecedentes();
	cargaSexoAntecedentes();
	
})


$("#frm_antecedentes").on("submit",function(event){
	
	let _ante_nombre = document.getElementById('ante_nombre').value;
	let _sex_id = document.getElementById('sex_id').value;
	var _ante_id = document.getElementById('ante_id').value;
	var parametros = {ante_nombre:_ante_nombre,sex_id:_sex_id,ante_id:_ante_id}
	
	if(_ante_nombre == ""){
		$("#mensaje_nombre_antecedentes").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	if(_sex_id == 0){
		$("#mensaje_id_sexo").text("Seleccione").fadeIn("Slow");
		return false;
	}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspAntecedentes&action=InsertaAntecedentes",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Antecedentes",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#ante_id").val(0);
		document.getElementById("frm_antecedentes").reset();	
		consultaAntecedentes();
	})

	event.preventDefault()
})


function editAntecedentes(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspAntecedentes&action=editAntecedentes",
		type:"POST",
		dataType:"json",
		data:{ante_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#ante_nombre").val(array.ante_nombre);			
			$("#sex_id").val(array.sex_id);
			$("#ante_id").val(array.ante_id);
			
			$("html, body").animate({ scrollTop: $(ante_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaAntecedentes();
	})
	
	return false;
	
}

function delAntecedentes(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspAntecedentes&action=delAntecedentes",
		type:"POST",
		dataType:"json",
		data:{ante_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Antecedentes",
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
		consultaAntecedentes();
	})
	
	return false;
}


function consultaAntecedentes(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspAntecedentes&action=consultaAntecedentes",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#antecedentes_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}


function cargaSexoAntecedentes(){
	
	let $ddlEstado = $("#sex_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspAntecedentes&action=cargaSexoAntecedentes",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEstado.empty();
		$ddlEstado.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEstado.append("<option value= " +value.sex_id +" >" + value.sex_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEstado.empty();
	})
	
}

$("#sex_id").on("focus",function(){
	$("#mensaje_id_sexo").text("").fadeOut("");
})

$("#ante_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


