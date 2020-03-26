<?php


namespace Drupal\covid_api\Plugin\Block;


use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "featurs_top",
 *   admin_label = @Translation("fonctinnalité top bloc"),
 *   category = @Translation("fonctinnalité top bloc"),
 * )
 */
class FeaturesTopBloc extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#theme' => 'corona_features_top_bloc',
      '#items' => []
    ];
  }
}
