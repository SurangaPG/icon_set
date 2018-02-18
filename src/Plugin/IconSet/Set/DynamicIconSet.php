<?php

namespace Drupal\icon_set\Plugin\IconSet\Set;

use Drupal\icon_set\IconSetInterface;

/**
 * Defines a generic custom block type.
 *
 * @IconSet(
 *  id = "dynamic_icon_set",
 *  deriver = "Drupal\icon_set\Plugin\Derivative\DynamicIconSetDeriver"
 * )
 */
class DynamicIconSet extends AbstractIconSetBase implements IconSetInterface {

}
