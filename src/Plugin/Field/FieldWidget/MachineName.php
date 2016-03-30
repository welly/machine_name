<?php

/**
 * @file
 * Contains \Drupal\machine_name\Plugin\Field\FieldWidget\MachineName.
 */

namespace Drupal\machine_name\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * @FieldWidget(
 *  id = "machine_name",
 *  label = @Translation("Machine name"),
 *  field_types = {"machine_name"}
 * )
 */
class MachineName extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $widget = [
      '#type' => 'machine_name',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#machine_name' => [
        'exists' => '\Drupal\machine_name\Plugin\Field\FieldType\MachineName::exists',
      ],
      // Do we need configurable maxlength?
      '#maxlength' => 128,
      '#entity_type' => $this->fieldDefinition->getTargetEntityTypeId(),
      '#field_name' => $this->fieldDefinition->getName(),
      '#disabled' => isset($items[$delta]->value),
    ];

    $element['value'] = $element + $widget;
    return $element;
  }

}
