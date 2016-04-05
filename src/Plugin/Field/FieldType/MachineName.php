<?php

/**
 * @file
 * Contains \Drupal\machine_name\Plugin\Field\FieldType\MachineName.
 */

namespace Drupal\machine_name\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'machine_name' field type.
 *
 * @FieldType(
 *   id = "machine_name",
 *   label = @Translation("Machine name"),
 *   description = @Translation("This field stores varchar text in the database."),
 *   default_widget = "machine_name",
 *   default_formatter = "machine_name"
 * )
 */
class MachineName extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => 'varchar',
          'length' => 64,
          'not null' => TRUE,
          'default' => '',
        ],
      ],
      'indexes' => [
        'value' => ['value'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {

    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Machine name'));

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraints = parent::getConstraints();
    $constraint_manager = $this->getTypedDataManager()->getValidationConstraintManager();
    $constraints[] = $constraint_manager->create('MachineNameUnique', []);
    return $constraints;
  }


}
