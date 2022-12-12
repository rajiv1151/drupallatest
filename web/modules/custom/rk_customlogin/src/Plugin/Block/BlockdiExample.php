<?php

namespace Drupal\rk_customlogin\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a ManagingActivities Register block.
 *
 * @Block(
 *  id = "example_dependency_injection_block",
 *  admin_label = @Translation("example_dependency_injection_block")
 * )
 */
class BlockdiExample extends BlockBase implements ContainerFactoryPluginInterface {

  protected $formBuilder;
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

  /**
   * @inheritDoc
   */
  public function build() {

    $form = $this->formBuilder->getForm('Drupal\rk_customlogin\Form\RKCustomForm');
    return $form;
  }

}