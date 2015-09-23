define(['jquery'],function ($) {

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
                                if(data['message'] === 0){
                                    $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                                    $('#error').text('').append("Password contains invalid characters (\' < > ! , @ | . + = ( ) * & ^ % $ # )");
                                }
                                if(data['message'] === 1){
                                    $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                                    $('#error').text('').append('Password too short');
                                }
                                if(data['message'] === 2){
                                    $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                                    $('#error').text('').append('Weak password');
                                }
                                if(data['message'] === 3){
                                    $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                                    $('#error').text('').append('Good password !!!');
                                }
                                if(data['message'] === 4){
                                    $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                                    $('#error').text('').append('too many symbols');
                                }
                            }
                        }
                    });//end Ajax
                },5000);//end setTimeout()
            });//keypress
        }
    }

    return Password;

});