<?php

namespace Drupal\plugin_type_example\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\plugin_type_example\SandwitchPluginManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for our example pages.
 */
class PluginTypeExampleController extends ControllerBase {

  /**
   * The sandwitch plugin manager.
   *
   * We use this to get all of the sandwitch plugins.
   *
   * @var \Drupal\plugin_type_example\SandwitchPluginManager
   */
  protected $sandwitchManager;

  /**
   * Constructor.
   *
   * @param \Drupal\plugin_type_example\SandwitchPluginManager $sandwtich_manager
   *   The sandwitch plugin manager service. We're injecting this service so that
   *   we can use it to access the sandwitch plugins.
   */
  public function __construct(SandwitchPluginManager $sandwitch_manager) {
    $this->sandwitchManager = $sandwitch_manager;
  }

  /**
   * Displays a page with an overview of our plugin type and plugins.
   *
   * Lists all the Sandwitch plugin definitions by using methods on the
   * \Drupal\plugin_type_example\SandwitchPluginManager class. Lists out the
   * description for each plugin found by invoking methods defined on the
   * plugins themselves. You can find the plugins we have defined in the
   * \Drupal\plugin_type_example\Plugin\Sandwitch namespace.
   *
   * @return array
   *   Render API array with content for the page at
   *   /examples/plugin_type_example.
   */
  public function description() {
    $build = [];

    $build['intro'] = [
      '#markup' => $this->t("This page lists the sandwitch plugins we've created. The sandwitch plugin type is defined in Drupal\\plugin_type_example\\SandwitchPluginManager. The various plugins are defined in the Drupal\\plugin_type_example\\Plugin\\Sandwitch namespace."),
    ];

    // Get the list of all the sandwitch plugins defined on the system from the
    // plugin manager. Note that at this point, what we have is *definitions* of
    // plugins, not the plugins themselves.
    $sandwitch_plugin_definitions = $this->sandwitchManager->getDefinitions();
    //dump($sandwitch_plugin_definitions);exit;

    // Let's output a list of the plugin definitions we now have.
    $items = [];
    foreach ($sandwitch_plugin_definitions as $sandwitch_plugin_definition) {
      // Here we use various properties from the plugin definition. These values
      // are defined in the annotation at the top of the plugin class: see
      // \Drupal\plugin_type_example\Plugin\Sandwitch\ExampleHamSandwitch.
      $items[] = $this->t("@id (calories: @calories, description: @description )", [
        '@id' => $sandwitch_plugin_definition['id'],
        '@calories' => $sandwitch_plugin_definition['calories'],
        '@description' => $sandwitch_plugin_definition['description'],
      ]);
    }

    // Add our list to the render array.
    $build['plugin_definitions'] = [
      '#theme' => 'item_list',
      '#title' => 'Sandwitch plugin definitions',
      '#items' => $items,
    ];

    // If we want just a single plugin definition, we can use getDefinition().
    // This requires us to know the ID of the plugin we want. This is set in the
    // annotation on the plugin class: see
    // \Drupal\plugin_type_example\Plugin\Sandwitch\ExampleHamSandwitch.
    $ham_sandwitch_plugin_definition = $this->sandwitchManager->getDefinition('meatball_sandwitch');

    // To get an instance of a plugin, we call createInstance() on the plugin
    // manager, passing the ID of the plugin we want to load. Let's output a
    // list of the plugins by loading an instance of each plugin definition and
    // collecting the description from each.
    $items = [];
    // The array of plugin definitions is keyed by plugin id, so we can just use
    // that to load our plugin instances.
    foreach ($sandwitch_plugin_definitions as $plugin_id => $sandwitch_plugin_definition) {
      // We now have a plugin instance. From here on it can be treated just as
      // any other object; have its properties examined, methods called, etc.
      $plugin = $this->sandwitchManager->createInstance($plugin_id, ['of' => 'configuration values']);
      $items[] = $plugin->description();
    }

    $build['plugins'] = [
      '#theme' => 'item_list',
      '#title' => 'Sandwitch plugins',
      '#items' => $items,
    ];

    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Override the parent method so that we can inject our sandwitch plugin
   * manager service into the controller.
   *
   * For more about how dependency injection works read
   * https://www.drupal.org/node/2133171
   *
   * @see container
   */
  public static function create(ContainerInterface $container) {
    // Inject the plugin.manager.sandwitch service that represents our plugin
    // manager as defined in the plugin_type_example.services.yml file.
    return new static($container->get('plugin.manager.sandwitch'));
  }

}
