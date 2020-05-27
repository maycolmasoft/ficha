$(document).ready(function(){
	 
	var formulario = $('#smartwizard').smartWizard({
        selected: 0,  // Initial selected step, 0 = first step 
        keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
        autoAdjustHeight:true, // Automatically adjust content height
        cycleSteps: false, // Allows to cycle the navigation of steps
        backButtonSupport: true, // Enable the back button support
        useURLhash: true, // Enable selection of the step based on url hash
        lang: {  // Language variables
            next: 'Siguiente', 
            previous: 'Anterior'
        },
        toolbarSettings: {
            toolbarPosition: 'bottom', // none, top, bottom, both
            toolbarButtonPosition: 'right', // left, right
            showNextButton: true, // show/hide a Next button
            showPreviousButton: true, // show/hide a Previous button
            toolbarExtraButtons: [
									      
		        $('<button></button>').text('Guardar')
						      .addClass('btn btn-success')
						      .attr({ 
						    	  id:"aplicar",name:"aplicar",type:"submit", form:"frm_avoco",
						    	  disabled:true
						    	  })						    	  
						      .append("<i class=\"fa \" aria-hidden=\"true\" ></i>"),
				$('<button></button>').text('Cancelar')
						      .addClass('btn btn-primary')
						      .attr({type:"button",id:"btn_cancelar",name:"btn_cancelar"})
						     
                  ]
        }, 
        anchorSettings: {
            anchorClickable: true, // Enable/Disable anchor navigation
            enableAllAnchors: false, // Activates all anchors clickable all times
            markDoneStep: true, // add done css
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        },            
        contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
        disabledSteps: [],    // Array Steps disabled
        errorSteps: [],    // Highlight step with errors
        theme: 'dots',
        transitionEffect: 'fade', // Effect on navigation, none/slide/fade
        transitionSpeed: '400'
  });
	
	
	formulario.on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
		
		//console.log(stepDirection);
		if(stepNumber==0){
			
			return validaPaso1();
		}
		if(stepNumber==1){
			
			return validaPaso2();
			
		}
      if(stepNumber==2){
			
			return validaPaso3();
			
		}
    });
	
	
	/*formulario.on("showStep", function(e, anchorObject, stepNumber) {
		if(stepNumber==2){
			$("#btn_distribucion").attr({disabled:false});
			$("#aplicar").attr({disabled:false});
			
			if( typeof resultadosCompra !== 'undefined' && jQuery.isFunction( resultadosCompra ) ) {
			    
				resultadosCompra();
			}
		}
	});*/


    
   function validaPaso1(){
	   
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
		var _fic_id = document.getElementById('fic_id').value;

		  
		if(_fic_id == '' || _fic_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
		if(_empl_id == '' || _empl_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay empleado",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
	   
	   if(_empl_primer_nombre == '' || _empl_primer_nombre.length == 0){
		   $("#mensaje_primer_nombre").notify("Ingrese Primer Nombre",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_segundo_nombre == '' || _empl_segundo_nombre.length == 0){
		   $("#mensaje_segundo_nombre").notify("Ingrese Segundo Nombre",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_primer_apellido == '' || _empl_primer_apellido.length == 0){
		   $("#mensaje_primer_apellido").notify("Ingrese Primer Apellido",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_segundo_apellido == '' || _empl_segundo_apellido.length == 0){
		   $("#mensaje_segundo_apellido").notify("Ingrese Segundo Apellido",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_ide_id == 0){
		   $("#mensaje_identidad_genero").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	  
	   if(_empl_dni == "" || _empl_dni.length < 10){
		   $("#mensaje_dni").notify("Dni Incorrecto",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_edad == "" || _empl_edad.length == 0 ){
		   $("#mensaje_edad").notify("Ingrese Edad",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_grupo_sanguineo == "" || _empl_grupo_sanguineo.length == 0 ){
		   $("#mensaje_grupo_sanguineo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_fecha_ingreso == "" || _empl_fecha_ingreso.length == 0 ){
		   $("#mensaje_fecha_ingreso").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_lugar_trabajo == "" || _empl_lugar_trabajo.length == 0 ){
		   $("#mensaje_lugar_trabajo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_area_trabajo == "" || _empl_area_trabajo.length == 0 ){
		   $("#mensaje_area_trabajo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_empl_actividades_trabajo == "" || _empl_actividades_trabajo.length == 0 ){
		   $("#mensaje_actividades_trabajo").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_dis_tiene == 0){
		   $("#mensaje_discapacidad").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   } 
	   
	   
	   if(_dis_tiene == "SI"){
		 
		   if(_dis_nombre == "" || _dis_nombre.length == 0){
			   $("#mensaje_dis_nombre").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		   } 
		   
		   if(_dis_porcentaje == "" || _dis_porcentaje.length == 0){
			   $("#mensaje_dis_porcentaje").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		   } 
	   } 
	   
	   
	   
	   
	   
	   if(_emp_id == 0 ){
		   $("#mensaje_empresa").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_ori_id == 0 ){
		   $("#mensaje_orientacion_sexual").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_rel_id == 0 ){
		   $("#mensaje_religion").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   if(_sex_id == 0 ){
		   $("#mensaje_sexo").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   
	   $("#aplicar").attr({disabled:true});
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
		   
	   $.ajax({
			beforeSend:function(){},
			url:"index.php?controller=ffspEmpleados&action=InsertaEmpleados",
			type:"POST",
			dataType:"json",
			data:parametros
		}).done(function(datos){
			
			 
		swal({
	  		  title: "Actualizando Empleados",
	  		  text: datos.mensaje,
	  		  icon: "success",
	  		  button: "Aceptar",
	  		
	  		});
		
		return true;
		}).fail(function(xhr,status,error){
			
			var err = xhr.responseText
			console.log(err);
			
		})
	   
	   
	   
	   
	  
   }
   
   function validaPaso2(){
	   
	   CKEDITOR.instances.fic_motivo_consulta.updateElement();
		 
	   let fic_motivo_consulta = $("#fic_motivo_consulta").val();
	   var _empl_id = document.getElementById('empl_id').value;
	   var _fic_id = document.getElementById('fic_id').value;
 	
	   if(_fic_id == '' || _fic_id == 0){
		   $("#mensaje_primer_nombre").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
			return false;
		}
		if(_empl_id == '' || _empl_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay empleado",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
	
	   if(fic_motivo_consulta == '' || fic_motivo_consulta.length == 0){
		   $("#fic_motivo_consulta").notify("Ingrese Motivo de Consulta.",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	  
		$("#aplicar").attr({disabled:true});
		
		   
		var parametros = {fic_motivo_consulta:fic_motivo_consulta,
				          empl_id:_empl_id,
				          fic_id:_fic_id
				         }
		   
	   $.ajax({
			beforeSend:function(){},
			url:"index.php?controller=ffsp_ficha&action=InsertaMotivo_B",
			type:"POST",
			dataType:"json",
			data:parametros
		}).done(function(datos){
			
			if(datos.respuesta > 0){
				
				swal({
			  		  title: "Actualizando Motivo Consulta",
			  		  text: datos.mensaje,
			  		  icon: "success",
			  		  button: "Aceptar",
			  		
			  		});
				
				return true;	
				
			}
			 
		
		
		}).fail(function(xhr,status,error){
			
			var err = xhr.responseText
			console.log(err);
			
		})
	   
	
   }
   
   
   function validaPaso3(){
	   
	   
	   CKEDITOR.instances.fic_antecedentes_personales.updateElement();
		 
	   let fic_antecedentes_personales = $("#fic_antecedentes_personales").val();
	   var _empl_id = document.getElementById('empl_id').value;
	   var _fic_id = document.getElementById('fic_id').value;
 	
	   if(_fic_id == '' || _fic_id == 0){
		   $("#mensaje_primer_nombre").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
			return false;
		}
		if(_empl_id == '' || _empl_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay empleado",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
		
	   if(fic_antecedentes_personales == '' || fic_antecedentes_personales.length == 0){
		   $("#fic_antecedentes_personales").notify("Ingrese Antecedentes Clínicos y Quirúrgicos",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   
	 	$("#aplicar").attr({disabled:true});
		
	 	var parametros = {fic_antecedentes_personales:fic_antecedentes_personales,
		          empl_id:_empl_id,
		          fic_id:_fic_id
		         }
 
		$.ajax({
			beforeSend:function(){},
			url:"index.php?controller=ffsp_ficha&action=InsertaAntecedentes_C",
			type:"POST",
			dataType:"json",
			data:parametros
		}).done(function(datos){
			
			if(datos.respuesta > 0){
				
				swal({
			  		  title: "Actualizando Antecedentes Personales",
			  		  text: datos.mensaje,
			  		  icon: "success",
			  		  button: "Aceptar",
			  		
			  		});
				
				return true;	
				
			}
			 
		
		
		}).fail(function(xhr,status,error){
			
			var err = xhr.responseText
			console.log(err);
			
		})
	  
   }
	
   
})
      
   

   
   
   
   
   
   

