<?php

namespace Drupal\mtcaptcha\Admin;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Configure mtcaptcha settings for this site.
 */
class MTCaptchaSettings extends ConfigFormBase {
  
  private  $config;

  public function __construct() {
    $this->config = \Drupal::config('mtcaptcha.settings');
  }
  
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mtcaptcha_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mtcaptcha.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mtcaptcha.settings');
    
    $form['common'] = [
      '#type' => 'details',
      '#title' => $this->t('MTCaptcha Common Settings'),
      '#open' => TRUE 
    ];

    $form['common']['heading'] = [
      '#type' => 'label',
      '#title' => $this->t('You have to <a href="https://www.mtcaptcha.com/pricing/" target="blank" rel="external">register your domain</a> first,
       get private key for your domain from MTCaptcha and save it below.'),
    ]; 

    $form['common']['mtcaptcha_private_key'] = [
      '#default_value' => $config->get('private_key'),
      '#description' => $this->t(''),
      '#maxlength' => 128,
      '#required' => TRUE,
      '#title' => $this->t('Private key'),
      '#type' => 'textfield' 
    ];

    $form['common']['mtcaptcha_enablecaptcha'] = [
      '#default_value' => $config->get('enablecaptcha'),
      '#description' => $this->t('<br> The MTCaptcha will be embedded in Login Form and
      Reset Password Form <br>even though the Enable MTCaptcha is selected for logged  in users. If needed <br>we can disable MTCaptcha for these forms by choosing below options.'),
      '#options' => [
        'all' => $this->t('All Users'),
        'login' => $this->t('Logged In Users'),
        'logout' => $this->t('Logged Out Users')],
      '#title' => $this->t('Enable MTCaptcha for'),
      '#type' => 'select'
    ];

    $form_ids = array( 
      'user_login_form' => $this->t('Login Form'),
      'user_register_form' => $this->t('Registration Form'), 
      'user_pass' => $this->t('Lost Password Form'),
      'user_form' => $this->t('Change Password Form'),
      'comment_comment_form' => $this->t('Comment Form'),
      'contact_message_feedback_form' => $this->t('Contact Form') 
    );

    $form['common']['mtcaptcha_enable'] = array(
      '#default_value' => $config->get('mtcaptcha_form_enable'),
      '#title' => $this->t('MTCaptcha is applied for'),
      '#type' => 'checkboxes',
      '#description' => $this->t('Please enable MTCaptcha for above forms'),
      '#options' => $form_ids
    );

    $form['common']['mtcaptcha_other_enable'] = [
      '#default_value' => $config->get('other_form_id'),
      '#description' => $this->t('Please give other form ids mtcaptcha should be enabled'),
      '#maxlength' => 128,
      '#required' => FALSE,
      '#title' => $this->t('Other Forms to enable'),
      '#type' => 'textfield'
    ];

    $form['common']['show_captcha_label_form'] = [
      '#title' =>  $this->t('Show Captcha label in the form'),
      '#type' => 'checkbox',
      '#default_value' => $config->get('show_captcha_label_form'),
      '#description' => t('Show or Hide Captcha Label in the forms'),
      '#attributes' => array(
            'class' => array('captcha-label'), 
      )    
    ];

    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('MTCaptcha Basic Options'),
      '#open' => TRUE 
    ];

    $form['general']['heading'] = [
      '#type' => 'label',
      '#title' => $this->t('You have to <a href="https://www.mtcaptcha.com/pricing/" target="blank" rel="external">register your domain</a> first,
       get the site key for your domain from MTCaptcha and save it below.'),
    ];  

    $form['general']['mtcaptcha_site_key'] = [
      '#default_value' => $config->get('site_key'),
      '#description' => $this->t(''),
      '#maxlength' => 40,
      // '#required' => TRUE,
      '#title' => $this->t('Site key'),
      '#type' => 'textfield'
    ];

    $form['general']['mtcaptcha_theme'] = [
      '#default_value' => $config->get('theme'),
      '#description' => $this->t('Defines which theme to use for mtcaptcha.'),
      '#options' => [
        'standard' => $this->t('standard'),
        'overcast' => $this->t('overcast'),
        'neowhite' => $this->t('neowhite'),
        'goldbezel' => $this->t('goldbezel'),
        'blackmoon' => $this->t('blackmoon'),
        'darkruby' => $this->t('darkruby'),
        'touchoforange' => $this->t('touchoforange'),
        'caribbean' => $this->t('caribbean'),
        'woodyallen' => $this->t('woodyallen'),
        'chrome' => $this->t('chrome'),
        'highcontrast' => $this->t('highcontrast')],
      '#title' => $this->t('Theme'),
      '#type' => 'select' 
    ];

    $form['general']['mtcaptcha_language'] = [
      '#default_value' => $config->get('language'),
      '#description' => $this->t('Defines which Language to use for mtcaptcha.'),
      '#options' => [
        'en' => $this->t('English(en)'),
        'ar' => $this->t('Arabic(ar)'),
        "af" => $this->t("Afrikaans(af)"),
        "am" => $this->t("Amharic(am)"),
        "hy" => $this->t("Armenian(hy)"),
        "az" => $this->t("Azerbaijani(az)"),
        "eu" => $this->t("Basque(eu)"),
        "bn" => $this->t("Bengali(bn)"),
        "bg" => $this->t("Bulgarian(bg)"),
        "ca" => $this->t("Catalan(ca)"),
        "zh-hk" => $this->t("Chinese (Hong Kong)(zh-HK)"),
        "zh" => $this->t("Chinese(zh)"),
        "hr" => $this->t("Croatian(hr)"),
        "cs" => $this->t("Czech(cs)"),
        "da" => $this->t("Danish(da)"),
        "nl" => $this->t("Dutch(nl)"),
        "en" => $this->t("English"),
        "et" => $this->t("Estonian(et)"),
        "fil" => $this->t("Filipino(fil)"),
        "fi" => $this->t("Finnish(fi)"),
        "fr" => $this->t("French(fr)"),
        "gl" => $this->t("Galician(gl)"),
        "ka" => $this->t("Georgian(ka)"),
        "de" => $this->t("German(de)"),
        "el" => $this->t("Greek(el)"),
        "gu" => $this->t("Gujarati(gu)"),
        "iw" => $this->t("Hebrew(iw)"),
        "hi" => $this->t("Hindi(hi)"),
        "hu" => $this->t("Hungarain(hu)"),
        "is" => $this->t("Icelandic(is)"),
        "id" => $this->t("Indonesian(id)"),
        "it" => $this->t("Italian(it)"),
        "ja" => $this->t("Japanese(ja)"),
        "kn" => $this->t("Kannada(kn)"),
        "ko" => $this->t("Korean(ko)"),
        "ko" => $this->t("Korean(ko)"),
        "lv" => $this->t("Latvian(lv)"),
        "lt" => $this->t("Lithuanian(lt)"),
        "ms" => $this->t("Malay(ms)"),
        "ml" => $this->t("Malayalam(ml)"),
        "mr" => $this->t("Marathi(mr)"),
        "mn" => $this->t("Mongolian(mn)"),
        "no" => $this->t("Norwegian(no)"),
        "fa" => $this->t("Persian(fa)"),
        "pl" => $this->t("Polish(pl)"),
        "pt" => $this->t("Portuguese(pt)"),
        "ro" => $this->t("Romanian(ro)"),
        "ru" => $this->t("Russian(ru)"),
        "si" => $this->t("Sinhalese(si)"),
        "sr" => $this->t("Serbian(sr)"),
        "sk" => $this->t("Slovak(sk)"),
        "sl" => $this->t("Slovenian(sl)"),
        "es" => $this->t("Spanish(es)"),
        "sw" => $this->t("Swahili(sw)"),
        "sv" => $this->t("Swedish(sv)"),
        "ta" => $this->t("Tamil(ta)"),
        "te" => $this->t("Telugu(te)"),
        "th" => $this->t("Thai(th)"),
        "tr" => $this->t("Turkish(tr)"),
        "uk" => $this->t("Ukrainian(uk)"),
        "ur" => $this->t("Urdu(ur)"),
        "vi" => $this->t("Vietnamese(vi)"),
        "zu" => $this->t("Zulu(zu)") ],
      '#title' => $this->t('Language'),
      '#type' => 'select'
    ];   

    $form['general']['mtcaptcha_widgetsize'] = [
      '#default_value' => $config->get('widgetsize'),
      '#description' => $this->t('Defines which widgetsize to use for mtcaptcha.'),
      '#options' => [
        'standard' => $this->t('Standard'),
        'mini' => $this->t('Modern Mini')],
      '#title' => $this->t('Captcha Widget size'),
      '#type' => 'select'
    ];

    $form['advanced'] = [
      '#type' => 'details',
      '#title' => $this->t('MTCaptcha Advanced Options'),
      '#open' => TRUE 
    ];

    $form['advanced']['custom_config_enable'] = [
      '#title' =>  $this->t('Enable custom MTCaptcha configuration '),
      '#type' => 'checkbox',
      '#default_value' => $config->get('custom_config_enable'),
      '#description' => t('Provides the custom configuration to render the MTCaptcha in your forms.<br/> 
                          1. You have to <a href="https://www.mtcaptcha.com/pricing/" target="blank" rel="external">register your domain</a> and get your required keys.<br/>
                          2. Visit <a href="http://service.mtcaptcha.com/mtcv1/demo/" target="blank" rel="external">MTCaptcha demo page</a> to customize 
                          the MTCaptcha configuration.<br/> 
                          3. Customize the <b>Basic Options</b>, <b>Custom Style</b> and <b>Custom Language</b>.<br/>
                          4. Click on Apply button to view the changes. <br/>
                          5. If the changes are looks good, 
                          then copy the snippet located inside the <b>script</b> tag under <b>Embed Snippet</b> tab.
                          <br/>
                          6. Paste the copied snippet to the below textbox. <br/> '),
      '#attributes' => array(
            'class' => array('captcha-label'), 
      )    
    ];

    $form['advanced']['custom_config_setting'] = [
      '#default_value' => $config->get('custom_config_setting'),
      '#required' => FALSE,
      '#type' => 'textarea',
      '#attributes' => array('placeholder' => t("var mtcaptchaConfig = {
        'sitekey': 'YOUR SITE KEY',
        'widgetSize': 'mini',
        'lang': 'en',
        'autoFormValidate': true,
        'loadAnimation': true,
       };
     (function(){var mt_service = document.createElement('script');mt_service.async = true;mt_service.src = 'https://service.mtcaptcha.com/mtcv1/client/mtcaptcha.min.js';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mt_service);
     var mt_service2 = document.createElement('script');mt_service2.async = true;mt_service2.src = 'https://service2.mtcaptcha.com/mtcv1/client/mtcaptcha2.min.js';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mt_service2);}) ();"),) 
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $mtcaptchaConfig = $this->config('mtcaptcha.settings');
    $mtcaptchaConfig
      ->set('site_key', $form_state->getValue('mtcaptcha_site_key'))
      ->set('private_key', $form_state->getValue('mtcaptcha_private_key'))
      ->set('show_captcha_label_form', $form_state->getValue('show_captcha_label_form'))
      ->set('theme', $form_state->getValue('mtcaptcha_theme'))
      ->set('language', $form_state->getValue('mtcaptcha_language'))
      ->set('widgetsize', $form_state->getValue('mtcaptcha_widgetsize'))
      ->set('enablecaptcha', $form_state->getValue('mtcaptcha_enablecaptcha'))
      ->set('mtcaptcha_form_enable', $form_state->getValue('mtcaptcha_enable'))
      ->set('other_form_id', $form_state->getValue('mtcaptcha_other_enable'))
      ->set('custom_config_enable', $form_state->getValue('custom_config_enable'))
      ->set('custom_config_setting', $form_state->getValue('custom_config_setting'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}