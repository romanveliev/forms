define(['jquery', 'underscore'],function ($, _) {

    function Password(){}

    Password.prototype = {
        check: function(){
            var passwordText = $('#form_registrationbundle_users_password_first');

            $(passwordText).keyup(function(){
                var password = passwordText.val();
                console.log(password);
                $.ajax({
                    url: '/ajax',
                    type: 'post',
                    data: {'password': JSON.stringify(password)},
                    dataType: 'json',
                    success: function (data) {
                        if((typeof data) == "object"){
                            if(data['error']){
                                $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                                $('#error').text('').append(data.error);
                            }
                        }
                    }
                })//ajax
            });//keypress
        }

    }

    return Password;
});