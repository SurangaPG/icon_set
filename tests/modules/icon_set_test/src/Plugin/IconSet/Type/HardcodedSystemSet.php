<?php

namespace Drupal\icon_set_test\Plugin\IconSet\Type;

use Drupal\icon_set\IconSetTypeInterface;
use Drupal\icon_set\Plugin\IconSet\Type\FileSystemSet;

/**
 * Provides a basic type of icon that is loaded from a folder on the filesystem.
 *
 * @IconSetType(
 *  id = "hardcoded_system_set",
 *  admin_label = @Translation("Hardcoded System set"),
 * )
 */
class HardcodedSystemSet extends FileSystemSet implements IconSetTypeInterface {

  /**
   * Get the absolute path to the set.
   *
   * @return string
   *   The absolute path to the icon set.
   */
  public function getSourceDir() {
    return drupal_get_path('module', 'icon_set_test') . '/assets/hardcoded-system-set';
  }

}
