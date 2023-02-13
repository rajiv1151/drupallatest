<?php
namespace Drupal\employee\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
 

/**
 * Provides block for rendering userservice through DI.
 *
 * @Block(
 *  id = "user_service_details",
 *  admin_label = @Translation("user service details")
 * )
 */
class CostServiceBlock extends BlockBase implements ContainerFactoryPluginInterface{

  protected $costUserServices;//creating object with variable

  /*public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder) {
  $this->costUserServices = $formBuilder;//initialize the $formBuilder object
  }*/

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  $instance = new static($configuration, $plugin_id, $plugin_definition);
  $instance->costUserServices = $container->get('cost.user.services');
  return $instance;
  }


  /**
   * {#inheritdoc}
   */
  public function build() {
    $build =[];
    $build['#theme'] = 'user_service_details';
    $build['user_service_details']['#markup']= 'Implement userService Details.';
    $build['#content'] = $this->costUserServices->getUserData();
    $build['#total'] = $this->costUserServices->getServiceCost($this->costUserServices->getUserData());
    return $build;
     
  }
  
}
