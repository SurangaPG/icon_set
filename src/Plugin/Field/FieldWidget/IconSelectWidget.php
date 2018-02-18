<?php

namespace Drupal\icon_set\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\icon_set\IconSetInterface;

/**
 * Plugin implementation of the 'icon_select' widget.
 *
 * @FieldWidget(
 *   id = "icon_select",
 *   label = @Translation("Icon select"),
 *   field_types = {
 *     "icon"
 *   },
 * )
 */
class IconSelectWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    /** @var \Drupal\icon_set\IconSetPluginManagerInterface $iconSetManager */
    $iconSetManager = \Drupal::service('plugin.manager.icon_set.set');
    $options = [];

    // Currently we'll just add all the items to the options.
    // In time we might want to add support for the selection of certain
    // plugins based on a field setting.
    foreach ($items->getSetting('allowed_icon_sets') as $pluginId) {
      /** @var \Drupal\icon_set\IconSetInterface $iconSetInstance */
      $iconSetInstance = $iconSetManager->createInstance($pluginId);
      $options += $iconSetInstance->generateFormOptions();
    }

    $element['value'] = $element + [
        '#type' => 'select',
        '#options' => $options,
        '#key_column' => 'value',
        '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
        '#empty_option' => t('- None -'),
        '#element_validate' => [
          [get_class($this), 'validateElement'],
        ],
        '#empty_value' => '_none'
      ];
    return $element;
  }

  /**
   * Form validation handler for widget elements.
   *
   * @param array $element
   *   The form element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function validateElement(array $element, FormStateInterface $form_state) {
    // Filter out _none option.
    // @TODO Odd that the select doesn't pick up on this automagically?.
    if ($element['#value'] == '_none') {
      $form_state->setValueForElement($element, NULL);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    $values = parent::massageFormValues($values, $form, $form_state);

    foreach ($values as &$value) {
      // The value is in 'icon_set---machine_name' so we split this here.
      if (isset($value['value'])) {
        $splitValues = explode(IconSetInterface::SEPARATOR, $value['value']);
        $value['icon_set'] = $splitValues[0];
        $value['icon_name'] = $splitValues[1];
      }
    }

    return $values;
  }

}
