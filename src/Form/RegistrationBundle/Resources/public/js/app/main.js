define(['./passwordValidation','./Captcha', './ModalFeedback'], function (passwordvalidation, captcha, modalFeedback) {

    var Password, Captcha, ModalFeedback ;
    Password = new passwordvalidation;
    Password.check();

    Captcha = new captcha();
    Captcha.onloadCallback();

    ModalFeedback = new modalFeedback();
    ModalFeedback.render();
    ModalFeedback.onloadCallback();
});