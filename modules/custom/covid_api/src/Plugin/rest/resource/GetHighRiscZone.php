<?php

namespace Drupal\covid_api\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annotation for get method.
 *
 * @RestResource(
 *   id = "get_high_risk_zone",
 *   label = @Translation("Création user par data mobile"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/get-high-risk-zone",
 *     "https://www.drupal.org/link-relations/create" = "/api/v1/get-high-risk-zone"
 *   }
 * )
 */
class GetHighRiscZone extends ResourceBase{

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

    $database = \Drupal::database();
    $query = $database->select('paragraph__field_bloc_type', 'fbt')
      ->fields('fbt', ['entity_id']);
    $query->join('node__field_article_content', 'nc', 'fbt.entity_id = nc.field_article_content_target_id');
    $query->condition('fbt.field_bloc_type_value', ['bloc_pro_advice', 'bloc_article_testimony'], 'IN');
    $query->condition('fbt.bundle', 'bloc_testimony');
    $result = $query->execute()->fetchCol();


    $regionCounter = views_get_view_result('person_follow');
    $infectedCasesGeolocation = [];
    foreach ($regionCounter as $regionEntity) {
      $geoloc = $regionEntity->_entity->get('field_location')->getValue()[0];
      array_push($infectedCasesGeolocation, ['lat' => $geoloc['lat'], 'lng' => $geoloc['lng'] ]);
    }

    return new ResourceResponse([$infectedCasesGeolocation]);

  }
}