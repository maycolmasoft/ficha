$(document).ready(function(){
	
	search(1);
	
	
})


function search(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#load").html('<center><img src="view/images/ajax-loader.gif"> Cargando...</center>');},
		url:"index.php?controller=ffspReporteEmpleados&action=search",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#empleados_registrados").html(datos);
		$("#load").html('');
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}





