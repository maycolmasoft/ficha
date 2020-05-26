 var fic_id=0;

$(document).ready(function(){
	
	
	cargaIdentidadGenero();
	cargaEmpresa();
	cargaOrientacionSexual();
	cargaReligion();
	cargaSexo();
	cargarEmpleados();
	
	
	CKEDITOR.replace('fic_motivo_consulta');
	CKEDITOR.instances.fic_motivo_consulta.setData(""); 
	CKEDITOR.replace('fic_antecedentes_personales');
	CKEDITOR.instances.fic_antecedentes_personales.setData(""); 
	
	
	
	
    $('.textarea').wysihtml5()
	
})



    
    
    
 
  
function cargarEmpleados(){
	    
     fic_id=$('#fic_id').val();
	var tiempo = tiempo || 1000;
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffsp_ficha&action=cargarEmpleados",
		type:"POST",
		dataType:"json",
		data:{fic_id:fic_id}
	}).done(function(datos){
		
		if(!jQuery.isEmptyObject(datos.data)){
			
			var array = datos.data[0];		
			
			$("#emp_id").val(array.emp_id);
			$("#emp_ruc").val(array.emp_ruc);
			$("#emp_ciudad").val(array.emp_ciudad);
			
			
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
			
			$("#ori_id").val(array.ori_id);
			$("#rel_id").val(array.rel_id);
			$("#sex_id").val(array.sex_id);
			
			if(array.sex_id==2){
				
				$("#hombre").hide();
			}else{
				
				$("#mujer").hide();
			}
			
			
			$("#empl_id").val(array.empl_id);
			
			$("html, body").animate({ scrollTop: $(empl_primer_nombre).offset().top-120 }, tiempo);			
		}
		
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
	return false;
	
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

$("#empl_primer_nombre").on("keyup",function(){
	
	$(this).val($(this).val().toUpperCase());
})



      $("#sex_id").click(function() {
			
          var sex_id = $(this).val();
			
          if(sex_id == 2 )
          {
           $("#hombre").hide();
           $("#mujer").show();
          }
       	 else
          {
       	   $("#mujer").hide();
       	   $("#hombre").show();
		  }
          
	    });
	    
	    $("#sex_id").change(function() {
			    
              var sex_id = $(this).val();
				 
              if(sex_id == 2)
              {
            	  $("#hombre").hide();
                  $("#mujer").show(); 
              }
           	   else
              {
           		 $("#mujer").hide();
             	 $("#hombre").show(); 
              }
              
              
		    });
	 	
	   




