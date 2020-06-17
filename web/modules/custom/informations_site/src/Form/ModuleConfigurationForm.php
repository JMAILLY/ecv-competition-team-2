<?php

namespace Drupal\informations_site\Form;

use Drupal\Core\Form\ConfigFormBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ModuleConfigurationForm.
 */
class ModuleConfigurationForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'informations_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return [
      'informations_site.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL)
  {
    $config = $this->config('informations_site.settings');

    $form['contact'] = [
      '#type' => 'details',
      '#title' => $this->t('Contact'),
      '#open' => TRUE,
    ];
    $form['contact']['number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Numéro de téléphone'),
      '#size' => 60,
      '#default_value' => $config->get('number'),
    ];

    $form['address'] = [
      '#type' => 'details',
      '#title' => $this->t('Adresse'),
      '#open' => TRUE,
    ];
    $form['address']['street'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Adresse'),
      '#size' => 60,
      '#default_value' => $config->get('street'),
    ];
    $form['address']['zip_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Code postal'),
      '#maxlength' => 5,
      '#size' => 5,
      '#default_value' => $config->get('zip_code'),
    ];
    $form['address']['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Ville'),
      '#size' => 60,
      '#default_value' => $config->get('city'),
    ];

    $form['social_media'] = [
      '#type' => 'details',
      '#title' => $this->t('Réseaux sociaux'),
      '#open' => TRUE,
    ];
    $form['social_media']['facebook'] = [
      '#type' => 'url',
      '#title' => $this->t('Lien Facebook'),
      '#size' => 60,
      '#default_value' => $config->get('facebook'),
    ];
    $form['social_media']['instagram'] = [
      '#type' => 'url',
      '#title' => $this->t('Lien Instagram'),
      '#size' => 60,
      '#default_value' => $config->get('instagram'),
    ];
    $form['social_media']['twitter'] = [
      '#type' => 'url',
      '#title' => $this->t('Lien Twitter'),
      '#size' => 60,
      '#default_value' => $config->get('twitter'),
    ];
    $form['social_media']['linkedin'] = [
      '#type' => 'url',
      '#title' => $this->t('Lien Linkedin'),
      '#size' => 60,
      '#default_value' => $config->get('linkedin'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('informations_site.settings')
      ->set('number', $form_state->getValue('number'))

      ->set('street', $form_state->getValue('street'))
      ->set('zip_code', $form_state->getValue('zip_code'))
      ->set('city', $form_state->getValue('city'))

      ->set('facebook', $form_state->getValue('facebook'))
      ->set('instagram', $form_state->getValue('instagram'))
      ->set('twitter', $form_state->getValue('twitter'))
      ->set('linkedin', $form_state->getValue('linkedin'))

      ->save();
  }
}
