<?php
namespace Drupal\rk_customlogin\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RKCustomForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rk_custom_form';
  }
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Enter Name:'),
      '#required' => TRUE,
    );
    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Enter Email ID:'),
      '#required' => TRUE,
    );
    $form['phone'] = array (
      '#type' => 'tel',
      '#title' => t('Enter Contact Number'),
    );
    $form['gender'] = array (
      '#type' => 'select',
      '#title' => ('Select Gender:'),
      '#options' => array(
        'Male' => t('Male'),
		'Female' => t('Female'),
        'Other' => t('Other'),
      ),
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  
  public function validateForm(array &$form, FormStateInterface $form_state) {

    if(strlen($form_state->getValue('phone')) < 10) {
      $form_state->setErrorByName('phone', $this->t('Please enter a valid Contact Number'));
    }
  }
  
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage(t("Submission Done!! Registered Values are:"));
	foreach ($form_state->getValues() as $key => $value) {
	  \Drupal::messenger()->addMessage($key . ': ' . $value);
    }
  }

}