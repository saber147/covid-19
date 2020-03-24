<?php
namespace Drupal\covid_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annotation for get method.
 *
 * @RestResource(
 *   id = "region_counter",
 *   label = @Translation("Region counter"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/region-counter",
 *     "https://www.drupal.org/link-relations/create" = "/api/v1/region-counter"
 *   }
 * )
 */
class CounterPerRegion extends ResourceBase {
  /**
   * Get ptz simulator response.
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   Request Object.
   *
   * @return \Drupal\rest\ResourceResponse
   *   Return resource response.
   *
   * @throws \Exception
   */
  public function post(Request $request) {
    $regionCounter = views_get_view_result('region_counter');
    $result = [];
    foreach ($regionCounter as $regionEntity) {
      $result[$regionEntity->_entity->getName()] = [
        'confirmed' => $regionEntity->_entity->get('field_confirmed')->value,
        'recovered' => $regionEntity->_entity->get('field_recovered')->value,
        'death' => $regionEntity->_entity->get('field_death_number')->value,
      ];
    }

    return new ResourceResponse($result);

  }
}