(function ($, Drupal, drupalSettings) {
    if(!mtcaptchaConfig){
        var mtcaptchaConfig;   
        if (typeof drupalSettings.config != "undefined") {
            mtcaptchaConfig = JSON.parse(drupalSettings.config)
       }
    }
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.text = "var mtcaptchaConfig = " + JSON.stringify(mtcaptchaConfig);
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(script);
})(jQuery, Drupal, drupalSettings);
