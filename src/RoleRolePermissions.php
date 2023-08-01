<?php

namespace Drupal\role_access_role;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\user\Entity\Role;

class RoleRolePermissions {
  use StringTranslationTrait;

  public function buildRoleRolePermissions() {
    $roles = Role::loadMultiple();
    $permissions = [];
    forEach( $roles as $role_name => $role_object) {
      $permissions["see the role $role_name"] = [
        'title' => $this->t('See the role: %role', ['%role' => $role_object->label()]),
        'description' => $this->t('If a user has the %role role, they will still be able to see it even if this permission is disabled. ', ['%role' => $role_object->label()])
      ];
    }
    return $permissions;
  }
}
