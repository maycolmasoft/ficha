$(document).ready(function(){
	
	consultaFactoresRiesgoDetalle();
	cargaFactoresRiesgo();
	
})


$("#frm_factores_riesgo_detalle").on("submit",function(event){
	
	event.preventDefault();
	
	let _fact_nombre = document.getElementById('fact_nombre').value;
	let _fac_id = document.getElementById('ddl_fac_id').value;
	var _fact_id = document.getElementById('fact_id').value;
	var parametros = {fact_nombre:_fact_nombre,fac_id:_fac_id,fact_id:_fact_id}
	
	if(_fact_nombre == ""){
		$("#mensaje_nombre_factores_riesgo_detalle").text("Ingrese un Nombre").fadeIn("Slow");
		return false;
	}
	
	if(_fac_id == 0){
		$("#mensaje_id_factores_riesgo").text("Seleccione").fadeIn("Slow");
		return false;
	}
	
	//return
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspFactoresRiesgoDetalle&action=InsertaFactoresRiesgoDetalle",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Factores Riesgo",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#fact_id").val(0);
		document.getElementById("frm_factores_riesgo_detalle").reset();	
		consultaFactoresRiesgoDetalle();
	})

	
})


function editFactoresRiesgoDetalle(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPageDetalle").addClass("loader_detalle")},
		url:"index.php?controller=ffspFactoresRiesgoDetalle&action=editFactoresRiesgoDetalle",
		type:"POST",
		dataType:"json",
		data:{fact_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#fact_nombre").val(array.fact_nombre);			
			$("#ddl_fac_id").val(array.fac_id);
			$("#fact_id").val(array.fact_id);
			
			$("html, body").animate({ scrollTop: $(fact_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPageDetalle").removeClass("loader_detalle")
		consultaFactoresRiesgoDetalle();
	})
	
	return false;
	
}

function delFactoresRiesgoDetalle(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPageDetalle").addClass("loader_detalle")},
		url:"index.php?controller=ffspFactoresRiesgoDetalle&action=delFactoresRiesgoDetalle",
		type:"POST",
		dataType:"json",
		data:{fact_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Factores Riesgo",
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
		consultaFactoresRiesgoDetalle();
	})
	
	return false;
}


function consultaFactoresRiesgoDetalle(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPageDetalle").addClass("loader_detalle")},
		url:"index.php?controller=ffspFactoresRiesgoDetalle&action=consultaFactoresRiesgoDetalle",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#factores_riesgo_registrados_detalle").html(datos)		
		
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
    	cargaFactoresRiesgo();
    } 
});

function cargaFactoresRiesgo(){
	
	let $ddlEstado = $("#ddl_fac_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspFactoresRiesgoDetalle&action=cargaFactoresRiesgo",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEstado.empty();
		$ddlEstado.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEstado.append("<option value= " +value.fac_id +" >" + value.fac_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEstado.empty();
	})
	
}

$("#ddl_fac_id").on("focus",function(){
	$("#mensaje_id_factores_riesgo").text("").fadeOut("");
})

$("#fact_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


