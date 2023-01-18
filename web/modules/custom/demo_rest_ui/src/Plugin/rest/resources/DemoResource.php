<?php

namespace Drupal\demo_rest_ui\Plugin\rest\resource;

// web\core\modules\rest\src.
use Drupal\node\Entity\Node;
// web\core\modules\rest\src\Plugin.
use Drupal\rest\Plugin\ResourceBase;

/**
 * Provides a Demo Resource.
 *
 * @RestResource(
 *   id = "demo_resource",
 *   label = @Translation("Demo Resource"),
 *   uri_paths = {
 *     "canonical" = "/demo_rest_api/demo_resource",
 *     "create" = "/add/article"
 *   }
 * )
 */
class DemoResource extends ResourceBase {

  /**
   * Responds to entity GET Requests.
   *
   * @return \Drupal\rest\ResourceResponce
   *  */
  public function get() {
    // $response =['message' => 'Hello, this is a rest service'];
    try {
      $nids = \Drupal::entityQuery('node')
      // Mandatory from >drupal 9.2 onwards.
        ->accessCheck(FALSE)
        ->condition('type', 'article')
        ->execute();
      $nodes = Node::loadMultiple($nids);
      $nodes = $this->processNodes($nodes);
      // dump($nids);exit;
      return new ResourceResponse($response);
    }
    catch (EntityStorageException $e) {
      \Drupal::logger('widget')->error($e->getMessage());
    }
  }

  /**
   * Get Articles .
   */
  private function processNodes($nodes) {
    $output = [];
    foreach ($nodes as $key => $node) {
      $output[$key]['title'] = $node->get('title')->getValue();
      $output[$key]['node_id'] = $node->get('nid')->getValue();
      // $output[$key]['body'] = $node->get('body')->getValue();
    }
    return $output;
  }

  /**
   * POST method to create articles.
   */
  public function post($data) {
    // $response =['message' => 'Hello, this is a rest service'];
    try {
      // Create node object with attached file.
      $node = Node::create([
        'type' => $data['type'],
        'title' => $data['title'],
        'type' => $data['body'],
        'langcode' => 'en',
        'status' => 1,
      ]);
      $node->save();
      return new ResourceResponse(data: 'Node created successfully' . $data['type']);
      /*
      $new_term = Term::create([
      'vid' => $data['type'], //vid (machine_name of taxonomy)
      'name' => $data['title'],
      ]);
      $new_term->enforceIsNew();
      $new_term->save();
      return new ResourceResponse(data: 'Term created successfully' .$data['type']);
       */
    }
    catch (EntityStorageException $e) {
      \Drupal::logger('widget')->error($e->getMessage());
    }
  }  //end of post

  /**
   * Patch (Node updated)
   */
  public function patch($data) {
    // Update.
    try {
      // Create node object with attached file.
      $node = Node::loadMultiple($data['nid']);
      $node->set('title', $data['title']);
      // dump($node);exit;
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
    }
    catch (EntityStorageException $e) {
      \Drupal::logger('widget')->error($e->getMessage());
    }
  } //end of patch

}
