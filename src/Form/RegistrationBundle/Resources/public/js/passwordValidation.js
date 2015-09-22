$(document).ready(function(){

   var passwordText = $('#form_registrationbundle_users_password_first');

    $(passwordText).keypress(function(){
        setTimeout(function(){
            var password = passwordText.val();
            console.log(password);
            $.ajax({
                url: '/ajax',
                type: 'post',
                data: {'password': JSON.stringify(password)},
                dataType: 'json',
                success: function (data) {
                    console.log(data[1]);
                    if((typeof data) == "object"){
                        if(data[1] === 0){
                            $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                            $('#error').text('').append('Password contains invalid characters (\',>, !,@,)');
                        }
                        if(data[1] === 1){
                            $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                            $('#error').text('').append('Password too short');
                        }
                        if(data[1] === 2){
                            $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                            $('#error').text('').append('Weak password');
                        }
                        if(data[1] === 3){
                            $('#passwordHelp').attr('class', 'alert alert-success').css('display','block');
                            $('#error').text('').append('Good password!!');
                        }
                        if(data[1] === 4){
                            $('#passwordHelp').attr('class', 'alert alert-danger').css('display','block');
                            $('#error').text('').append('too many symbols');
                        }

                    }
                }
            });
        },100);
    });

//alert(passwordText);

});