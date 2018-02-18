<?php

namespace Drupal\icon_set\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Icon set entity.
 *
 * @ConfigEntityType(
 *   id = "icon_set",
 *   label = @Translation("Icon set"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\icon_set\IconSetListBuilder",
 *     "form" = {
 *       "add" = "Drupal\icon_set\Form\IconSetForm",
 *       "edit" = "Drupal\icon_set\Form\IconSetForm",
 *       "delete" = "Drupal\icon_set\Form\IconSetDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\icon_set\IconSetHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "icon_set",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/icon_set/{icon_set}",
 *     "add-form" = "/admin/structure/icon_set/add",
 *     "edit-form" = "/admin/structure/icon_set/{icon_set}/edit",
 *     "delete-form" = "/admin/structure/icon_set/{icon_set}/delete",
 *     "collection" = "/admin/structure/icon_set"
 *   }
 * )
 */
class IconSet extends ConfigEntityBase implements IconSetInterface {

  /**
   * The Icon set ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Icon set label.
   *
   * @var string
   */
  protected $label;

  /**
   * The id for the plugin source.
   *
   * @var string
   */
  protected $source;

  /**
   * @inheritdoc
   */
  public function getSource() {
    return $this->source;
  }

  /**
   * @inheritdoc
   */
  public function setSource($source) {
    $this->source = $source;
  }
}
