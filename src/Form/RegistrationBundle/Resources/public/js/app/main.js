define(['./passwordValidation','./Captcha'],function (passwordvalidation, captcha) {
    var Password, Captcha ;
    Password = new passwordvalidation;
    Password.check();

    Captcha = new captcha();
    Captcha.onloadCallback();
});