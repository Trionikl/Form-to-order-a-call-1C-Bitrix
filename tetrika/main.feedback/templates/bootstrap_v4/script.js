/* Article FructCode.com */
$( document ).ready(function() {
	$('.phone').mask('+7(999) 999-9999');	
		
	$("#mainFeedback_telephone").mask("+7(999) 999-9999",{completed:function(){$("#btn-form-feedback").prop('disabled', false)}});
	
    $("#btn-form-feedback").click(
		function(){
			url="/local/components/tetrika/main.feedback/ajax.php";
			sendAjaxForm('result_form', 'ajax_form', url);
			return false; 
		}
	);
});

function sendAjaxForm(result_form, ajax_form, url) {	
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
		$("#btn-form-feedback").prop('disabled', true)
			$('.result_form_success').removeClass('d-none')
		},
    	error: function(response) { // Данные не отправлены
			$('.result_form_error').removeClass('d-none')
		}
	});
}