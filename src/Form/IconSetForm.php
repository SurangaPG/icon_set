<?php

namespace Drupal\icon_set\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\icon_set\Entity\IconSetInterface;
use Drupal\icon_set\IconSetTypePluginManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class IconSetForm.
 */
class IconSetForm extends EntityForm {

  /**
   * Icon set type plugin manager.
   *
   * @var IconSetTypePluginManagerInterface
   *   The icon set type plugin manager interface.
   */
  protected $iconSetTypeManager;

  public static function create(ContainerInterface $container) {
    return new static($container->get('plugin.manager.icon_set.type'));
  }

  /**
   * IconSetForm constructor.
   *
   * @param \Drupal\icon_set\IconSetTypePluginManagerInterface $iconSetTypeManager
   *   The icon set type plugin manager interface.
   */
  public function __construct(IconSetTypePluginManagerInterface $iconSetTypeManager) {
    $this->iconSetTypeManager = $iconSetTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $iconSet = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $iconSet->label(),
      '#description' => $this->t("Label for the Icon set."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $iconSet->id(),
      '#machine_name' => [
        'exists' => '\Drupal\icon_set\Entity\IconSet::load',
      ],
      '#disabled' => !$iconSet->isNew(),
    ];

    $options = [];
    foreach ($this->iconSetTypeManager->getDefinitions() as $id => $definition) {
      $options[$id] = $definition['admin_label'];
    }

    $form['source'] = [
      '#type' => 'select',
      '#title' => t('Icon set source'),
      '#default_value' => $iconSet->getSource(),
      '#options' => $options,
      '#required' => TRUE,
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    // @var IconSetInterface $iconSet
    $iconSet = $this->entity;

    $iconSet->setSource($form_state->getValue('source'));

    $status = $iconSet->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Icon set.', [
          '%label' => $iconSet->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Icon set.', [
          '%label' => $iconSet->label(),
        ]));
    }
    $form_state->setRedirectUrl($iconSet->toUrl('collection'));
  }

}
