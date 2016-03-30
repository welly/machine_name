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

  public static function exists($value, array $element, FormStateInterface $form_state) {
    print_r($value);

    \Doctrine\Common\Util\Debug::dump($form_state);

//    $result = \Drupal::entityQuery($element['#type'])
//      ->condition('field_testing_value', $value)
//      ->execute();
//
//    print_r($result);
    die();
    return (bool)$result;

//    return \Drupal::entityQuery($element['#type'])
//      ->condition($element['#field_name'] . '.value', $value)
//      ->execute();

  }

}
