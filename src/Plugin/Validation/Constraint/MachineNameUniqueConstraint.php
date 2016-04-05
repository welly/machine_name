<?php

/**
 * @file
 * Contains \Drupal\Core\Validation\Plugin\Validation\Constraint\UniqueFieldConstraint.
 */

namespace Drupal\machine_name\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks if an entity field has a unique value.
 *
 * @Constraint(
 *   id = "MachineNameUnique",
 *   label = @Translation("Unique machine name constraint", context = "Validation"),
 * )
 */
class MachineNameUniqueConstraint extends Constraint {

  public $message = 'The machine name %value is already in use. It must be unique.';

  /**
   * {@inheritdoc}
   */
  public function validatedBy() {
    return '\Drupal\machine_name\Plugin\Validation\Constraint\MachineNameUniqueValidator';
  }

}
