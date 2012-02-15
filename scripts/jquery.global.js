// JavaScript Document

$(document).ready(function(){

	$('#sample_form').submit(function(index, domEle) {
		
		var thisObj = this;
		
		$.ajax({
			url: 'library/ajax.gateway.php',
			type: "POST",
			data: "func=doSubscribe&"+$(this).serialize(),
			cache: false,
			dataType: "json",
			beforeSend: function(result) {
				$('#submit',thisObj).buttonStatus('busy');
			},
			success: function(data, textStatus) {
				if (data.success) {
					
					$('#submit',thisObj).buttonStatus('done');
					
					if (data.reload) {
						setTimeout(function() { window.location.reload(); }, 500);
					}
					
					if (data.message) $(thisObj).html(data.message);
					
				} else {
					
					var msg = data.message + '\n';
					for (var i in data.errors) {
						msg += ' - '+data.errors[i] + '\n';
					}
					alert(msg);
					
					$('#submit',thisObj).buttonStatus('fail');
					
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
				alert('Error: '+textStatus);
				$('#submit',thisObj).buttonStatus('reset');
			}
		});
		
		return false;
		
	});
	
});

//button processor
(function($){
	jQuery.fn.buttonStatus = function( mode ) {
		if ( mode == 'busy' ) {
			$(this).data('original', $(this).val());
			$(this)
			.val('Please Wait...')
			.addClass('button_load')
			.attr("disabled", true);
		} else if ( mode == 'done' ) {
			$(this)
			.val($(this).data('original'))
			.removeClass('button_load')
			.addClass('button_done')
			.removeAttr("disabled");
		} else if ( mode == 'fail' ) {
			$(this)
			.val($(this).data('original'))
			.removeClass('button_load')
			.removeClass('button_done')
			.addClass('button_fail')
			.removeAttr("disabled");
		} else if ( mode == 'reset' ) {
			$(this)
			.val($(this).data('original'))
			.removeClass('button_fail')
			.removeClass('button_load')
			.removeClass('button_done')
			.removeAttr("disabled");
		}
	};
})(jQuery);
