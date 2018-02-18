<?php

namespace Drupal\icon_set\Plugin\IconSet\Type;

use Drupal\Core\Plugin\PluginBase;
use Drupal\icon_set\Plugin\IconSet\IconSetTypeInterface;

/**
 * Provides a basic type of icon that is loaded from a folder on the filesystem.
 *
 * @IconSetType(
 *  id = "file_system_set",
 *  admin_label = @Translation("File System set"),
 * )
 */
class FileSystemSet extends PluginBase implements IconSetTypeInterface {

}
