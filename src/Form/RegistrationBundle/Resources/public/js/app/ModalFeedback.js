define(['jquery'],function ($) {

    function ModalFeedback(){}

    var widgetId2;
    ModalFeedback.prototype = {
        render: function() {
            $(document).ready(function(){
                $("#feedback_submit").click(function(){

                    var feedbackCaptcha = grecaptcha.getResponse(widgetId2);
                        if(feedbackCaptcha.length == 0){
                            $('#error_box').attr('class', 'alert alert-danger').css('display','block');
                            return;
                        }

                    var name = $('#form_registrationbundle_feedback_name').val(),
                        email = $('#form_registrationbundle_feedback_email').val(),
                        comment = $('#form_registrationbundle_feedback_comment').val(),
                        feedback = [name, email, comment, feedbackCaptcha];
                    console.log(name,email,comment,feedbackCaptcha);

                    grecaptcha.reset(widgetId2);

                    $.ajax({
                        url: '/index_feedback',
                        type: 'post',
                        data: {'feedback': JSON.stringify(feedback)},
                        dataType: 'json',
                        success: function (data) {
                            console.log(data);
                            if((typeof data) == "object"){
                                console.log(data['code']);
                                if(data['code'] == 0) {
                                    $('#error_box').attr('class', 'alert alert-danger').css('display','block');
                                    $('#errorFeedback').text('').append(data.error);
                                }
                                if(data['code'] == 1){
                                    location.reload();
                                }
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
