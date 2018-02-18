<?php

namespace Drupal\icon_set\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'icon_default' formatter.
 *
 * @FieldFormatter(
 *   id = "icon_default",
 *   label = @Translation("Default"),
 *   field_types = {
 *     "icon",
 *   }
 * )
 */
class IconDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    // @TODO Check caching.
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#theme' => 'icon_set_icon',
        '#value' => $item->value,
        '#icon_set' => $item->icon_set,
        '#icon_name' => $item->icon_name,
      ];
    }

    return $elements;
  }

}
