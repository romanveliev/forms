define(['jquery', 'underscore'],function ($, _) {

    function Password(){}

    Password.prototype = {
        check: function(){
            var passwordText = $('#form_registrationbundle_users_password_first');
            $(passwordText).keyup(function(){
                setTimeout(function(){
                    var password = passwordText.val();
                    $.ajax({
                        url: '/ajax',
                        type: 'post',
                        data: {'password': JSON.stringify(password)},
                        dataType: 'json',
                        success: function (data) {
                            if((typeof data) == "object"){
                                console.log(data.error);
                                if(data['error']){
                                    $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                                    $('#error').text('').append(data.error);
                                }
                            }
                        }
                    });//end Ajax
                },100);//end setTimeout()
            });//keypress
        }
    }

    return Password;

});