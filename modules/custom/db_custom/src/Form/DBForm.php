<?php

namespace Drupal\db_custom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\db_custom\DBFetch;

class DBForm extends FormBase implements ContainerInjectionInterface {
	private $db_wrapper;
	public function __construct(DBFetch $db_wrapper) {
		$this->db_wrapper = $db_wrapper;
	}
	public function getFormId() {
		return 'db_custom_form_one';
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['First_Name'] = [
				'#type' => 'textfield',
				'#title' => 'Your Name'

		];

		$form ['actions'] ['submit'] = [
				'#type' => 'submit',
				'#value' => $this->t ( 'Save' ),
				'#button_type' => 'primary'
		];

		return $form;
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		parent::validateForm ( $form, $form_state );
		if (strlen ( $form_state->getValue ( 'First_Name' ) ) < 10) {
			$form_state->setErrorByName ( 'First_Name', $this->t ( 'First name is too short.' ) );
		}
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$name = $form_state->getValue ( 'First_Name' );
		drupal_set_message ( $name );
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( 'db_custom.db_fetch' ) );
	}
}
?>