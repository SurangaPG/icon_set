<?php

namespace Drupal\icon_set\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\icon_set\IconSetPluginManagerInterface;

/**
 * Plugin implementation of the 'icon' field type.
 *
 * @FieldType(
 *   id = "icon",
 *   label = @Translation("Icon"),
 *   description = @Translation("This field stores a text that corresponds to a library."),
 *   category = @Translation("Icon"),
 *   default_widget = "icon_select",
 *   default_formatter = "icon_default"
 * )
 */
class IconItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultFieldSettings() {
    return [
      'allowed_icon_sets' => [],
    ] + parent::defaultFieldSettings();
  }

  /**
   * @inheritdoc
   */
  public function fieldSettingsForm(array $form, FormStateInterface $form_state) {
    $form = parent::fieldSettingsForm($form, $form_state);

    // @TODO does this support a create method?
    /** @var IconSetPluginManagerInterface $iconSets */
    $iconSets = \Drupal::service('plugin.manager.icon_set.set');

    $options = [];

    foreach ($iconSets->getDefinitions() as $id => $definition) {
      $options[$id] = $definition['label'];
    }

    $form['allowed_icon_sets'] = [
      '#title' => t('Allowed icon sets'),
      '#description' => t('From which icon sets can the user select icons.'),
      '#type' => 'checkboxes',
      '#options' => $options,
      '#default_value' => $this->getSetting('allowed_icon_sets'),
      '#weight' => 2,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'icon_set' => [
          'type' => 'varchar',
          'length' => 255,
        ],
        'icon_name' => [
          'type' => 'varchar',
          'length' => 255,
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Text'))
      ->setRequired(TRUE);

    $properties['icon_name'] = DataDefinition::create('string')
      ->setLabel(t('Icon name'))
      ->setRequired(TRUE);

    $properties['icon_set'] = DataDefinition::create('string')
      ->setLabel(t('Icon set this item belongs to.'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

}
