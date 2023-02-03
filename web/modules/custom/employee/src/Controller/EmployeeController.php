<?php

namespace Drupal\employee\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;

/**
 * Provides a employee data.
 */
class EmployeeController extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function basicPage() {
    return  [
      '#title' => 'Emplloyee page information',
      '#markup' => $this->t('Employee  details.')
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function information(){
	  $conn = Database::getConnection();
	  $query = \Drupal::database()->select('employee', 'emp');
      $query->fields('emp', ['emp_firstname', 'emp_lastname', 'emp_email', 'emp_zipcode']);
      //$query->condition('nfd.type', 'game');
	  //$query->join('users_field_data', 'ufd', 'ufd.uid = emp.id');
      //$query->range(0, 1);
	  //$query->execute()->fetchAssoc();//for single row with multiple fields
	  //$query->execute()->fetchField();//for single row with single field value
      $emp_datas = $query->execute()->fetchAll();
	  //There's no need to split out your results so heavily in your controller.
	  //Also by doing $emp_datas[0] you are obviously just getting data from the first result.
      //Simply pass the invoices variable into the template and loop through it in twig.
	  //dump($emp_datas[0]);exit;
	  $current_user = \Drupal::currentUser();
      $current_user_roles = $current_user->getRoles();
	  $data = [
	     'name'=>'Rajiv',
		 'email'=>'raj@gmail.com'
	  ];
	//if (in_array('administrator', $current_user_roles)) {
    return [
      '#title' => 'Employee Information Page',
	  '#theme' => 'employee_page',//this is from template folder twig name but with underscore_ not hypen-
      '#data' => $data,
	  '#emp_datas' => $emp_datas,
	  '#user_role' => $current_user_roles,
	  
    ];
	/*}else{
	return [
      '#title' => 'Employee Information Page',
	  '#theme' => 'employee_page',//this is from template folder twig name but with underscore_ not hypen-
      '#data' => 'Not Authorize to access'
    ];
	}*/
  }
}