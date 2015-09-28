define(['jquery'],function ($) {

    function ModalFeedback(){}

    var widgetId2;
    ModalFeedback.prototype = {
        render: function() {
            $(document).ready(function(){
                $("#feedback_submit").click(function(){

                    var name = $('#form_registrationbundle_feedback_name').val(),
                        email = $('#form_registrationbundle_feedback_email').val(),
                        comment = $('#form_registrationbundle_feedback_comment').val();
                    console.log(name,email,comment);

                    $.ajax({
                        url: '/ajax',
                        type: 'post',
//                        data: {'password': JSON.stringify(password)},
                        dataType: 'json',
                        success: function (data) {
                            if((typeof data) == "object"){


                            }
                        }
                    })//ajax

                });
            });
        },
        onloadCallback: function() {
            widgetId2 =grecaptcha.render('feedback_captcha', {
                'sitekey' : (function(){
                    return $('#feedback_captcha').attr('data-siteKey');
                })(),
                'expired-callback': function(){
                    grecaptcha.reset(widgetId2);
                }
            });
        }
    }

    return ModalFeedback;
});
