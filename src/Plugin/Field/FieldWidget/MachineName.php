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
 *   id = "machine_name",
 *   label = @Translation("Machine name"),
 *   field_types = {
 *     "machine_name"
 *   },
 *   settings = {
 *     "editable" = {}
 *   }
 * )
 */
class MachineName extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'editable' => FALSE,
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {

    $disabled = TRUE;

    if ($this->getSetting('editable')) {
      $disabled = FALSE;
    }
    $widget = [
      '#type' => 'machine_name',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#maxlength' => 64,
      '#disabled' => $disabled,
    ];

    $element['value'] = $element + $widget;
    return $element;
  }


  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {

    $form['editable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Editable'),
      '#description' => t('Allows field to be editable in saved entity.'),
      '#default_value' => $this->getSetting('editable'),
    );

    return $form;
  }

  public function settingsSummary() {
    $summary = [];

    if (!empty($this->getSetting('editable'))) {
      $summary[] = t('Editable: @editable', array('@editable' => $this->getSetting('editable') ? 'yes' : 'no'));
    }

    return $summary;
  }

}
