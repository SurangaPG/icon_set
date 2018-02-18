<?php

namespace Drupal\icon_set\Plugin\IconSet\Set;

use Drupal\Core\Plugin\PluginBase;
use Drupal\icon_set\Plugin\IconSet\IconSetInterface;

/**
 * Abstract base class for a single icon set.
 */
abstract class AbstractIconSetBase extends PluginBase implements IconSetInterface {

  /**
   * {@inheritdoc}
   */
  abstract public function generateList();

  /**
   * {@inheritdoc}
   */
  public function generateFormOptions() {
    $options = $this->generateList();

    $formOptions = [];

    foreach ($options as $key => $value) {
      $formOptions[$this->getPluginId() . IconSetInterface::SEPARATOR . $key] = $value;
    }

    return $formOptions;
  }

}
