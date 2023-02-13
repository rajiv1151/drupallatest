<?php

namespace Drupal\plugin_type_example;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for sandwitch plugins.
 */
abstract class SandwitchPluginBase extends PluginBase implements SandwitchInterface {

  /**
   * {@inheritdoc}
   */
  public function label() {
    // Cast the label to a string since it is a TranslatableMarkup object.
    return (string) $this->pluginDefinition['label'];
  }
  /**
   * Provide description of the sandwidtch.
   *
   * @return string
   */
  public function description(){
    return $this->pluginDefinition['description'];
  }
  /**
   * Returns the no of calories per serving of sanwidtch.
   *
   * @return float
   */
  public function calories(){
    return (float) $this->pluginDefinition['calories'];
  }
  /**
   * Returns the extra ingredients to include in sandwitch.
   *
   * @return mixed
   */
  abstract public function order(array $extras);

}
