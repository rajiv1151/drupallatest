<?php

namespace Drupal\rk_customlogin\Plugin\rest\resource;

use Drupal\rest\ResourceBase;
use Drupal\rest\ResourceResponce;
use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

/**
 * Provides a ManagingActivities Register block.
 *
 * @RestResource(
 *  id = "Articles",
 *  label = @Translation("Article list"),
 *  uri_paths = {
 *  "canonical" = "/get/article",
 *  "create" = "/add/article"
 *  }
 * )
 */
class DemoResource extends ResourceBase {
  /**
   * responds to entity GET Requests
   * @return \Drupal\rest\ResourceResponce
   *  */  
  public function get(){
    //$response =['message' => 'Hello, this is a rest service'];
    try{
      $nids = \Drupal::entityQuery('node')
      ->accessCheck(FALSE) //mandatory from >drupal 9.2 onwards
      ->condition('type','article')
      ->execute();
      $nodes = Node::loadMultiple($nids);
      $nodes = $this->processNodes($nodes);
      //dump($nids);exit;
      return new ResourceResponse($response);
    }catch(EntityStorageException $e){
      \Drupal::logger('widget')->error($e->getMessage());
    }
  }

 /**
  * get Articles 
  */
  private function processNodes($nodes){
    $output = [];
    foreach($nodes as $key=> $node){
      $output[$key]['title'] = $node->get('title')->getValue();
      $output[$key]['node_id'] = $node->get('nid')->getValue();
      //$output[$key]['body'] = $node->get('body')->getValue();
    }
    return $output;
  } 

/**
   * POST method to create articles
   *  
   */  
  public function post($data){
    //$response =['message' => 'Hello, this is a rest service'];
    try{
      //create node object with attached file
      $node = Node::create([
       'type' => $data['type'],
       'title' => $data['title'],
       'type' => $data['body'],
       'langcode' => 'en',
       'status' => 1,
      ]);
      $node->save();
      return new ResourceResponse(data: 'Node created successfully' .$data['type']);
      /*
       $new_term = Term::create([
       'vid' => $data['type'], //vid (machine_name of taxonomy)
       'name' => $data['title'],
      ]);
      $new_term->enforceIsNew();
      $new_term->save();
      return new ResourceResponse(data: 'Term created successfully' .$data['type']);
      */
    }catch(EntityStorageException $e){
      \Drupal::logger('widget')->error($e->getMessage());
    }
  }  //end of post

/**
   * Patch (Node updated)
   */  
  public function patch($data){
    try{
        //create node object with attached file
      $node = Node::loadMultiple($data['nid']);
      $node->set('title', $data['title']);
      //dump($node);exit;
      $node->save();
      /*
      $node = \Drupal::entityQuery('node')
      ->condition('nid','$data['nid']')
      ->condition('status', 1);
      ->excecute();
      $node->set('title', $data['title']);
      $node->save();
      */
      return new ResourceResponse(data: 'Node Updated successfully');
    }catch(EntityStorageException $e){
      \Drupal::logger('widget')->error($e->getMessage());
    }
  } //end of patch

}
