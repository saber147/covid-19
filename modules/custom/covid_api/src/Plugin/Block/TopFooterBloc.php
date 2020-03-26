<?php


namespace Drupal\covid_api\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "footer_top",
 *   admin_label = @Translation("Footer top"),
 *   category = @Translation("Footer top"),
 * )
 */
class TopFooterBloc extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'footer_top',
      '#items' => []
    ];
  }
}
