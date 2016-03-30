<?php

/**
 * @file
 * Contains \Drupal\machine_name\Plugin\Field\FieldFormatter\MachineName.
 */

namespace Drupal\machine_name\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * @FieldFormatter(
 *  id = "machine_name",
 *  label = @Translation("Machine name"),
 *  field_types = {"machine_name"}
 * )
 */
class MachineName extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {

    $element = [];
    foreach ($items as $delta => $item) {
      // Is machine name safe?
      $element[$delta]['#markup'] = $item->value;
    }
    return $element;

  }

}
