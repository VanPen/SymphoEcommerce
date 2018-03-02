jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
});
var form = $( "#myform" );
form.validate();
$( "button" ).click(function() {
    alert( "Valid: " + form.valid() );
});