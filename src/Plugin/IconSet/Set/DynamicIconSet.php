<?php

namespace Drupal\icon_set\Plugin\IconSet\Set;

use Drupal\Core\Plugin\PluginBase;
use Drupal\icon_set\IconSetInterface;

/**
 * Defines a generic custom block type.
 *
 * @IconSet(
 *  id = "dynamic_icon_set",
 *  deriver = "Drupal\icon_set\Plugin\Derivative\DynamicIconSetDeriver"
 * )
 */
class DynamicIconSet extends PluginBase implements IconSetInterface {

  public function generateList() {
    return [];
  }

  public function generateFormOptions() {
    return [
      'test-1' => 'haha',
      'test-2' => 'hihi',
    ];
  }

}
