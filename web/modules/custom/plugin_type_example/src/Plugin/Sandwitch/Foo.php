<?php

namespace Drupal\plugin_type_example\Plugin\Sandwitch;

use Drupal\plugin_type_example\SandwitchPluginBase;

/**
 * Plugin implementation of the sandwitch.
 *
 * @Sandwitch(
 *   id = "foo",
 *   label = @Translation("Foo"),
 *   description = @Translation("Foo description."),
 *   calories = "120"
 * )
 */
class Foo extends SandwitchPluginBase {
  /**
   * Place an order for a sanwidtch
   */
  public function order(array $extras){
    $ingredeints =['mustard', 'rocket', 'sun-dried tomatos'];
    $sandwidtch = array_merge($ingredeints, $extras);
    return 'you orderd an '.implode(',', $sandwidtch).' sandwidtch. enjoy';
  }
}
