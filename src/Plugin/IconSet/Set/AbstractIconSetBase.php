<?php

namespace Drupal\icon_set\Plugin\IconSet\Set;

use Drupal\Core\Plugin\PluginBase;
use Drupal\icon_set\IconSetInterface;
use Drupal\icon_set\IconSetTypePluginManagerInterface;
use Drupal\icon_set\IconSetTypeInterface;

/**
 * Abstract base class for a single icon set.
 */
abstract class AbstractIconSetBase extends PluginBase implements IconSetInterface {

  /**
   * @return string[]
   *   Array of all the items that can be used in a form.
   */
  public function generateFormOptions() {

    $sourceOptions = $this->getSourceInstance()->generateIconList();

    $prefixedOptions = [];

    foreach ($sourceOptions as $optionKey => $option) {
      $prefixedOptions[$this->getPluginId() . IconSetInterface::SEPARATOR . $optionKey] = $option;
    }

    return $sourceOptions;
  }

  /**
   * @return string[]
   *   Raw options as returned by the source definition.
   */
  public function generateList() {
    return $this->getSourceInstance()->generateIconList();
  }

  /**
   * Get the icon set id.
   *
   * @return string
   *   The id for the plugin that handles the source.
   */
  public function getSource() {
    return str_replace(':', '.', $this->configuration['source']);
  }

  /**
   * Return the source instance.
   *
   * @return IconSetTypeInterface
   *   The source set for this item.
   */
  public function getSourceInstance() {

    // @TODO Inject this?
    /** @var IconSetTypePluginManagerInterface $pluginManager */
    $pluginManager = \Drupal::service('plugin.manager.icon_set.type');

    if ($pluginManager->hasDefinition($this->getSource())) {
      return $pluginManager->getInstance($this->getSource());
    }
  }

}
