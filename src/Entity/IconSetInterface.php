<?php

namespace Drupal\icon_set\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Icon set entities.
 */
interface IconSetInterface extends ConfigEntityInterface {

  /**
   * Get the string identifier for the source plugin.
   *
   * @return string
   *   The data for the source plugin.
   */
  public function getSource();

  /**
   * Set the string id for the plugin.
   *
   * @param string $source
   *   Id for the source plugin.
   */
  public function setSource($source);

}
