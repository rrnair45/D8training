<?php

namespace Drupal\db_custom\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

class WelcomeController extends ControllerBase {
	public function print_welcome() {
		return [
				'#markup' => 'welcome to module'
		];
	}
	public function print_welcome_two() {
		return [
				'#markup' => 'welcome to module two'
		];
	}
	public function print_welcome_with_arg($name) {
		return [
				'#markup' => t ( 'dfsdfdsf @name', array (
						'@name' => $name
				) )
		];
	}
	public function print_welcome_with_node(Node $node) {
		return [
				'#markup' => t ( '@node', array (
						'@node' => $node->getTitle ()
				) )
		];
	}
	public function entity_access_check(Node $node, AccountInterface $account) {
		return AccessResult::allowedIf ( $node->getOwnerId () == $account->id () );
	}
	public function print_welcome_multiple_node(Node $node1, Node $node2) {
		return [
				'#markup' => t ( '@node', array (
						'@node' => $node1->getTitle ()
				) )
		];
	}
}

?>