<?php

namespace Drupal\employee;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\user\Entity\User;

/**
 * Interface for sandwitch plugins.
 */
class CostService {

  protected $account;
  protected $entityManager;

  /**
   * {@inheritdoc}
   */
  /*public function __construct(AccountInterface $account, EntityTypeManagerInterface $entity_type_manager){
    $this->account = $account;
    $this->entityManager = $entity_type_manager;
  }
  //Load the service required to construct this class
  public static function create(ContainerInterface $container) {
    return new static(
     $container->get('current_user'),
     $container->get('entity_type.manager'),
    );
  }*/
  /**
   * Function to get userdata.
   */
  public function getUserData(){
   $data = [];
   $serviceData = [];
   $user = \Drupal::service('entity_type.manager')->getStorage('user')->load(\Drupal::service('current_user')->id());
   foreach($user->get('field_service')->getValue() as $val){
    $serviceData[] = $this->getServiceData($val['target_id']); 
   }
   return $serviceData;
  }
  /**
   * Function to get service data.
   */
  public function getServiceData($nid){
    $serviceArr = [];
    $node = \Drupal::service('entity_type.manager')->getStorage('node')->load($nid);
  //dump($node->get('field_cost')->getValue()[0]['value']);exit;
    $serviceArr = [
       'title' => $node->getTitle(), 
       'cost' =>$node->get('field_cost')->getValue()[0]['value'],
    ];
    return $serviceArr;
  }
  /**
   * Function to get service cost.
   */
  public function getServiceCost($price){
    $sum = 0;
    foreach($price as $val){
      $sum = $sum + $val['cost']; 
     }
    return $sum;
  }  
}
