define(['jquery', 'underscore'],function ($, _) {

    function Password(){}

    Password.prototype = {
        check: function(){
            var passwordText = $('#form_registrationbundle_users_password_first'),
                debounce = _.debounce(function(){
                    var password = passwordText.val();
                    $.ajax({
                        url: '/ajax',
                        type: 'post',
                        data: {'password': JSON.stringify(password)},
                        dataType: 'json',
                        success: function (data) {
                            if((typeof data) == "object"){
                                if(data['error']){
                                    if(data['code'] == 0) {
                                        $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                                    }else{
                                        $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                                    }
                                    $('#error').text('').append(data.error);
                                }
                            }
                        }
                    })//ajax
                },1000);

            $(passwordText).keyup(debounce);
        }
    }

    return Password;
});