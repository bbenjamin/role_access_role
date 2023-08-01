<?php

namespace Drupal\role_access_role;

use \Drupal\user\RoleStorage;

class RoleToRoleStorage extends RoleStorage {


  /**
   * {@inheritdoc}
   */
  protected function postLoad(array &$roles) {
    parent::postLoad($roles);
    $current_user = \Drupal::currentUser();
    $user_roles = $current_user->getRoles();

    if (array_search('administrator', $user_roles) === FALSE) {
      $permissions = [];
      foreach ($user_roles as $user_role) {
        if (isset($roles[$user_role])) {
          $permissions = array_merge($permissions, $roles[$user_role]->getPermissions());
        }
      }
      foreach($roles as $role_name => $role_object) {
        if (array_search("see the role $role_name", $permissions) === FALSE && array_search($role_name, $user_roles) === FALSE) {
          unset($roles[$role_name]);
        }
      }
    }
  }
}
