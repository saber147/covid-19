<?php

namespace Drupal\covid_api\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "feature_bloc",
 *   admin_label = @Translation("fonctionnalité bloc"),
 *   category = @Translation("fonctionnalité bloc"),
 * )
 */
class FeatureBloc extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#theme' => 'corona_features_bloc',
      '#items' => []
    ];
  }
}
