$(document).ready(function() {
	$('#new-entry .error').hide();
	$('#new-entry input:first').focus();
	$('#new-entry').on('blur', 'input, textarea', function() {
		validateInputFields.call($(this));
	});
	$('#submit-btn').on('click', function(e) {
		var result = true;
		$('#new-entry input, textarea').each( function() {
			if ( validateInputFields.call($(this)) === false) {
				result = false;
			}
		});
		if (result === false) {
			return false;
		}
		
		var inputData = $('#new-entry').serialize();
		var action = $('#new-entry').attr('action');
		$.ajax({
    		type : 'POST',
    		url : 'add.php',
    		data : inputData,
    		dataType : 'json'
    	}).done(function(data, textStatus, jqXHR ) {
    		var msg;
 			if (data['result'] == true) {
				msg = "<h1>New entry was submitted successfully!</h1>";
			} else {
				msg = "<h1>Something went wrong! Please try later.</h1>\n"
				      + "<p>";
				      + print_r($result['error']);
				      + "</p>";
			}   
			msg += addBackToLinks();  
			$('div.entry').html(msg);  	
    	}).fail(function(jqXHR, textStatus, errorThrown) {
    		var msg;
            msg = "The following error occured: " + textStatus + errorThrown
         	      + addBackToLinks();
         	$('div.entry').html(msg);
		});
		e.preventDefault();      	
	});

	function addBackToLinks() {
		var msg;
		msg  = '<p>'
		       + 'Back to <a href="index.php">home</a> or Add <a href="entry.php">new entry</a> page.'
		       + '</p>';
		return msg;
	}

	function validateInputFields() {
		var result = true;
		var id = $(this).attr('id');
		var errId = '#'+id +'-error';
		if ($(this).val() === "") {
			var text = $('#'+id +'-label').text().replace(':','');
			var errMessage = text + ' cannot be empty. Please enter something.';
			$(errId).text(errMessage);
			$(errId).show();
			result = false;
		} else {
			if ($(errId).is(':visible')) {
				$(errId).hide();
			}
		}
		return result;
	}

});