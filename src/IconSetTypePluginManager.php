<?php

namespace Drupal\icon_set;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Manages discovery and instantiation of resource plugins.
 *
 * @see plugin_api
 */
class IconSetTypePluginManager extends DefaultPluginManager implements IconSetTypePluginManagerInterface {

  /**
   * Constructs a new \Drupal\rest\Plugin\Type\ResourcePluginManager object.
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
    parent::__construct('Plugin/IconSet/Type', $namespaces, $module_handler, 'Drupal\icon_set\IconSetTypeInterface', 'Drupal\icon_set\Annotation\IconSetType');

    $this->setCacheBackend($cache_backend, 'icon_set_set_plugins');
    $this->alterInfo('icon_set_set_plugins');
  }

}
