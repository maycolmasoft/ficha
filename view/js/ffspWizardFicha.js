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
						    	  id:"aplicar",name:"aplicar",type:"submit", form:"frm_ficha",
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
	  if(stepNumber==0){return validaPaso1();}
	  if(stepNumber==1){return validaPaso2();}
      if(stepNumber==2){return validaPaso3();}
      if(stepNumber==3){return validaPaso4();}
      if(stepNumber==4){return validaPaso5();}
      if(stepNumber==5){return validaPaso6();}
      if(stepNumber==6){return validaPaso7();}
      if(stepNumber==7){return validaPaso8();}
      if(stepNumber==8){return validaPaso9();}
      if(stepNumber==9){return validaPaso10();}
      if(stepNumber==10){return validaPaso11();}
      if(stepNumber==11){return validaPaso12();}
      if(stepNumber==12){return validaPaso13();}
      if(stepNumber==13){return validaPaso14();}
      //if(stepNumber==14){return validaPaso15();}
      
    });
	

    
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
	   
	   //validar por sexo (hombre o mujer)
	   var _sex_id = document.getElementById('sex_id').value;
	   var _fic_ant_menarquia = document.getElementById('fic_ant_menarquia').value;
	   var _fic_ant_ciclos = document.getElementById('fic_ant_ciclos').value;
	   var _fic_ant_fecha_ultima_mestruacion = document.getElementById('fic_ant_fecha_ultima_mestruacion').value;
	   var _fic_ant_gestas = document.getElementById('fic_ant_gestas').value;
	   var _fic_ant_partos = document.getElementById('fic_ant_partos').value;
	   var _fic_ant_cesareas = document.getElementById('fic_ant_cesareas').value;
	   var _fic_ant_abortos = document.getElementById('fic_ant_abortos').value;
	   
	   //planificacion familiar
	   var _fic_ant_hijos_vivos = document.getElementById('fic_ant_hijos_vivos').value;
	   var _fic_ant_hijos_muertos = document.getElementById('fic_ant_hijos_muertos').value;
	   var _fic_ant_vida_sexual = document.getElementById('fic_ant_vida_sexual').value;
	   var _fic_ant_metodo_planificacion_familiar = document.getElementById('fic_ant_metodo_planificacion_familiar').value;
	   var _fic_ant_tipo_metodo_planificacion_familiar = document.getElementById('fic_ant_tipo_metodo_planificacion_familiar').value;
	   
	    
	   var tiempo = tiempo || 1000;
	   
	   if(_fic_id == '' || _fic_id == 0){
		   $("#mensaje_primer_nombre").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
			return false;
		}
		if(_empl_id == '' || _empl_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay empleado",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
		
	   if(fic_antecedentes_personales == '' || fic_antecedentes_personales.length == 0){
		
		   $("html, body").animate({ scrollTop: $("#fic_antecedentes_personales").offset().top-120 }, tiempo);			
		   $("#fic_antecedentes_personales").notify("Ingrese Antecedentes Clínicos y Quirúrgicos",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	   
	   
	   //valido solo si son mujeres
	   if(_sex_id==2){
		   
		   if(_fic_ant_menarquia == '' || _fic_ant_menarquia == 0){
			   $("html, body").animate({ scrollTop: $("#fic_ant_menarquia").offset().top-120 }, tiempo);			
			   $("#mensaje_fic_ant_menarquia").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		    }   
		   
		   
		   if(_fic_ant_ciclos == '' || _fic_ant_ciclos.length == 0){
				
			   $("html, body").animate({ scrollTop: $("#fic_ant_ciclos").offset().top-120 }, tiempo);			
			   $("#fic_ant_ciclos").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		   }
		   
		   if(_fic_ant_fecha_ultima_mestruacion == ''){
				
			   $("html, body").animate({ scrollTop: $("#fic_ant_fecha_ultima_mestruacion").offset().top-120 }, tiempo);			
			   $("#fic_ant_fecha_ultima_mestruacion").notify("seleccione",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		   }
		   
		   if(_fic_ant_gestas == '' || _fic_ant_gestas == 0){
			   $("html, body").animate({ scrollTop: $("#fic_ant_gestas").offset().top-120 }, tiempo);			
			   $("#mensaje_fic_ant_gestas").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		    }   
		   
		   if(_fic_ant_partos == '' || _fic_ant_partos == 0){
			   $("html, body").animate({ scrollTop: $("#fic_ant_partos").offset().top-120 }, tiempo);			
			   $("#mensaje_fic_ant_partos").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		    } 
		   
		   if(_fic_ant_cesareas == '' || _fic_ant_cesareas == 0){
			   $("html, body").animate({ scrollTop: $("#fic_ant_cesareas").offset().top-120 }, tiempo);			
			   $("#mensaje_fic_ant_cesareas").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		    } 
		   
		   if(_fic_ant_abortos == '' || _fic_ant_abortos == 0){
			   $("html, body").animate({ scrollTop: $("#fic_ant_abortos").offset().top-120 }, tiempo);			
			   $("#mensaje_fic_ant_abortos").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		    } 
		   
	   }
	   
	   
	   
	   //valido planificacion familiar
	   if(_fic_ant_hijos_vivos == '' || _fic_ant_hijos_vivos == 0){
		   $("html, body").animate({ scrollTop: $("#fic_ant_hijos_vivos").offset().top-120 }, tiempo);			
		   $("#mensaje_fic_ant_hijos_vivos").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	    }
	   
	   if(_fic_ant_hijos_muertos == '' || _fic_ant_hijos_muertos == 0){
		   $("html, body").animate({ scrollTop: $("#fic_ant_hijos_muertos").offset().top-120 }, tiempo);			
		   $("#mensaje_fic_ant_hijos_muertos").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	    }
	   
	   if(_fic_ant_vida_sexual == '' || _fic_ant_vida_sexual == 0){
		   $("html, body").animate({ scrollTop: $("#fic_ant_vida_sexual").offset().top-120 }, tiempo);			
		   $("#mensaje_fic_ant_vida_sexual").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	    }
	   
	   if(_fic_ant_metodo_planificacion_familiar == '' || _fic_ant_metodo_planificacion_familiar == 0){
		   $("html, body").animate({ scrollTop: $("#fic_ant_metodo_planificacion_familiar").offset().top-120 }, tiempo);			
		   $("#mensaje_fic_ant_metodo_planificacion_familiar").notify("Seleccione",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	    }
	   
	   if(_fic_ant_tipo_metodo_planificacion_familiar == '' || _fic_ant_tipo_metodo_planificacion_familiar.length == 0){
		   $("html, body").animate({ scrollTop: $("#fic_ant_tipo_metodo_planificacion_familiar").offset().top-120 }, tiempo);			
		   $("#mensaje_fic_ant_tipo_metodo_planificacion_familiar").notify("Ingrese",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	    }
	   
	   
	   //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   if($("#tabla_antecedentes_detalle").length) {
		}else{
			 $("html, body").animate({ scrollTop: $("#ante_id").offset().top-120 }, tiempo);			
			   $("#ante_id").notify("Ingrese Exámenes Realizados",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_habitos_toxicos").length) {
		}else{
			   $("html, body").animate({ scrollTop: $("#hab_id").offset().top-120 }, tiempo);			
				  $("#hab_id").notify("Ingrese Hábitos Tóxicos",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_estilo_vida").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#est_vid_id").offset().top-120 }, tiempo);			
			   $("#est_vid_id").notify("Ingrese Estilo de Vida",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	   
	   
	   
	 	$("#aplicar").attr({disabled:true});
		
	 	
	 	//actualizo antecedentes
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
				/*
				swal({
			  		  title: "Actualizando Antecedentes Personales",
			  		  text: datos.mensaje,
			  		  icon: "success",
			  		  button: "Aceptar",
			  		
			  		});
				
				return true;	
				*/
			}
			 
		
		
		}).fail(function(xhr,status,error){
			
			var err = xhr.responseText
			console.log(err);
			
		})
	 	
	 	
	 	//inserto antecedentes planificacion familiar
	 	var parametros1 = {
		          empl_id:_empl_id,
		          fic_id:_fic_id,
		          sex_id:_sex_id,
		          fic_ant_menarquia:_fic_ant_menarquia,
		          fic_ant_ciclos:_fic_ant_ciclos,
		          fic_ant_fecha_ultima_mestruacion:_fic_ant_fecha_ultima_mestruacion,
		          fic_ant_gestas:_fic_ant_gestas,
		          fic_ant_partos:_fic_ant_partos,
		          fic_ant_cesareas:_fic_ant_cesareas,
		          fic_ant_abortos:_fic_ant_abortos,
		          fic_ant_hijos_vivos:_fic_ant_hijos_vivos,
		          fic_ant_hijos_muertos:_fic_ant_hijos_muertos,
		          fic_ant_vida_sexual:_fic_ant_vida_sexual,
		          fic_ant_metodo_planificacion_familiar:_fic_ant_metodo_planificacion_familiar,
		          fic_ant_tipo_metodo_planificacion_familiar:_fic_ant_tipo_metodo_planificacion_familiar
		          
		         }
	 	
	 	//console.log( parametros1 ); return false;
	 	
			 	$.ajax({
					beforeSend:function(){},
					url:"index.php?controller=ffsp_ficha&action=InsertaAntecedentes_Plani",
					type:"POST",
					dataType:"json",
					data:parametros1
				}).done(function(datos1){
					
					if(datos1.respuesta > 0){
						
						swal({
					  		  title: "Actualizando Antecedentes Personales",
					  		  text: datos1.mensaje,
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
	
   
   
   
   function validaPaso4(){
   
	   var tiempo = tiempo || 1000;
	   
	   //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   if($("#tabla_empleo_anterior").length) {
		}else{
			 $("html, body").animate({ scrollTop: $("#fic_emp_ant_empresa").offset().top-120 }, tiempo);			
			   $("#fic_emp_ant_empresa").notify("Ingrese Empleos Anteriores",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_accidentes_trabajo").length) {
		}else{
			   $("html, body").animate({ scrollTop: $("#fic_acc_tra_fue_calificado").offset().top-120 }, tiempo);			
				  $("#fic_acc_tra_fue_calificado").notify("Ingrese Accidentes de Trabajo",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_enfermedad_profesional").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#fic_enf_pro_fue_calificado").offset().top-120 }, tiempo);			
			   $("#fic_enf_pro_fue_calificado").notify("Ingrese Enfermedades Profesionales",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Antecedentes de Trabajo",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
   
   

   function validaPaso5(){
   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_antecedentes_familiares").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#ant_id").offset().top-120 }, tiempo);			
			   $("#ant_id").notify("Ingrese Antecedentes Familiares",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Antecedentes Familiares",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
   

   function validaPaso6(){
   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_factor_riesgo").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#fic_fact_ries_puesto_trabajo").offset().top-120 }, tiempo);			
			   $("#fic_fact_ries_puesto_trabajo").notify("Ingrese Factores Riesgo",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Factores Riesgo",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
   
   
   function validaPaso7(){
	   
	   var tiempo = tiempo || 1000;
	   
	   CKEDITOR.instances.fic_actividades_extra_laborales.updateElement();
		 
	   let fic_actividades_extra_laborales = $("#fic_actividades_extra_laborales").val();
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
	
	   if(fic_actividades_extra_laborales == '' || fic_actividades_extra_laborales.length == 0){
		   $("#fic_actividades_extra_laborales").notify("Ingrese Actividades Extra Laborales.",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	  
		$("#aplicar").attr({disabled:true});
		
		   
		var parametros = {fic_actividades_extra_laborales:fic_actividades_extra_laborales,
				          empl_id:_empl_id,
				          fic_id:_fic_id
				         }
		   
	   $.ajax({
			beforeSend:function(){},
			url:"index.php?controller=ffsp_ficha&action=InsertaAntecedentesExtraLaborales",
			type:"POST",
			dataType:"json",
			data:parametros
		}).done(function(datos){
			
			if(datos.respuesta > 0){
				
				swal({
			  		  title: "Actualizando Antecedentes Extra Laborales",
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
   
   
   
   

   function validaPaso8(){
	   
	   var tiempo = tiempo || 1000;
	   
	   CKEDITOR.instances.fic_enfermedad_actual.updateElement();
		 
	   let fic_enfermedad_actual = $("#fic_enfermedad_actual").val();
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
	
	   if(fic_enfermedad_actual == '' || fic_enfermedad_actual.length == 0){
		   $("#fic_enfermedad_actual").notify("Ingrese Enfermedad Actual.",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	  
		$("#aplicar").attr({disabled:true});
		
		   
		var parametros = {fic_enfermedad_actual:fic_enfermedad_actual,
				          empl_id:_empl_id,
				          fic_id:_fic_id
				         }
		   
	   $.ajax({
			beforeSend:function(){},
			url:"index.php?controller=ffsp_ficha&action=InsertaEnfermedadActual",
			type:"POST",
			dataType:"json",
			data:parametros
		}).done(function(datos){
			
			if(datos.respuesta > 0){
				
				swal({
			  		  title: "Actualizando Enfermedad Actual",
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
   
   
   

   function validaPaso9(){
   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_revision_organos_actual").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#org_id").offset().top-120 }, tiempo);			
			   $("#org_id").notify("Ingrese Revisión Organos",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Revisión Actual de Organos",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
   
   

   function validaPaso10(){
   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_constante_vital").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#fic_cons_vit_presion_arterial").offset().top-120 }, tiempo);			
			   $("#fic_cons_vit_presion_arterial").notify("Ingrese Constantes Vitales",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Constantes Vitales y Antropometría",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
   
   function validaPaso11(){
	   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_ficha_examen_fisico_regional").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#exam_id").offset().top-120 }, tiempo);			
			   $("#exam_id").notify("Ingrese Exámen Físico Regional",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Exámen Físico Regional",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
   
 function validaPaso12(){
	   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_resultado_examen_generales").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#fic_res_exa_examen").offset().top-120 }, tiempo);			
			   $("#fic_res_exa_examen").notify("Ingrese Resultado De Examenes Generales",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Resultado de Examenes Generales",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }

 
 function validaPaso13(){
	   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_diagnostico").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#fic_diag_descripcion").offset().top-120 }, tiempo);			
			   $("#fic_diag_descripcion").notify("Ingrese Diagnóstico",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:true});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Diagnóstico",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
   
   }
   
 
 function validaPaso14(){
	   
	   var tiempo = tiempo || 1000;

	   
	 //VALIDO QUE HAYA UN REGISTRO EN ANTECEDENTES DETALLE
	   
	   if($("#tabla_aptitud_medica").length) {
		   
		}else{
			$("html, body").animate({ scrollTop: $("#apt_med_id").offset().top-120 }, tiempo);			
			   $("#apt_med_id").notify("Ingrese Aptitud Médica",{ position:"buttom left", autoHideDelay: 2000});
				return false; 
		}
	   
	 	$("#aplicar").attr({disabled:false});
	 	
	 	
	 	swal({
	  		  title: "Actualizando Aptitud Médica para el Trabajo",
	  		  text: "Actualizado Correctamente",
	  		  icon: "success",
	  		  button: "Aceptar",
	  		});
	 	
	 	
	 	return true;	
		
 
 }
   
   
})
      
   
 
 
 $("#frm_ficha").on("submit",function(event){

	  var tiempo = tiempo || 1000;
	   
	   CKEDITOR.instances.fic_recomendacion_tratamiento.updateElement();
		 
	   let fic_recomendacion_tratamiento = $("#fic_recomendacion_tratamiento").val();
	   var _empl_id = document.getElementById('empl_id').value;
	   var _fic_id = document.getElementById('fic_id').value;
	   var _sex_id = document.getElementById('sex_id').value;
	
	   if(_fic_id == '' || _fic_id == 0){
		   $("#mensaje_primer_nombre").notify("Error no hay ficha",{ position:"buttom left", autoHideDelay: 2000});
			return false;
		}
		if(_empl_id == '' || _empl_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay empleado",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
		if(_sex_id == '' || _sex_id == 0){
			   $("#mensaje_primer_nombre").notify("Error no hay sexo",{ position:"buttom left", autoHideDelay: 2000});
				return false;
		}
	
	   if(fic_recomendacion_tratamiento == '' || fic_recomendacion_tratamiento.length == 0){
		   $("#fic_recomendacion_tratamiento").notify("Ingrese Recomendaciones - Tratamiento.",{ position:"buttom left", autoHideDelay: 2000});
			return false;
	   }
	  

		var parametros = {fic_recomendacion_tratamiento:fic_recomendacion_tratamiento,
		          empl_id:_empl_id,
		          fic_id:_fic_id,
		          sex_id:_sex_id
		         }

	$.ajax({
		beforeSend:null,
		url:"index.php?controller=ffsp_ficha&action=InsertaRecomendacionesTratamiento",
		type:"POST",
		dataType:"json",
		data:parametros
	}).done(function(datos){
		
		
	if(datos.respuesta > 0){
		
		swal({title:"",text:datos.mensaje,icon:"success"})
   		.then((value) => {
   			
   			let loteUrl = datos.respuesta;
   			let lote_sex = datos.sexo;
   			let urlReporte = "index.php?controller=ReporteFicha&action=ReporteFicha&fic_id="+loteUrl+"&sex_id="+lote_sex;
   			window.open(urlReporte,"_blank");    			
   			$('#smartwizard').smartWizard("reset");
   			window.location.href= 'index.php?controller=ffspEmpleados&action=index2';
   		});
		
			
	}else{
		
		swal({text: "Error la Ingresar Ficha",
	  		  icon: "error",
	  		  button: "Aceptar",
	  		  dangerMode: true
	  		});
		
	}
	
	
	
	
}).fail(function(xhr,status,error){
	
	let err = xhr.responseText
	
	console.log(err);
})



event.preventDefault()
})


 

	$("#frm_ficha").on("click","#btn_cancelar",function(event){
	
		let botonMain = $(this);
		
		botonMain.attr('disabled',true);
		
	
	swal("¿Esta seguro de Cancelar?", {
		 title:"Petición",
		 icon:"info", 
		 dangerMode: true,
		 text:"Se cancelará todo los datos ingresados",
		  buttons: {
		    cancelar: "Cancelar",
		    aceptar: "Aceptar",
		  },
		})
		.then((value) => {
		  switch (value) {
		 
		    case "cancelar":
		      return;
		    case "aceptar":		      
		    	
		    	botonMain.attr('disabled',false);
	    		swal({title:"Petición Cancelada",text:"",icon:"info", dangerMode:true})
	    		.then((value) => {
	    		  window.open("index.php?controller=ffspEmpleados&action=index2","_self")
	    
		  });
		}
		  
		});
})
 

   
   
   
   
   
   

