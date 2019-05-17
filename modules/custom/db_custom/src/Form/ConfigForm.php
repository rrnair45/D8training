<?php

namespace Drupal\db_custom\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

class ConfigForm extends ConfigFormBase {
	public function getFormId() {
		return 'config_form';
	}
	protected function getEditableConfigNames() {
		return [
				'db_custom.weather_config'
		];
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		$form ['app_id'] = [
				'#type' => 'textfield',
				'#title' => 'App Id',
				'#default_value' => $this->config ( 'db_custom.weather_config' )->get ( 'app_id' )

		];

		return parent::buildForm ( $form, $form_state );
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config ( 'db_custom.weather_config' )->set ( 'app_id', $form_state->getValue ( 'app_id' ) )->save ();
		parent::submitForm ( $form, $form_state );
	}
}
?>