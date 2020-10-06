

(function ($) {
	
	/**
	const username = document.getElementById("username");
	const pass = document.getElementById("password");
	const formElement = document.getElementById("form");
	const errorElement = document.getElementById("error");

	formElement.addEventListener('submit', (e) => {
		let message = [];
		if (username.value == '' || username.value ==  null) {
			message.push("Username is required");
		}
		
		if (pass.value.length < 8){
			message.push("Password must be longer than 8 characters");
		}
		
		if (message.length > 0){
			e.preventDefault();
			errorElement.style.display = "block";
			errorElement.innerText = message.join(', ');
		}
	})
	**/
	
    "use strict";

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    

    

})(jQuery);


