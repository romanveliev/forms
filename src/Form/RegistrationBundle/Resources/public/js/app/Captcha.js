define(['jquery'],function ($) {

    function Captcha(){}

    var widgetId1;

    Captcha.prototype = {
        onloadCallback: function() {
            widgetId1 =grecaptcha.render('captcha', {
                'sitekey' : (function(){
                    return $('#captcha').attr('data-siteKey');
                })(),
                'expired-callback': function(){
                    grecaptcha.reset(widgetId1);
                }
            });
        }
    }

    return Captcha;
});
