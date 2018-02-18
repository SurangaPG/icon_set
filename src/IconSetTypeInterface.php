<?php

namespace Drupal\icon_set;

/**
 * Contains an interface for a plugin set.
 */
interface IconSetTypeInterface {

  /**
   * Array of all the icons in this set.
   *
   * @return array
   */
  public function generateIconList();
}
