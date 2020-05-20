$(document).ready(function(){
	
	consultaExamenFisicoRegionalDetalle();
	cargaExamenFisicoRegional();
	
})


$("#frm_examen_fisico_regional_detalle").on("submit",function(event){
	
	event.preventDefault();
	
	let _exam_nombre = document.getElementById('exam_nombre').value;
	let _exa_id = document.getElementById('ddl_exa_id').value;
	var _exam_id = document.getElementById('exam_id').value;
	var parametros = {exam_nombre:_exam_nombre,exa_id:_exa_id,exam_id:_exam_id}
	
	if(_exam_nombre == ""){
		$("#mensaje_nombre_examen_detalle").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	if(_exa_id == 0){
		$("#mensaje_id_examen").text("Seleccione").fadeIn("Slow");
		return false;
	}
	
	//return
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspExamenFisicoRegionalDetalle&action=InsertaExamenFisicoRegionalDetalle",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Examen",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#exam_id").val(0);
		document.getElementById("frm_examen_fisico_regional_detalle").reset();	
		consultaExamenFisicoRegionalDetalle();
	})

	
})


function editExamenFisicoRegionalDetalle(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPageDetalle").addClass("loader_detalle")},
		url:"index.php?controller=ffspExamenFisicoRegionalDetalle&action=editExamenFisicoRegionalDetalle",
		type:"POST",
		dataType:"json",
		data:{exam_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#exam_nombre").val(array.exam_nombre);			
			$("#ddl_exa_id").val(array.exa_id);
			$("#exam_id").val(array.exam_id);
			
			$("html, body").animate({ scrollTop: $(exam_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPageDetalle").removeClass("loader_detalle")
		consultaExamenFisicoRegionalDetalle();
	})
	
	return false;
	
}

function delExamenFisicoRegionalDetalle(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPageDetalle").addClass("loader_detalle")},
		url:"index.php?controller=ffspExamenFisicoRegionalDetalle&action=delExamenFisicoRegionalDetalle",
		type:"POST",
		dataType:"json",
		data:{exam_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Examen",
		  		  text: "Registro Eliminado",
		  		  icon: "success",
		  		  button: "Aceptar",
		  		});
					
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPageDetalle").removeClass("loader_detalle")
		consultaExamenFisicoRegionalDetalle();
	})
	
	return false;
}


function consultaExamenFisicoRegionalDetalle(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPageDetalle").addClass("loader_detalle")},
		url:"index.php?controller=ffspExamenFisicoRegionalDetalle&action=consultaExamenFisicoRegionalDetalle",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#examen_fisico_regional_registrados_detalle").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPageDetalle").removeClass("loader_detalle")
		
	})
	
}

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var target = $(e.target).attr("href");
    if ((target == '#detalle')) {
    	cargaExamenFisicoRegional();
    } 
});

function cargaExamenFisicoRegional(){
	
	let $ddlEstado = $("#ddl_exa_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspExamenFisicoRegionalDetalle&action=cargaExamenFisicoRegional",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEstado.empty();
		$ddlEstado.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEstado.append("<option value= " +value.exa_id +" >" + value.exa_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEstado.empty();
	})
	
}

$("#ddl_exa_id").on("focus",function(){
	$("#mensaje_id_examen").text("").fadeOut("");
})

$("#exam_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


