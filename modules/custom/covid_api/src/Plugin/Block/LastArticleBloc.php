<?php


namespace Drupal\covid_api\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "last_articles",
 *   admin_label = @Translation("Actualité"),
 *   category = @Translation("Actualities"),
 * )
 */
class LastArticleBloc extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
      '#theme' => 'corona_news',
      '#items' => []
    ];
  }
}
