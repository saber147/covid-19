<?php

namespace Drupal\covid_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annotation for get method.
 *
 * @RestResource(
 *   id = "geoloc_infected_cases",
 *   label = @Translation("Geolocation of infected cases"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/geoloc-infected-cases",
 *     "https://www.drupal.org/link-relations/create" = "/api/v1/geoloc-infected-cases"
 *   }
 * )
 */
class GeolocationInfectedCases extends ResourceBase {

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

    $regionCounter = views_get_view_result('person_follow');
    $infectedCasesGeolocation = [];
    foreach ($regionCounter as $regionEntity) {
      $geoloc = $regionEntity->_entity->get('field_location')->getValue()[0];
      array_push($infectedCasesGeolocation, ['lat' => $geoloc['lat'], 'lng' => $geoloc['lng'] ]);
    }

    return new ResourceResponse([$infectedCasesGeolocation]);

  }
}