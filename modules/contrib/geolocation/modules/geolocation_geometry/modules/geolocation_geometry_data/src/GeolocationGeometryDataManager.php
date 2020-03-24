<?php

namespace Drupal\geolocation_geometry_data;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Search plugin manager.
 */
class GeolocationGeometryDataManager extends DefaultPluginManager {

  /**
   * Constructs an MapFeatureManager object.
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
    parent::__construct('Plugin/geolocation/GeolocationGeometryData', $namespaces, $module_handler, NULL, 'Drupal\geolocation_geometry_data\Annotation\GeolocationGeometryData');
    $this->alterInfo('geolocation_geometry_data_info');
    $this->setCacheBackend($cache_backend, 'geolocation_geometry_data');
  }

  /**
   * Return GeolocationGeometryData by ID.
   *
   * @param string $id
   *   GeolocationGeometryData ID.
   *
   * @return mixed
   *   GeolocationGeometryData or FALSE.
   */
  public function getGemeotryDataBatch($id) {
    $definitions = $this->getDefinitions();
    if (empty($definitions[$id])) {
      return FALSE;
    }
    try {
      $instance = $this->createInstance($id);
      if ($instance) {
        return $instance->getBatch();
      }
    }
    catch (\Exception $e) {
      return FALSE;
    }
    return FALSE;
  }

}
