<?php

/**
 * @file
 * Contains \Drupal\Core\Validation\Plugin\Validation\Constraint\UniqueFieldValueValidator.
 */

namespace Drupal\machine_name\Plugin\Validation\Constraint;

use Drupal\Component\Utility\Unicode;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates that a field is unique for the given entity type.
 */
class MachineNameUniqueValidator extends ConstraintValidator {

  /**
   * {@inheritdoc}
   */
  public function validate($item, Constraint $constraint) {

    if ($item->isEmpty()) {
      return NULL;
    }

    $entity = $item->getEntity();
    $entity_id = $item->id();
    $entity_type = $entity->getEntityType();
    $field_name = $item->getFieldDefinition()->getName();
    $properties = $item->getProperties();

    // Query to see if existing entity with machine name exists.
    $query = \Drupal::entityQuery($entity_type->id());

    foreach ($properties as $property) {
      $query->condition($field_name . '.value', $property->getValue());

      // Checking if an entity exists. If so, ignore it.
      if (!empty($entity_id)) {
        $query->condition($entity_type->getKey('id'), $entity_id, '<>');
      }
      $result = $query->execute();

      if (!empty($result)) {
        $this->context->addViolation($constraint->message, array('%value' => $property->getValue()));
      }
    }
  }

}
