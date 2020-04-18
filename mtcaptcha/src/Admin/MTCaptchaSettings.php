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
    $form['general'] = [
      '#type' => 'details',
      '#title' => $this->t('MTCaptcha Options'),
      '#open' => TRUE 
    ];

    $form['general']['heading'] = [
      '#type' => 'label',
      '#title' => $this->t('You have to <a href="https://www.mtcaptcha.com/pricing/" target="blank" rel="external">register your domain</a> first,
       get required keys from MTCaptcha and save them bellow.'),
    ];  

    $form['general']['mtcaptcha_site_key'] = [
      '#default_value' => $config->get('site_key'),
      '#description' => $this->t(''),
      '#maxlength' => 40,
      '#required' => TRUE,
      '#title' => $this->t('Site key'),
      '#type' => 'textfield'
    ];

    $form['general']['mtcaptcha_private_key'] = [
      '#default_value' => $config->get('private_key'),
      '#description' => $this->t(''),
      '#maxlength' => 128,
      '#required' => TRUE,
      '#title' => $this->t('Private key'),
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

    $form['general']['mtcaptcha_enablecaptcha'] = [
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

    $form['general']['mtcaptcha_enable'] = array(
      '#default_value' => $config->get('mtcaptcha_form_enable'),
      '#title' => $this->t('MTCaptcha is applied for'),
      '#type' => 'checkboxes',
      '#description' => $this->t('Please enable MTCaptcha for above forms'),
      '#options' => $form_ids
    );

    $form['general']['mtcaptcha_other_enable'] = [
      '#default_value' => $config->get('other_form_id'),
      '#description' => $this->t('Please give other form ids mtcaptcha should be enabled'),
      '#maxlength' => 128,
      '#required' => FALSE,
      '#title' => $this->t('Other Forms to enable'),
      '#type' => 'textfield'
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
      ->set('theme', $form_state->getValue('mtcaptcha_theme'))
      ->set('language', $form_state->getValue('mtcaptcha_language'))
      ->set('widgetsize', $form_state->getValue('mtcaptcha_widgetsize'))
      ->set('enablecaptcha', $form_state->getValue('mtcaptcha_enablecaptcha'))
      ->set('mtcaptcha_form_enable', $form_state->getValue('mtcaptcha_enable'))
      ->set('other_form_id', $form_state->getValue('mtcaptcha_other_enable'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
