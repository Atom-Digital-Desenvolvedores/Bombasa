
jQuery(document).ready(function(jQuery) {
    if (jQuery('.inputphone').length) {
        jQuery('.inputphone').each(function(index, value){
            jQuery(value).brTelMask();
        });
    }
    jQuery(".inputhour").mask("99:99");
    jQuery(".inputdate").mask("99/99/9999");
    jQuery(".inputcpf").mask("999.999.999-99");
    jQuery('.autonumber').autoNumeric('init');
});

jQuery.fn.brTelMask = function() {
    return this.each(function(){
        var el = this;
        jQuery(el).focus(function(){
            jQuery(el).mask("(99) 9999-9999?9");
        });
        jQuery(el).focusout(function(){
            var phone, element;
            element = jQuery(el);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10){
                element.mask("(99) 99999-999?9");
            }else{
                element.mask("(99) 9999-9999?9");
            }
        });
    });
};