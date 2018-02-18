<?php

namespace Drupal\icon_set;

/**
 * Contains an interface for a plugin set.
 */
interface IconSetInterface {

  const SEPARATOR = '---';

  /**
   * Generate all the options for a form.
   *
   * @return string[]
   *   Array of machine names => label.
   */
  public function generateFormOptions();

  /**
   * Generate a list of all the items.
   *
   * @return string[]
   *   Array of machine names => label.
   */
  public function generateList();

  public function getSource();
}
