
 function modalResize () {
    if ($('#modal_wind').height() >= ($(window).height() - 100) || $(window).height() < 400) {
		$('#modal_wind').addClass('no-top-transform');
	} else {
		$('#modal_wind').removeClass('no-top-transform');
	}
	return true;
 }

 function isValidEmailAddress (emailAddress) {
    var pattern = new RegExp(/@(\S+)\.(\S+)/);
    return pattern.test(emailAddress);
 }

 function ResultVar(name, number) {
 	var result;
 	$.ajax({
		type: 'POST',
		url: 'modules/list-var.php',
		data: "variable="+name+"&number="+number,
        async: false,
        success: function(data) {
           result = data;
        }
    });
    return result;
 }

 function checkContainer () {

 	if($("#order_result_box").length != 0) {
 		if($('#order_result_box2').is(':visible')){
 			console.log('its open');
 		} else { 

 			$.ajax('modules/order/status_result.php').done(function(data) {
 				var json = $.parseJSON(data);
 				if (json.error == 0 && json.status == 1) {
 					$("#order_result_box2" ).slideDown('800').html(json.result);  

 					if(json.TaskState == 2) {
 						$('div[rel=\''+json.id+'\']').addClass("order-history-inwork");
 						$('div[rel=\''+json.id+'\']').children(".history_order_status").html('Статус: прийнято в роботу');
 					} else  if(json.TaskState == 3) {
 						$('div[rel=\''+json.id+'\']').removeClass("order-history-inwork").addClass("order-history-resolved");
 						$('div[rel=\''+json.id+'\']').children(".history_order_status").html('Статус: розглянуто');

 					
 					}
 					
 					
 				}
        	});  	
 		}

  } else {
  	console.log('error');
  } 
}


$( function() {
   $( ".datepicker" ).datepicker();
});


    function scrolify(tblAsJQueryObject, height){
        var oTbl = tblAsJQueryObject;

        // for very large tables you can remove the four lines below
        // and wrap the table with <div> in the mark-up and assign
        // height and overflow property  
        var oTblDiv = $("<div/>");
        oTblDiv.css('height', height);
        oTblDiv.css('overflow','scroll');               
        oTbl.wrap(oTblDiv);

        // save original width
        oTbl.attr("data-item-original-width", oTbl.width());
        oTbl.find('thead tr td').each(function(){
            $(this).attr("data-item-original-width",$(this).width());
        }); 
        oTbl.find('tbody tr:eq(0) td').each(function(){
            $(this).attr("data-item-original-width",$(this).width());
        });                 


        // clone the original table
        var newTbl = oTbl.clone();

        // remove table header from original table
        oTbl.find('thead tr').remove();                 
        // remove table body from new table
        newTbl.find('tbody tr').remove();   

        oTbl.parent().parent().prepend(newTbl);
        newTbl.wrap("<div/>");

        // replace ORIGINAL COLUMN width                
        newTbl.width(newTbl.attr('data-item-original-width'));
        newTbl.find('thead tr td').each(function(){
            $(this).width($(this).attr("data-item-original-width"));
        });     
        oTbl.width(oTbl.attr('data-item-original-width'));      
        oTbl.find('tbody tr:eq(0) td').each(function(){
            $(this).width($(this).attr("data-item-original-width"));
        });                 
    }



$(document).ready(function() {

	scrolify($('#tblNeedsScrolling'), 160); // 160 is height

	$( window ).on("resize scroll",function(){modalResize();});

	$('body').on('click', '.CatchNewOrder', function(e) {

		var id = $(this).attr('rel');
		var object = $(this);
		$.confirm({
			title: 'Подтвердите действие',
			content: 'Взять заявку?',
			type: 'blue',
			buttons: {   
				ok: {
					text: "Подтверждаю",
					btnClass: 'btn-blue',
					keys: ['enter'],
					action: function(){
						
						$.post('modules/ajax/catch_order.php', {order_id: id, order_act: 'GetOrder'}, function(back_data) {
							if (back_data == 0) {
								object.remove();
							} else {
								$.alert(back_data);
							}
						});
					}
				},
				cancel: {
					text: "Отмена",
				} 
			}
		});
	});


	$('body').on('click', '.button-back', function(e) {
		var id = $(this).attr('rel');
		var object = $(this).parent().parent();

		$.confirm({
			title: 'Подтвердите действие',
			content: 'Отменить бронь заявки?',
			type: 'green',
			buttons: {   
				ok: {
					text: "Подтверждаю",
					btnClass: 'btn-blue',
					keys: ['enter'],
					action: function(){
						
						$.post('modules/ajax/catch_order.php', {order_id: id, order_act: 'BackOrder'}, function(back_data) {
							if (back_data == 0) {
								//location.reload();
								location.href = '110.html';
							} else {
								$.alert(back_data);
							}
						});
					}
				},
				cancel: {
					text: "Отмена",
				} 
			}
		});
	});
	$('#modal_ds').on('click', '#checkbox1', function(e) {
		if ($(this).is(':checked')) {
			$('.add-requred').html('<label>Запрос на подтверждение</label><textarea class="Req form-control" ></textarea>');
		} else {
			$('.add-requred').html('');
		}


	});


	// повтроный запрос
	$('body').on('click', '.button-exec2', function(e) {

		//var id = $(this).attr('rel');

		$('#modal_req').modal().open({
			onOpen: function(el, options){
				$("#modal_req").css({"width": "500px"});
				setTimeout(function() {modalResize ();}, 600);
			}
			
		});
		//$('#modal_content').html(cContent);
	});


	// Выполнить заявку
	$('body').on('click', '.button-exec', function(e) {

		$('#modal_ds').modal().open({
			onOpen: function(el, options){
				$("#modal_ds").css({"width": "500px"});
				setTimeout(function() {modalResize ();}, 600);
			}
		});
	});

	$('.modal1').on('click', '.CancelOrderBtn', function(e) {
		$('.modal_content').removeAttr('style');
		$('.add-requred').html('');
		$.modal().close();
	});

/*
	$('body').on('click', '.orderPending', function(e) {

		var id = $(this).attr('rel');
		$('#modal_wind').modal().open({
			onOpen: function(el, options){
				$("#modal_wind").css({"width": "500px"});
				//$(".modal1").css({"width": "100%", "max-width": "500px"});
				setTimeout(function() {modalResize ();}, 600);
			}
		})
		$.get('modules/ajax/get_api_data_prov.php?ad='+id+'&mode=pend', function(cContent){
			$('.modal_content').html(cContent);
		});
	});	
*/
	$('body').on('click', '.waitingShow', function(e) {

		var id = $(this).attr('rel');
		$('#modal_wind').modal().open({
			onOpen: function(el, options){
				$(".modal1").css({"width": "500px"});
				//$(".modal1").css({"width": "100%", "max-width": "500px"});
				setTimeout(function() {modalResize ();}, 600);
			}
		})
		$.get('modules/ajax/get_api_data_prov.php?ad='+id+'&mode=show', function(cContent){
			$('.modal_content').html(cContent);
		});
	});

	$('body').on('click', '.ProgressingOrder', function(e) {
		e.preventDefault();
		var id = $(this).attr('rel');
		location.href = id + '.html';
	});

	$('body').on('click', '.OrderOpenClose', function(e) {
		e.preventDefault();
		var page = $(this).attr('rel');
		location.href = page+'.html';
	});


	$('body').on('click', '.openUnit', function(e) {

		var id = $(this).attr('rel');
		$('#modal_wind').modal().open({
			onOpen: function(el, options){
				$(".modal1").css("width", "100%");
				setTimeout(function() {modalResize ();}, 600);
			}
		})
		$.get('modules/ajax/get_api_data.php?ad='+id, function(cContent){
			$('.modal_content').html(cContent);
		});
	});	


	$('#modal_wind').on('click', '.order-button-template', function(e) {
		e.preventDefault();
		var text = $(this).text();
		$('textarea[name="Answer"]').val(text);
	});	


	$('body').on('click', '.stopPending', function(e) {
		e.preventDefault();
		
		arr = $(this).attr('rel').split( " " );
		var id = arr[0];
		var parent_id = arr[1];

		$(this).text('обработка запроса');
		$(this).prop('disabled', true);
		$('.CancelOrderBtn').hide();

		var SSdata = 'Answer_ID='+id;
		$.post('modules/ajax/send_answer_prov.php', SSdata, function(back_data) {
			if (back_data == 0) {
				$.alert({
					title: 'Данные отправлены',
					content: '',
					buttons: {   
						ok: {
							text: "Закрыть",
							btnClass: 'btn-blue',
							keys: ['enter'],
							action: function(){
								//$.modal().close();
								//location.reload();

								location.href = '120'+ parent_id + '.html';
							}
						}
					}
				});
			} else {
				$.alert({
					title: 'Ошибка',
					content: back_data,
					buttons: {   
						ok: {
							text: "Закрыть",
							btnClass: 'btn-blue',
							keys: ['enter'],
							action: function(){
								$('.modal_content').removeAttr('style');
								$.modal().close()
							}
						}
					}
				});
			}
		});
	});

	$('body').on('click', '.form-check', function(e) {
		e.preventDefault();

		var result = 1;

		 $('.field-input-check').each(function() {
		 	if ( $(this).val() === '' ) {
		 		$(this).addClass('field-empty');
		 		result = 0;
		 	} else {
		 		$(this).removeClass('field-empty');
		 	}
  		});

		if (result == 1) {
			$(this).closest("form").submit();
		}
	});


	// ответ от Заказчика

	$('#modal_wind').on('click', '.SendAnswerBtn', function(e) {
		e.preventDefault();
		var ApplicationID = $('#OrderSendAnsw').find('input[name=ApplicationID]').val();
		var FeedBackID = $('#OrderSendAnsw').find('input[name=FeedBackID]').val();
		var RequestID = $('#OrderSendAnsw').find('input[name=RequestID]').val();
		var Answer = $('#OrderSendAnsw').find('textarea[name=Answer]').val().trim();

		//var css = 0;

		if(!Answer){
			$.alert("Не заполнено поле ответа");
		} else {
			// прячем кнопки пока ждем систему				
			$(this).text('обработка запроса');
			$(this).prop('disabled', true);
			var SSdata = 'ApplicationID='+ApplicationID+'&FeedBackID='+FeedBackID+'&RequestID='+RequestID+'&Answer='+Answer;
			$.post('modules/ajax/send_answer2.php', SSdata, function(back_data) {
				if (back_data == 0) {
					$.alert({
						title: 'Данные отправлены',
						content: '',
						buttons: {   
							ok: {
								text: "Закрыть",
								btnClass: 'btn-blue',
								keys: ['enter'],
								action: function(){
									$.modal().close();
									location.reload();
								}
							}
						}
					});
				} else {
					$.alert({
						title: 'Ошибка',
						content: back_data,
						buttons: {   
							ok: {
								text: "Закрыть",
								btnClass: 'btn-blue',
								keys: ['enter'],
								action: function(){
									$.modal().close()
									$('.modal_content').removeAttr('style');
								}
							}
						}
					});
				}
			});

		}
	});
	

	// отправка повтоpного запроса
	$('#modal_req').on('click', '.SendOrderBtn2', function(e) {
		e.preventDefault();

		arr = $(this).attr('rel').split( " " );
		var id = arr[0];
		var fb_id = arr[1];
		var Req = $('#OrderSendForm2').find('.Req').val();

		if(!Req){
			$.alert('Не заполнены поля');
		} else {	
			var SSdata = 'order_id='+id +'&Req='+Req +'&fb_id='+fb_id;

			//alert(SSdata);

			var pressButton = $(this);
			var pressButtonName = pressButton.text();

			// прячем кнопки пока ждем систему				
			pressButton.text('обработка запроса');
			pressButton.prop('disabled', true);
			$('.CancelOrderBtn').hide();


			$.post('modules/ajax/order_exec_req2.php', SSdata, function(back_data) {
				if (back_data == 0) {

					$.alert({
						title: 'Данные отправлены',
						content: '',
						buttons: {   
							ok: {
								text: "Закрыть",
								btnClass: 'btn-blue',
								keys: ['enter'],
								action: function(){
									$.modal().close()
									location.href = '110' + id + '.html';
								}
							}
						}
					});
				} else {
					$.alert({
						title: 'Ошибка',
						content: back_data,
						buttons: {   
							ok: {
								text: "Закрыть",
								btnClass: 'btn-blue',
								keys: ['enter'],
								action: function(){
									pressButton.text(pressButtonName);
									pressButton.prop('disabled', false); 
								}
							}
						}
					});
				}
			});

		}
	});

	$('#order-input-summ').keypress(function(event) {
  		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    		event.preventDefault();
  		}
	});



	$('#modal_ds').on('click', '.SendOrderBtn', function(e) {
		e.preventDefault();

		var id = $(this).attr('rel');
		var DS = $('#OrderSendForm').find('.DS').val();
		var DS = $('#OrderSendForm').find('.DS').val();
		var Served = $('#OrderSendForm').find('.Served').val();
		var testSumm = 0;
		var ApplicationSumm = 0;

		if ($('#order-input-summ').length) {
			ApplicationSumm = $('#order-input-summ').val();
			testSumm = 1;
		}

		
		if(!DS || !Served || (testSumm == 1 && ApplicationSumm < 1) ){
			$.alert('Не заполнены поля');
		} else {	

			// прячем кнопки пока ждем систему				
			$(this).text('обработка запроса');
			$(this).prop('disabled', true);
			$('.CancelOrderBtn').hide();

			var SSdata = 'order_id='+id+'&DS='+DS+'&Served='+Served+'&Costs='+ApplicationSumm;
			//alert (SSdata);
			if ($('#checkbox1').is(':checked')) {
				var Req = $('#OrderSendForm').find('.Req').val();
				SSdata += '&checked=1&Req='+Req;
				var page = '110';
			} else {
				var page = '120';			
			}

			$.post('modules/ajax/order_exec.php', SSdata, function(back_data) {
				if (back_data == 0) {

					$.alert({
						title: 'Данные отправлены',
						content: '',
						buttons: {   
							ok: {
								text: "Закрыть",
								btnClass: 'btn-blue',
								keys: ['enter'],
								action: function(){
									$.modal().close();
									location.href = page + id + '.html';
								}
							}
						}
					});
				} else {
					$.alert({
						title: 'Ошибка',
						content: back_data,
						buttons: {   
							ok: {
								text: "Закрыть",
								btnClass: 'btn-blue',
								keys: ['enter']
							}
						}
					});
				}
			});

		}
	});




	// новая заявка
	$('body').on('click', '.feedback-button', function(e){
		$( ".feedback-container" ).slideToggle('slow');
		if ($(".feedback-overlay").length > 0) {
			$('.feedback-overlay').remove();
		} else {
			//$("#form-feedback")[0].reset();
			$('<div class="feedback-overlay"></div>').insertBefore('.feedback-container')
		}
	});

	$('body').on('click', '.feedback-overlay', function(e){
		$( ".feedback-container" ).slideUp('slow');
		$('.feedback-overlay').remove();
	});

	$('body').on('submit','#form-feedback',function(e){ 
		e.preventDefault();

		$('#form-feedback input[type="text"], #form-feedback textarea').each(function() {
			if ($(this).val() == '') { 
				$(this).addClass('highlight');
			} else {
				$(this).removeClass('highlight');
			}
		});

		if ($('#form-feedback input, #form-feedback textarea').hasClass('highlight')) {
			$.alert({content: 'Не заполнены обязательные поля!', confirmButton: 'Ok'});
			return false;
		} else {
			var email = $("#form-feedback input[name='email']").val();
			var result = email.search( /@/i );
			if (result > 0) {			
				$.alert({content: 'Спасибо за Ваш отзыв!', confirmButton: 'Закрыть', backgroundDismiss: true});
				$( ".feedback-container" ).slideUp();
				$('.feedback-overlay').remove();
				$.post("modules/core/add_feedback.php", $("#form-feedback").serialize());	
			} else {
				$.alert({content: 'Проверьте правильность электронного адреса!', confirmButton: 'Ok', backgroundDismiss: true});
				return false;
			}
		}
	});



	$('.close_modal1_button').click(function() {
		$('.modal_content').removeAttr('style');
		$.modal().close();
	});


	$('span.timers').testTimer();



	$('body').on('submit','#form111',function(e){ 
		e.preventDefault();
		$.post("modules/ajax/change_password.php", $(this).serialize(), function(back_data) {
			$.alert({title: '',content: back_data, confirmButton: 'Ok'});
			$('#form111')[0].reset();
		});
	});

	$('body').on('submit','#form-rmd-pwd',function(e){ 
		e.preventDefault();
		$.post("modules/ajax/remind_password.php", $(this).serialize(), function(back_data) {
			//$.alert({title: '',content: back_data, confirmButton: 'Ok'});
			$('#rmd-pwd-answ').html(back_data);
			$('#form-rmd-pwd')[0].reset();
		});
	});

	$('body').on('submit','#form112',function(e){ 
		e.preventDefault();
		$.post("modules/ajax/change_password2.php", $(this).serialize(), function(back_data) {
			$.alert({title: '',content: back_data, confirmButton: 'Ok'});
			$('#form112')[0].reset();
		});
	});


	///////////////////////////////////////////////////////////////
// Слайдер-аккордион в модальном окне

	$('body').on('click','.OrderSectionHead',function(e){ 
		$(this).next().slideToggle("slow"); 
    });




    // опер статус
    $('body').on('submit','form#form-sent-status', function(e){ 
		e.preventDefault();

		if ($('#form-sent-status input[type="text"]').val() == '') {
			return false;
		} else {
			$.post("modules/ajax/send_oper_status.php", $(this).serialize(), function(back_data) {

				$('#current-status').html(back_data);
				$('#form-sent-status')[0].reset();
			});
		}
	});



});