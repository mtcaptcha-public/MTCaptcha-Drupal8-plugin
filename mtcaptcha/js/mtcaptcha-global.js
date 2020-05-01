
jQuery(document).ready(function () {   
    enableFields();
    var checkBoxValue = jQuery("#edit-custom-config-enable");
    jQuery(checkBoxValue).click(function () {
        enableFields();
    });
});

function enableFields() {
    var checkBoxValue = jQuery("#edit-custom-config-enable");
    var jsonValue = jQuery("#edit-custom-config-setting");
    var siteKey = jQuery("#edit-mtcaptcha-site-key");
    var privateKey = jQuery("#edit-mtcaptcha-private-key");
    var theme = jQuery("#edit-mtcaptcha-theme");
    var lang = jQuery("#edit-mtcaptcha-language");
    var widgetSize = jQuery("#edit-mtcaptcha-widgetsize");
    if(checkBoxValue.is(":checked") || jsonValue.is(":focus")) {
        jQuery(jsonValue).removeAttr("disabled").focus();
        jQuery(siteKey).attr("disabled", "disabled");
        jQuery(theme).attr("disabled", "disabled");
        jQuery(lang).attr("disabled", "disabled");
        jQuery(widgetSize).attr("disabled", "disabled");
      } else {
        jQuery(jsonValue).attr("disabled", "disabled");
        jQuery(siteKey).removeAttr("disabled");
        jQuery(privateKey).removeAttr("disabled");
        jQuery(theme).removeAttr("disabled");
        jQuery(lang).removeAttr("disabled");
        jQuery(widgetSize).removeAttr("disabled");
      }
}
