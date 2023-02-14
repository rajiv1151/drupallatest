<?php

namespace Drupal\d4drupal_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/*use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
 */

/**
 * Provides Simple block for D4drupal.
 *
 * @Block(
 *  id = "d4drupal_block",
 *  admin_label = @Translation("D4drupal block")
 * )
 */
class D4DrupalBlock extends BlockBase {

  /*protected $formBuilder;
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $form_builder) {
  $this->formBuilder = $form_builder;
  }
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static(
  $configuration,
  $plugin_id,
  $plugin_definition,
  $container->get('form_builder')// form_builder service will inject inside class
  );
  }
   */

  /**
   * {#inheritdoc}
   */
  public function build() {
    $output="Welcome to d4drupal".rand(100,1000);
    return [
      "#markup" => $output,
      "#cache" =>[
        'tags' =>[ //for specific nodes
           'node:1',  //for node 1 any changes cache will validated and updated.
           'node_list'//for any nodes updated then cache will be updated
        ],
        '#contexts'=>[ //for urls
            'url',
        ],
        'max-age' =>10//after 10seconds cache will rebuilt
      ]
    ];

      //by using drupal global service rendering form in block but its not recommended.
      //best way to render form through DI
    /*$form = \Drupal::formBuilder()->getForm('Drupal\employee\Form\EmployeeForm');
    return $form;
    */

  }
  /**
   * {@inheritdoc}
   */
  /*public function getCacheTags() {
    //With this when your node change your block will rebuild
    if ($node = \Drupal::routeMatch()->getParameter('node')) {
      //if there is node add its cachetag
      return Cache::mergeTags(parent::getCacheTags(), array('node:' . $node->id()));
    } else {
      //Return default tags instead.
      return parent::getCacheTags();
    }
  }

  public function getCacheContexts() {
    //if you depends on \Drupal::routeMatch()
    //you must set context of this block with 'route' context tag.
    //Every new route this block will rebuild
    return Cache::mergeContexts(parent::getCacheContexts(), array('route'));
  }

  // To make the block uncacheable at all (even if I would avoid it).
  // It could be useful in other cases, maybe.
  public function getCacheMaxAge() {
    return 0;
  }
*/
}
