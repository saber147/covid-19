<?php

namespace Drupal\covid_api\Plugin\rest\resource;

use Drupal\Component\Serialization\Json;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Drupal\taxonomy\Entity\Term;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annotation for get method.
 *
 * @RestResource(
 *   id = "create_user_location_history",
 *   label = @Translation("Création user par data mobile"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/create-user-location-history",
 *     "https://www.drupal.org/link-relations/create" = "/api/v1/create-user-location-history"
 *   }
 * )
 */
class CreatUserLocationHistory extends ResourceBase {

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

    $userData = JSON::decode($request->getContent());
    //$helper = \Drupal::service('covid_api.helper');

    $newTerm = Term::create([
      'vid' => 'geoloc_mobile_users',
      'name' => $userData['user_phone_mac_adress'],
      'field_phone_identifier' => $userData['user_phone_mac_adress'],
      'field_user_geolocation' => $userData['field_user_geolocation'],
    ]);

    $newTerm->save();

    return new ResourceResponse([]);

  }

}