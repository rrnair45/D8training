<?php

namespace Drupal\db_custom\Plugin\Block;
 
/**
 * Provides a 'Weather' Block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather Block"),
 *   category = @Translation("Custom"),
 * )
 */ 

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\db_custom\WeatherApiService;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class WeatherApi extends BlockBase implements ContainerFactoryPluginInterface{
	private $weather_manager;
	public function __construct(array $configuration, $plugin_id, $plugin_definition, WeatherApiService $weather_manager) {
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->weather_manager = $weather_manager;
	}
	
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
		return new static(			$configuration,
				$plugin_id,
				$plugin_definition,
				$container->get('db_custom.weather_api') //from service name in service.yml
				);

			
		
	}
	
	
	public function build() {
	$result = 	$this->weather_manager->fetchWeatherData($this->configuration['data']);
		return [
				'#theme' => 'weather_info',
				'#temp' =>$result['temp'],
				'#pressure' =>$result['pressure'],
				'#humidity' =>$result['humidity'],
				'#temp_min' =>$result['temp_min'],
				'#temp_max' =>$result['temp_max'],
				'#attached' => [
						'library' => 'db_custom/weather-widget',
				],		
				
		];
	}
	
	public function blockForm($form, FormStateInterface $form_state) {
		$config = $this->getConfiguration();
		$form ['city'] = [
				'#type' => 'textfield',
				'#title' => 'City',
				'#default_value' => $config['city']
				
				
		];
		
		
		return $form;
		
	}
	
	public function blockSubmit($form, FormStateInterface $form_state) {
		
		$this->setConfigurationValue('city',$form_state->getValue('city'));
	}
	
}

?>