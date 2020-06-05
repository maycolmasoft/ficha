$(document).ready(function(){
	
	search(1);
	
	
})


function search(_page = 1){
	
	var buscador = $("#buscador").val();
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspEmpleados&action=search",
		type:"POST",
		data:{page:_page,search:buscador,peticion:'ajax'}
	}).done(function(datos){		
		
		$("#empleados_registrados").html(datos);		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
	}).always(function(){
		
		$("#divLoaderPage").removeClass("loader")
		
	})
	
}


var id = 0;
var cedu = "";
var nombre = "";
var credito ="";
var usuario = "";

$("#empleados_registrados").on("click","#btn_abrir",function(event){

	var $div_respuesta = $("#msg_frm_ficha"); $div_respuesta.text("").removeClass();
    
	id = $(this).data().id;
	cedu = $(this).data().cedu;
	nombre = $(this).data().nombre;
	credito = $(this).data().credito;
	usuario = $(this).data().usuario;

	$("#mod_ficha").on('show.bs.modal',function(e){

		 var modal = $(this)
		 modal.find('#mod_empl_id').val(id);
		 modal.find('#mod_cedu').val(cedu);
		 modal.find('#mod_nombre').val(nombre);
		 cargaEmpresa();
		 cargarTipoFicha();
		
	}) 
	
})



function cargaEmpresa(){
	
	let $ddlEmpresa= $("#mod_emp_id");
	
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


function cargarTipoFicha(){
	 
let $mod_tip_id = $("#mod_tip_id");

$.ajax({
	beforeSend:function(){},
	url:"index.php?controller=ffspEmpleados&action=cargaTipoFicha",
	type:"POST",
	dataType:"json",
	data:null
}).done(function(datos){		
	
	$mod_tip_id.empty();
	$mod_tip_id.append("<option value='0'>--Seleccione--</option>");
	$.each(datos.data, function(index, value) {
		$mod_tip_id.append("<option value= " +value.tip_id +" >" + value.tip_nombre  + "</option>");	
		});
	
}).fail(function(xhr,status,error){
	var err = xhr.responseText
	console.log(err)
	$mod_tip_id.empty();
})
}




$("#frm_ficha").on("submit",function(event){



	let $mod_empl_id = $('#mod_empl_id').val();
	let $mod_cedu = $('#mod_cedu').val();
	let $mod_nombre = $('#mod_nombre').val();
	let $mod_emp_id = $('#mod_emp_id').val();
	let $mod_tip_id = $('#mod_tip_id').val();
   
	
	if($mod_empl_id > 0) {  
		
    } else {  

    	swal("Alerta!", "Seleccione Empleado", "error")
        return false;
    		
    } 

	if($mod_emp_id > 0) {  
		
    } else {  

    	swal("Alerta!", "Seleccione Empresa", "error")
        return false;
    		
    } 
	
   if($mod_tip_id > 0) {  
		
    } else {  

    	swal("Alerta!", "Seleccione Tipo Ficha", "error")
        return false;
    		
    } 

	
	var parametros = {empl_id:$mod_empl_id, emp_id:$mod_emp_id, tip_id:$mod_tip_id}


	var $div_respuesta = $("#msg_frm_ficha"); $div_respuesta.text("").removeClass();
		
		
	$.ajax({
		beforeSend:function(){$("#divLoaderPage").addClass("loader")},
		url:"index.php?controller=ffspEmpleados&action=IniciarFicha",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(respuesta){
				
		if(respuesta.valor > 0){
							
				swal({title:"",text:respuesta.mensaje,icon:"success"})
	    		.then((value) => {
	    			
	    			
	    			let loteUrl = respuesta.valor;
	    			if(respuesta.tipo==1){
	    				window.location.href= "index.php?controller=ffsp_ficha&action=index&id="+loteUrl;
	    			}
	    			
	    			if(respuesta.tipo==2){
	    				window.location.href= "index.php?controller=ffsp_ficha&action=index2&id="+loteUrl;
	    			}
	    			
	    			if(respuesta.tipo==3){
	    				window.location.href= "index.php?controller=ffsp_ficha&action=index&id="+loteUrl;
	    			}
	    			
	    		});
				
  		   
	    }else{
	    	//$("#msg_frm_ficha").text(respuesta.mensaje).addClass("alert alert-warning");
	    	swal({title:"",text:respuesta.mensaje,icon:"error"})
	    	
	    }
		
		
	}).fail(function(xhr,status,error){
		
		var err = xhr.responseText
		console.log(err);
		
		$div_respuesta.text("Error al ingresar ficha").addClass("alert alert-warning");
		
	}).always(function(){
				
	})
	
	event.preventDefault();
})


