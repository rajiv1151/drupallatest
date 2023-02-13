<?php

namespace Drupal\plugin_type_example\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines sandwitch annotation object.
 *
 * @Annotation
 */
class Sandwitch extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $title;

  /**
   * The description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;
  /**
   * The no of calories serving in this sandwitch type.
   *
   * @var \Drupal\Core\Annotation\Translation
   * 
   * @var int
   */
  public $calories;

}
