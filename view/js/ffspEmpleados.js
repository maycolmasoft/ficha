$(document).ready(function(){
	
	consultaEmpleados();
	cargaIdentidadGenero();
	cargaEmpresa();
	cargaOrientacionSexual();
	cargaReligion();
	cargaSexo();
	
})


$("#frm_empleados").on("submit",function(event){
	
	let _empl_primer_nombre = document.getElementById('empl_primer_nombre').value;
	let _empl_segundo_nombre = document.getElementById('empl_segundo_nombre').value;
	let _empl_primer_apellido = document.getElementById('empl_primer_apellido').value;
	let _empl_segundo_apellido = document.getElementById('empl_segundo_apellido').value;
	let _ide_id = document.getElementById('ide_id').value;
	let _empl_dni = document.getElementById('empl_dni').value;
	let _empl_edad = document.getElementById('empl_edad').value;
	let _empl_grupo_sanguineo = document.getElementById('empl_grupo_sanguineo').value;
	let _empl_fecha_ingreso = document.getElementById('empl_fecha_ingreso').value;
	let _empl_lugar_trabajo = document.getElementById('empl_lugar_trabajo').value;
	let _empl_area_trabajo = document.getElementById('empl_area_trabajo').value;
	let _empl_actividades_trabajo = document.getElementById('empl_actividades_trabajo').value;
	let _dis_tiene = document.getElementById('dis_tiene').value;
	let _dis_nombre = document.getElementById('dis_nombre').value;
	let _dis_porcentaje = document.getElementById('dis_porcentaje').value;
	let _emp_id = document.getElementById('emp_id').value;
	let _ori_id = document.getElementById('ori_id').value;
	let _rel_id = document.getElementById('rel_id').value;
	let _sex_id = document.getElementById('sex_id').value;
	var _empl_id = document.getElementById('empl_id').value;
	
		var parametros = {empl_primer_nombre:_empl_primer_nombre,
				empl_segundo_nombre:_empl_segundo_nombre,
				empl_primer_apellido:_empl_primer_apellido,
				empl_segundo_apellido:_empl_segundo_apellido,
				ide_id:_ide_id,
				empl_dni:_empl_dni,
				empl_edad:_empl_edad,
				empl_grupo_sanguineo:_empl_grupo_sanguineo,
				empl_fecha_ingreso:_empl_fecha_ingreso,
				empl_lugar_trabajo:_empl_lugar_trabajo,
				empl_area_trabajo:_empl_area_trabajo,
				empl_actividades_trabajo:_empl_actividades_trabajo,
				dis_tiene:_dis_tiene,
				dis_nombre:_dis_nombre,
				dis_porcentaje:_dis_porcentaje,
				emp_id:_emp_id,
				ori_id:_ori_id,
				rel_id:_rel_id,
				sex_id:_sex_id,
				empl_id:_empl_id}

		if(_empl_primer_nombre == ""){
			$("#mensaje_primer_nombre").text("Ingrese un Nombre").fadeIn("Slow");
			return false;
		}
		if(_empl_segundo_nombre == ""){
			$("#mensaje_segundo_nombre").text("Ingrese un Nombre").fadeIn("Slow");
			return false;
		}
		
		if(_empl_primer_apellido == ""){
			$("#mensaje_primer_apellido").text("Ingrese un Nombre").fadeIn("Slow");
			return false;
		}
		
		if(_empl_segundo_apellido == ""){
			$("#mensaje_segundo_apellido").text("Ingrese un Nombre").fadeIn("Slow");
			return false;
		}
		
		if(_ide_id == 0){
			$("#mensaje_identidad_genero").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_empl_dni == ""){
			$("#mensaje_dni").text("Ingrese un Nombre").fadeIn("Slow");
			return false;
		}
		
		if(_empl_edad == ""){
			$("#mensaje_edad").text("Ingrese un Nombre").fadeIn("Slow");
			return false;
		}
		
		if(_empl_grupo_sanguineo == ""){
			$("#mensaje_grupo_sanguineo").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_empl_fecha_ingreso == ""){
			$("#mensaje_fecha_ingreso").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_empl_lugar_trabajo == ""){
			$("#mensaje_lugar_trabajo").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_empl_area_trabajo == ""){
			$("#mensaje_area_trabajo").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_empl_actividades_trabajo == ""){
			$("#mensaje_actividades_trabajo").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		
		if(_emp_id == 0){
			$("#mensaje_empresa").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_ori_id == 0){
			$("#mensaje_orientacion_sexual").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_rel_id == 0){
			$("#mensaje_religion").text("Seleccione").fadeIn("Slow");
			return false;
		}
		
		if(_sex_id == 0){
			$("#mensaje_sexo").text("Seleccione").fadeIn("Slow");
			return false;
		}
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=InsertaEmpleados",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	swal({
  		  title: "Empleados",
  		  text: datos.mensaje,
  		  icon: "success",
  		  button: "Aceptar",
  		
  		});
	
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		$("#empl_id").val(0);
		document.getElementById("frm_empleados").reset();	
		consultaEmpleados();
	})

	event.preventDefault()
})


function editEmpleados(id = 0){
	
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspEmpleados&action=editEmpleados",
		type:"POST",
		dataType:"json",
		data:{empl_id:id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			$("#empl_primer_nombre").val(array.empl_primer_nombre);			
			$("#empl_segundo_nombre").val(array.empl_segundo_nombre);
			$("#empl_primer_apellido").val(array.empl_primer_apellido);
			$("#empl_segundo_apellido").val(array.empl_segundo_apellido);
			$("#ide_id").val(array.ide_id);
			$("#empl_dni").val(array.empl_dni);
			$("#empl_edad").val(array.empl_edad);
			$("#empl_grupo_sanguineo").val(array.empl_grupo_sanguineo);
			$("#empl_fecha_ingreso").val(array.empl_fecha_ingreso);
			$("#empl_lugar_trabajo").val(array.empl_lugar_trabajo);
			$("#empl_area_trabajo").val(array.empl_area_trabajo);
			$("#empl_actividades_trabajo").val(array.empl_actividades_trabajo);
			
			
			var valor_dis_tiene = ( array.dis_tiene == 't' ) ? "SI" : "NO";
			
			 if (valor_dis_tiene == 'SI') {
	                document.getElementById('nombre_discapacidad').style.display = "block"
	                document.getElementById('porcentaje_discapacidad').style.display = "block"
	                $("#dis_nombre").val(array.dis_nombre);	
	                $("#dis_porcentaje").val(array.dis_porcentaje);	
			 }else{
                document.getElementById('nombre_discapacidad').style.display = "none"
                document.getElementById('porcentaje_discapacidad').style.display = "none"
            	$("#dis_nombre").val('');	
                $("#dis_porcentaje").val('');	
                
            }
			$("#dis_tiene").val(valor_dis_tiene);			
			$("#emp_id").val(array.emp_id);
			$("#ori_id").val(array.ori_id);
			$("#rel_id").val(array.rel_id);
			$("#sex_id").val(array.sex_id);
			$("#empl_id").val(array.empl_id);
			
			$("html, body").animate({ scrollTop: $(empl_primer_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		consultaEmpleados();
	})
	
	return false;
	
}

function delEmpleados(id){
	
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspEmpleados&action=delEmpleados",
		type:"POST",
		dataType:"json",
		data:{empl_id:id}
	}).done(function(datos){		
		
		if(datos.data > 0){
			
			swal({
		  		  title: "Empleados",
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
		consultaEmpleados();
	})
	
	return false;
}


function consultaEmpleados(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspEmpleados&action=consultaEmpleados",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#empleados_registrados").html(datos)		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}


function cargaIdentidadGenero(){
	
	let $ddlIdentidadGenero= $("#ide_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaIdentidadGenero",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlIdentidadGenero.empty();
		$ddlIdentidadGenero.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlIdentidadGenero.append("<option value= " +value.ide_id +" >" + value.ide_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlIdentidadGenero.empty();
	})
	
}

$("#ide_id").on("focus",function(){
	$("#mensaje_identidad_genero").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})







function cargaEmpresa(){
	
	let $ddlEmpresa= $("#emp_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaEmpresa",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlEmpresa.empty();
		$ddlEmpresa.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlEmpresa.append("<option value= " +value.emp_id +" >" + value.emp_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlEmpresa.empty();
	})
	
}

$("#emp_id").on("focus",function(){
	$("#mensaje_empresa").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


function cargaOrientacionSexual(){
	
	let $ddlOrientacionSexual= $("#ori_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaOrientacionSexual",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlOrientacionSexual.empty();
		$ddlOrientacionSexual.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlOrientacionSexual.append("<option value= " +value.ori_id +" >" + value.ori_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlOrientacionSexual.empty();
	})
	
}

$("#ori_id").on("focus",function(){
	$("#mensaje_orientacion_sexual").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})


function cargaReligion(){
	
	let $ddlReligion= $("#rel_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaReligion",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlReligion.empty();
		$ddlReligion.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlReligion.append("<option value= " +value.rel_id +" >" + value.rel_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlReligion.empty();
	})
	
}

$("#rel_id").on("focus",function(){
	$("#mensaje_religion").text("").fadeOut("");
})

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})



function cargaSexo(){
	
	let $ddlSexo= $("#sex_id");
	
	$.ajax({
		beforeSend:function(){},
		url:"index.php?controller=ffspEmpleados&action=cargaSexo",
		type:"POST",
		dataType:"json",
		data:null
	}).done(function(datos){		
		
		$ddlSexo.empty();
		$ddlSexo.append("<option value='0' >--Seleccione--</option>");
		
		$.each(datos.data, function(index, value) {
			$ddlSexo.append("<option value= " +value.sex_id +" >" + value.sex_nombre  + "</option>");	
  		});
		
	}).fail(function(xhr,status,error){
		var err = xhr.responseText
		console.log(err)
		$ddlSexo.empty();
	})
	
}

$("#sex_id").on("focus",function(){
	$("#mensaje_sexo").text("").fadeOut("");
})



function ToggleDiv(id) {
            if (id == 'SI') {
                document.getElementById('nombre_discapacidad').style.display = "block"
                document.getElementById('porcentaje_discapacidad').style.display = "block"                    
            }else if (id == 'NO'){
            	document.getElementById('nombre_discapacidad').style.display = "none"
            	document.getElementById('porcentaje_discapacidad').style.display = "none"                	
            }else{
                document.getElementById('nombre_discapacidad').style.display = "none"
                document.getElementById('porcentaje_discapacidad').style.display = "none"
            }
 }

  