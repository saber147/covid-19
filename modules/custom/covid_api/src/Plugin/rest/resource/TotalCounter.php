<?php

namespace Drupal\covid_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annotation for get method.
 *
 * @RestResource(
 *   id = "total_counter",
 *   label = @Translation("Total counter"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/total-counter",
 *     "https://www.drupal.org/link-relations/create" = "/api/v1/total-counter"
 *   }
 * )
 */
class TotalCounter extends ResourceBase {
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
    $confirmed = $recovered = $death = 0;
    foreach ($regionCounter as $regionEntity) {
      $confirmed += $regionEntity->_entity->get('field_confirmed')->value;
      $recovered += $regionEntity->_entity->get('field_recovered')->value;
      $death += $regionEntity->_entity->get('field_death_number')->value;
    }

    $result = [
      'total_confirmed' => $confirmed,
      'total_recovered' => $recovered,
      'total_death' => $death,
    ];

    return new ResourceResponse($result);

  }

}