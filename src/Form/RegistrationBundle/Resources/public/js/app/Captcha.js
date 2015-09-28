define(['jquery'],function ($) {

    function Feedback(){}

    var widgetId1;

    Feedback.prototype = {
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

    return Feedback;

});