<?php
namespace Drupal\employee\Plugin\Block;

use Drupal\Core\Block\BlockBase;
//use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
 

/**
 * Provides block for rendering form through DI.
 *
 * @Block(
 *  id = "form_dependency_injection_block",
 *  admin_label = @Translation("form_dependency_injection_block")
 * )
 */
class FormDiBlock extends BlockBase implements ContainerFactoryPluginInterface{

  protected $formBuilder;//creating object with variable
  public function __construct(array $configuration, $plugin_id, $plugin_definition, FormBuilderInterface $formBuilder) {//used to initialize the object $formBuilder
  $this->formBuilder = $formBuilder;//initialize the $formBuilder object
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
  return new static(
  $configuration,
  $plugin_id,
  $plugin_definition,
  $container->get('formBuilder')// form_builder service will inject inside class and we will get that service in object $formBuilder
  );
  }


  /**
   * {#inheritdoc}
   */
  public function build() {
    //by using drupal global service rendering form in block but its not recommended.
    //best way to render form through DI
    /*$form = \Drupal::formBuilder()->getForm('Drupal\employee\Form\EmployeeForm');
    return $form;
    */
    $form = $this->formBuilder->getForm('Drupal\employee\Form\EmployeeForm');
    return $form;
     
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
