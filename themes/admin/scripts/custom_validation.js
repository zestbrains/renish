/**
 * check for password contains atleast one Uppercase letter one lowercase letter one number and one symbol
 */
$.validator.addMethod("passcheck", function (value) {    
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]/.test(value)
});

/**
 * Check to allow only alphabets and numbers
 */
$.validator.addMethod("alphanum", function(value, element) {
	return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
}); 

/**
 * Check to allow only alphabets
 */
$.validator.addMethod("alphaonly", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z]+$/);
 });

$.validator.addMethod("alphaspecial", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z.,\b]+$/);
 });


