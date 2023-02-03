<?php
namespace Drupal\drupalup_cron\Plugin\SimpleCron;

use Drupal\simple_cron\Plugin\SimpleCronPluginBase;
use Drupal\node\Entity\Node;


/**
 * Example cron job implementation.
 *
 * @SimpleCron(
 *   id = "my_cron_job",
 *   label = @Translation("My custom cron job", context = "Simple cron")
 * )
 */
class MyCron extends SimpleCronPluginBase {

  /**
   * {@inheritdoc}
   */
  public function process(): void {
        //unpublished nodes, publish them each time when the cron runs.
        $query = \Drupal::entityQuery('node');
        $query->condition('status', 0);
        $query->condition('type', 'article');
        $entity_ids = $query->execute();
        foreach ($entity_ids as $id => $val) {
         $node = Node::load($val); 
         $node->setPublished();
         $node->save();
        } 
  }

}

