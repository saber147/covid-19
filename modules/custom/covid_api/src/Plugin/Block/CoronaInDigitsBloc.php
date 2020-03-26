<?php

namespace Drupal\covid_api\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Cache\CacheableDependencyInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "corona_digits",
 *   admin_label = @Translation("Corona in digits"),
 *   category = @Translation("Corona in digits"),
 * )
 */
class CoronaInDigitsBloc extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $statisticsNode = \Drupal::entityTypeManager()->getStorage('node')->load(3);
    $statistics = [
      "total" => 0,
      "confirmed" => 0,
      "recovered" => 0,
      "deaths" => 0,
    ];

    if ($statisticsNode) {
      $statistics["confirmed"] = $statisticsNode->get('field_total_confirmed')->value;
      $statistics["recovered"] = $statisticsNode->get('field_total_recovered')->value;
      $statistics["deaths"] = $statisticsNode->get('field_total_deaths')->value;
      $statistics["total"] = $statistics["confirmed"];
    }

    return [
      '#theme' => 'corona_in_digits',
      '#items' => $statistics
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), array('node:3'));
  }

}
