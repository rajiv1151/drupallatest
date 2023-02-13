<?php

namespace Drupal\employee\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand; //to show messages into the html
use Drupal\Core\Database\Database;

/**
 * Provides a employee form.
 */
class EmployeeAjaxForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'employee_ajax';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
	
	$form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('Employee Ajax form.'),
    ];
	//To check form is working or not
	$form['element'] = [
      '#type' => 'markup',
      '#markup' => "<div class='success'></div>",
    ];

    $form['emp_firstname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name'),
      '#required' => TRUE,
      '#maxlength' => 30,
    ];

    $form['emp_lastname'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name'),
      '#required' => TRUE,
      '#maxlength' => 30,
    ];

    $form['emp_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Employee Email'),
      '#required' => TRUE,
      '#maxlength' => 100,
    ];
    
    $form['emp_zipcode'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Employee ZIP code'),
      '#required' => TRUE,
      '#maxlength' => 6,
    ];
	$form['accept'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('I accept the terms of use of the site'),
      '#description' => $this->t('Please read and accept the terms of use'),
    );

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Save'),
	    '#ajax' => [
	      'callback' => '::submitData',
	    ],
    ];
	
	//$form['#attached']['library'][] = 'employee/employee-library';

    return $form;
  }
  
   /**
   * {@inheritdoc}
   */
  public function submitData(array &$form, FormStateInterface $form_state) {
	$ajax_response = new AjaxResponse();
	
	$conn = Database::getConnection();
    $formField = $form_state->getValues();
    $formData['emp_firstname'] = $formField['emp_firstname'];
    $formData['emp_lastname'] = $formField['emp_lastname'];
    $formData['emp_email'] = $formField['emp_email'];
    $formData['emp_zipcode'] = $formField['emp_zipcode'];
     //insert data into db
    $conn->insert('employee')
	  ->fields($formData)
	  ->execute();
	  
	//set message after submission
	$ajax_response->addCommand(new HtmlCommand('.success', 'Form Submitted Sucessfully.'));
	//$ajax_response->addCommand(new ReplaceCommand(NULL, $form));
	return $ajax_response;
  }

  /**
   * {@inheritdoc}
   */
 /* public function validateForm(array &$form, FormStateInterface $form_state) {
    $formField = $form_state->getValues();

    $firstName = trim($formField['emp_firstname']);
    $lastName = trim($formField['emp_lastname']);
    $email = trim($formField['emp_email']);
    $zipcode = trim($formField['emp_zipcode']);

    if (!preg_match("/^([a-zA-Z']+)$/", $firstName)) {
      $form_state->setErrorByName('emp_firstname', $this->t('Enter the valid first name'));
    }

    if (!preg_match("/^([a-zA-Z']+)$/", $lastName)) {
      $form_state->setErrorByName('emp_lastname', $this->t('Enter the valid last name'));
    }

    if (!\Drupal::service('email.validator')->isValid($email)) {
      $form_state->setErrorByName('emp_email', $this->t('Enter valid email address'));
    }

    if (!preg_match("/^\d{1,6}$/", $zipcode)) {
      $form_state->setErrorByName('emp_zipcode', $this->t('Enter the valid zip code'));
    }

  } */

  /**
   * {@inheritdoc}
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {//this is required because abstract method
  
  }
}
