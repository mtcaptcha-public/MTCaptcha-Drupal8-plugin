(function ($, Drupal, drupalSettings) {
    if(!mtcaptchaConfig){
        var mtcaptchaConfig;   
        if (typeof drupalSettings.config) {
            mtcaptchaConfig = JSON.parse(drupalSettings.config)
       }
    }
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.text = "var mtcaptchaConfig = " + JSON.stringify(mtcaptchaConfig);
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(script);
    var mt_captcha_service = document.createElement('script');
    mt_captcha_service.async = true;
    mt_captcha_service.src = 'https://service.mtcaptcha.com/mtcv1/client/mtcaptcha.min.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mt_captcha_service);
    var mt_captcha_service2 = document.createElement('script');
    mt_captcha_service2.async = true;
    mt_captcha_service2.src = 'https://service2.mtcaptcha.com/mtcv1/client/mtcaptcha.min.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mt_captcha_service2);
})(jQuery, Drupal, drupalSettings);