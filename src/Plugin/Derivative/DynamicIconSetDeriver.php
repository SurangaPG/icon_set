<?php

namespace Drupal\icon_set\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\Discovery\ContainerDeriverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Retrieves block plugin definitions for all custom blocks.
 */
class DynamicIconSetDeriver extends DeriverBase implements ContainerDeriverInterface {

  /**
   * Icon set repository.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   *   Storage handler for the icon sets.
   */
  protected $iconSetRepository;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, $base_plugin_id) {
    /** @var EntityTypeManagerInterface $entityTypeManager */
    $entityTypeManager = $container->get('entity_type.manager');
    $storage = $entityTypeManager->getStorage('icon_set');
    return new static($storage);
  }

  /**
   * DynamicIconSetDeriver constructor.
   *
   * @param \Drupal\Core\Entity\EntityStorageInterface $iconSetStorage
   *   Icon set repository.
   */
  protected function __construct(EntityStorageInterface $iconSetStorage) {
    $this->iconSetRepository = $iconSetStorage;
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    $components = $this->iconSetRepository->loadMultiple();
    // Reset the discovered definitions.
    $this->derivatives = [];
    foreach ($components as $id => $componentInfo) {
      $this->derivatives[$id] = $base_plugin_definition;
      $this->derivatives[$id]['label'] = $componentInfo->label();
    }
    return parent::getDerivativeDefinitions($base_plugin_definition);
  }
}
