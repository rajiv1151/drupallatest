<?php

namespace Drupal\employee\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Database\Database;
use Egulias\EmailValidator\EmailValidator;


/**
 * Provides a employee form.
 */
class EmployeeDiForm extends FormBase {

  protected $emailValidator;
  protected $account;
  protected $messenger;

  //Initialize the object
  public function __construct(EmailValidator $email_validator, AccountInterface $account, MessengerInterface $messenger){
    $this->emailValidator = $email_validator;
    $this->account = $account;
    $this->messenger = $messenger;
  }
  //Load the service required to construct this class
  public static function create(ContainerInterface $container) {
    return new static(
    $container->get('email.validator'),
    $container->get('current_user'),
    $container->get('messenger')// form_builder service will inject inside class and we will get that service in object $formBuilder
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'employee_employee';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('Employee Form, Please submit details.'),
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

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    //$form['#attached']['library'][] = 'employee/employee-library';
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $formField = $form_state->getValues();

    $firstName = trim($formField['emp_firstname']);
    $lastName = trim($formField['emp_lastname']);
    $email = trim($formField['emp_email']);
    $zipcode = trim($formField['emp_zipcode']);
	  $accept = $formField['accept'];//0/1

    if (!preg_match("/^([a-zA-Z']+)$/", $firstName)) {
      $form_state->setErrorByName('emp_firstname', $this->t('Enter the valid first name'));
    }

    if (!preg_match("/^([a-zA-Z']+)$/", $lastName)) {
      $form_state->setErrorByName('emp_lastname', $this->t('Enter the valid last name'));
    }

    if (!empty($email)) {
      if(!$this->validateEmail($form, $form_state,$email)){
       $form_state->setErrorByName('emp_email', $this->t('Enter valid email address'));
      }
    }

    if (!preg_match("/^\d{1,6}$/", $zipcode)) {
      $form_state->setErrorByName('emp_zipcode', $this->t('Enter the valid zip code'));
    }
	if (empty($accept)){
      // Set an error for the form element with a key of "accept".
      $form_state->setErrorByName('accept', $this->t('You must accept the terms of use to continue'));
    }

  }
  protected function validateEmail(array &$form, FormStateInterface $form_state, $email){
    if(!$this->emailValidator->isValid($email)){
      return FALSE;
     }
     return TRUE;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    //get current_user data via DI
    $uid = $this->account->id();//account is a object of service
    if(!empty($uid)){
     $this->messenger->addMessage(t('Form Submitted by login user'));//messenger is object of messenger service
    }else{
      $this->messenger->addMessage(t('Form Submitted by end user'));
    }
    $conn = Database::getConnection();
    $formField = $form_state->getValues();

    $formData['emp_firstname'] = $formField['emp_firstname'];
    $formData['emp_lastname'] = $formField['emp_lastname'];
    $formData['emp_email'] = $formField['emp_email'];
    $formData['emp_zipcode'] = $formField['emp_zipcode'];
	  $formData['accept'] = $formField['accept'];

    $conn->insert('employee')
      ->fields($formData)->execute();

    $this->messenger()->addStatus($this->t('Employee data has been saved successsfully.'));
    $form_state->setRedirect('employee.employee');//routing path on which it redirects
	//$form_state->setRedirect('<front>');
  }

}
