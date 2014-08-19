var addEntry = {
	config : {
		inputForm : $('#new-entry'),
		output  : $('#entry')
	},
	init : function() { 
			addEntry.initializeForm();
			addEntry.config.inputForm.on('focusout', 'input, textarea', function() {
				addEntry.validateInputFields($(this));
			});
			$('#submit-btn').on('click', function(e) {
				// check input error 
				var result = true;
				addEntry.config.inputForm.find('input, textarea').each( function() {
					if ( addEntry.validateInputFields($(this)) === false) {
						result = false; 
					}
				}); 
				if (result === false) { 
					return false; 
				}
				addEntry.submitForm(); 
				e.preventDefault();  
			}); 
	},
	submitForm : function () {
			$.ajax({
    			type : 'POST',
    			url : 'add.php',
    			data : addEntry.config.inputForm.serialize(),
    			dataType : 'json',
		  		success: function( resp ) {
		 			if (resp['result'] == true) {
						addEntry.config.output.html(addEntry.getSuccessContent());
					} else {
					    addEntry.config.output.html(addEntry.getErrorContent("", resp['error']));
					}   
		  		},
  				error: function( req, status, err ) {
         			addEntry.config.output.html(addEntry.getErrorContent(status, err));
  				}
  			}); 
	},
	getSuccessContent : function () {
			return "<h1>New entry was submitted successfully!</h1>" + addEntry.addBackToLinks();
	},
	getErrorContent : function (status, error) {
			return "<h1>Something went wrong! Please try again later.</h1><p>" 
					+ status + error + "</p>" + addEntry.addBackToLinks();
	},
	initializeForm : function () {
			addEntry.config.inputForm.find('error').hide();
			$('#author').focus();
	},
	addBackToLinks : function () {
			return '<p>'
	               + 'Back to <a href="index.php">home</a> or Add <a href="entry.php">new entry</a> page.'
	       		   + '</p>';
	},
	validateInputFields : function (ifield) {
			var result = true;
			var id = ifield.attr('id');
			var errorInputField = $('#'+id +'-error');
			if (ifield.val() === "") {
				var text = $('#'+id +'-label').text().replace(':',''); //stripping ':' from label
				errorInputField.text(text + ' cannot be empty. Please enter something.');
				errorInputField.show();
				result = false;
			} else {
				if (errorInputField.is(':visible')) {
					errorInputField.hide();
				}
			}
			return result;
	}
}

$(document).ready(function() { addEntry.init(); });