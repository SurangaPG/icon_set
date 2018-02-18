<?php

namespace Drupal\icon_set\Plugin\IconSet\Type;

use Drupal\Core\Plugin\PluginBase;
use Drupal\icon_set\IconSetTypeInterface;

/**
 * Provides a basic type of icon that is loaded from a folder on the filesystem.
 * )
 */
abstract class FileSystemSet extends PluginBase implements IconSetTypeInterface {

  /**
   * Get the absolute path for the source items.
   *
   * @return string
   *   Absolute path to the source dir with the icons.
   */
  abstract function getSourceDir();

  /**
   * Get a full list of all the items in this list.
   *
   * @return string[]
   *   Array of all the file names.
   *
   */
  public function generateIconList() {

    $list = [];

    $iconFiles = glob($this->getSourceDir() . '/%.svg');

    foreach ($iconFiles as $iconFile) {
      $id = $this->cleanFileName($iconFile);
      $list[$id] = $id;
    }

    return $list;
  }

  /**
   * Clean up a full file path to a clean id.
   *
   * @param $filePath
   *   Full path name for the svg item.
   *
   * @return string
   *   Cleaned up name for the item.
   */
  public function cleanFileName($filePath) {
    $fileName = basename($filePath);
    $fileName = str_replace('.svg', '', $fileName);

    return $fileName;
  }

}
