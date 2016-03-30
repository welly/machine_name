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
        'exists' => array($this, 'exists'),
      ],
      '#maxlength' => 64,
    ];

    $element['value'] = $element + $widget;
    return $element;
  }

  public static function exists($entity_id, array $element, FormStateInterface $form_state) {

    $entity_type = $form_state->getFormObject()->getEntity()->getEntityType();

    $result = \Drupal::entityQuery($entity_type->id())
      ->condition('field_testing.value', $entity_id)
      ->execute();

    return (bool)$result;

  }

}
