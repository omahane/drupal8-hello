<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\user\Entity\User;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a user details block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello")
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->_populate_markup(),
    );
  }

  public function _populate_markup() {
    $user = User::load(\Drupal::currentUser()->id());
    if ($user->get('uid')->value < 1) {
      return t('Welcome Visitor! The current time is ' . date('m-d-Y h:i:s', time()));
    } else {
      $user_information  = 'User Name: '. $user->getUsername() . "<br/>";
      $user_information .= 'Language: '. $user->getPreferredLangcode() . "<br/>";
      $user_information .= 'Email: ' . $user->getEmail() . "<br/>";
      // $user_information .=
      // $user_information .=
      // $user_information .=
      // $user_information .=
      // $user_information .=
      // $user_information .=
      // $user_information .=
      // $user_information .=

      $roles = NULL;

      foreach($user->getRoles() as $role) {
        $roles .= $role . ",";
      }

      $roles = 'Roles: ' . rtrim($roles, ',');

      $user_information .= $roles;

      return $user_information;
    }
  }
}
