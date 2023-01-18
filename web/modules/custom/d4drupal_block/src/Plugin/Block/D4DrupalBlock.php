<?php

namespace Drupal\d4drupal_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

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
    return [
      "#markup" => "Welcome to d4drupal",
    ];

    /*$form = $this->formBuilder->getForm('Drupal\rk_customlogin\Form\RKCustomForm');
    return $form;
     */
  }

}
