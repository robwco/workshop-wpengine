jQuery(function($){
	$('form.ztl-optin-form').submit(function(e){
		var form = $(e.delegateTarget),
			inputName = form.find('input[name="name"]'),
			inputEmail = form.find('input[name="email"]');

		if (inputName.length > 0 && inputName.val() == ""){
			alert("Sorry you didn't put any name. Please enter your name");
			inputName.focus();
			return false;
		}

		if (inputEmail.val() == ""){
			alert("Sorry you didn't put any email. Please enter your email");
			inputEmail.focus();
			return false;
		}
		else {
			var str = inputEmail.val();
			var filter=/^(\S+@\S+)$/i;

			if (!filter.test(str)) {
				alert("Please enter a valid email address.");
				inputEmail.focus();
				return false;
			}
		}

		return true;
	});
});
