require('./bootstrap');

$( document ).ready(function() {
    $('#appForm').change(function(){
        if ($(this).val() == "false") {
            $('.falseSelected').hide();
            $('.trueSelected').show();
        } else {
            $('.falseSelected').show();
            $('.trueSelected').hide();
        }
    });

    $('.notification').fadeIn('slow').delay(3000).fadeOut('slow');

    $('#subscription-clicked').click(function() {
        if($('.card-number').val() && $('.card-cvc').val() && $('.card-expiry-month').val() && $('.card-expiry-year').val()) {
            $('#subscription-form').fadeOut('fast');
            $('#subscription-loading').delay(500).fadeIn('slow');
            $('#subscription-loading').delay(12000).fadeOut('fast');
            $('#subscription-form').delay(13500).fadeIn('slow');
        }
    });

});
