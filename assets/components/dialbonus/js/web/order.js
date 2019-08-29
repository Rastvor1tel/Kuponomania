$(function () {
   $('body').on('DOMSubtreeModified', '#ms2_order_cost', function () {
       if ($(this).text() != '') {
           $( "#bonus-block" ).load( "/personal/korzina/ .bonus-ajax-content" );
       }
   });
    $('body').on('change', 'input#bonuspayed', function () {
        $('.bonus-block__input.bonus-value').slideToggle();
    });
})