<?php

namespace Drupal\plugin_type_example;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Sandwitch plugin manager.
 */
class SandwitchPluginManager extends DefaultPluginManager {

  /**
   * Constructs SandwitchPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/Sandwitch',
      $namespaces,
      $module_handler,
      'Drupal\plugin_type_example\SandwitchInterface',
      'Drupal\plugin_type_example\Annotation\Sandwitch'
    );
    $this->alterInfo('sandwitch_info');
    $this->setCacheBackend($cache_backend, 'sandwitch_plugins');
  }

}
