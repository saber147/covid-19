<?php

namespace Drupal\covid_api\service;

class Helper {
  /**
   * Get the right format for the geolocation fields.
   *
   * @param object $geoLocationField
   *   The geolocation field object.
   *
   * @return string
   *   Return the value of geoField field.s
   */
  public function getGeoFieldValue($geoLocationField) {
    $geoFieldGenerator = \Drupal::service('geofield.wkt_generator');
    $value = NULL;
    $point = [
      'lon' => $geoLocationField['lng'],
      'lat' => $geoLocationField['lat'],
    ];
    $value = $geoFieldGenerator->WktBuildPoint($point);


    return $value;
  }

}