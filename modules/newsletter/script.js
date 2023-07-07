const { fromJSON } = require("postcss");

/* NEWSLETTER */
( function ( $ ) { 
	let button 		= $('.js-submit-button'),
		nlTitle		= $('.newsletter-title'),
		form 		= $('.js-newsletter-form'),
		formName 	= $('.js-name'),
		formEmail	= $('.js-email'),
		formTerms	= $('.js-terms'),
		successMessage = $('.newsletter-message');

init();

function init(){
	$(button).click( function(){

	var hasErrors = formValidation();
	
	// console.log(form.serialize());

	if (!hasErrors){
		$.ajax({
			url: encodeURI(window.rest_object.api_url)+'mailchimp', // need to connect to rest.php
			type: 'post',
			dataType: 'json',
			data: form.serialize(),
			success: function(data) {
				if (data.success) {
					form.addClass('display-none');
					nlTitle.addClass('display-none');
					successMessage.removeClass('display-none');
				}
			}
		});
	}

	});
 }

 function validateEmail (email) {
	var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	return re.test( email );
 }

 function formValidation() {
	var name = formName.val();
	var email = formEmail.val();
	var terms = formTerms.val();
	var errors = {};

	// Name
	if (name.length === 0) {
		var message = formName.data('message');
		formName.addClass('is-error');
		formName.next().html(message);
		errors.name = message;
	}
	// Email
	if (email.length === 0) {
		var message = formEmail.data('message');
		formEmail.addClass('is-error');
		formEmail.next().html(message);
		errors.email = message;
	} else if ( !validateEmail(email) ) {
		var message = formEmail.data('message');
		formEmail.addClass('is-error');
		formEmail.next().html(message);
		errors.email = message;
	}
	// Accept Terms
	if (!terms) {
		var message = formTerms.data('message');
		formTerms.addClass('is-error');
		formTerms.next().html(message);
		errors.terms = message;
		
	}

	// Return false if no errors
	if( Object.keys(errors).length === 0 ) {
		return false;
	}

	return true;

 }


} )( jQuery );

