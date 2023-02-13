<?php

namespace Drupal\plugin_type_example;

/**
 * Interface for sandwitch plugins.
 */
interface SandwitchInterface {

  /**
   * Returns the translated plugin label.
   *
   * @return string
   *   The translated title.
   */
  public function label();
  /**
   * Provide description of the sandwidtch.
   *
   * @return string
   */
  public function description();
  /**
   * Returns the no of calories per serving of sanwidtch.
   *
   * @return float
   */
  public function calories();
  /**
   * Returns the extra ingredients to include in sandwitch.
   *
   * @return mixed
   */
  public function order(array $extras);

}
