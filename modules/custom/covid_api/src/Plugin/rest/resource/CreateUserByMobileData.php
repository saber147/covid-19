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
 *   id = "create_user_by_mobile_data",
 *   label = @Translation("Création user par data mobile"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/create-user-by-mobile-data",
 *     "https://www.drupal.org/link-relations/create" = "/api/v1/create-user-by-mobile-data"
 *   }
 * )
 */
class CreateUserByMobileData extends ResourceBase {

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

    $newTerm = Term::create([
      'vid' => 'mobile_app_users',
      'name' => $userData['name'],
      'field_user_prename' => $userData['prename'],
      'field_cin' => $userData['user_cin'],
      'field_phone_identifier' => $userData['user_phone_mac_adress'],
      'field_user_phone_number' => $userData['user_phone_number'],
      'field_loca_history_reference' => $this->createHistoryReference($userData['user_phone_mac_adress']),
    ]);
    $newTerm->save();

    return new ResourceResponse([]);

  }


  /**
   * @param $macAdress
   * @return array
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function createHistoryReference($macAdress) {
    //$helper = \Drupal::service('covid_api.helper');
    $newHistoryIdentifier = Term::create([
      'vid' => 'geoloc_mobile_users',
      'name' => $macAdress,
      'field_phone_identifier' => $macAdress,
      'field_user_geolocation' => ['lng' => '' ,  'lat' => ''],
    ]);

    $newHistoryIdentifier->save();

    return ['target_id' => $newHistoryIdentifier->id()];

  }

}