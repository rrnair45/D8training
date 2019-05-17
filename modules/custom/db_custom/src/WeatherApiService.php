<?php 
namespace Drupal\db_custom;

use GuzzleHttp\Client;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Component\Serialization\Json;

class WeatherApiService {
	private $client;
	private $config_factory;
	public function __construct(Client $client, ConfigFactory $config_factory){
		$this->client =  $client;
		$this->config_factory = $config_factory;
	}
	
	
	public function fetchWeatherData($city){
		$ApiKey = $this->config_factory->get('db_custom.weather_config')->get('app_id');
		#$url = 'http://localhost/drupal-8.7.1/mumbai.json';
		#return $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".$ApiKey;
		
		$res = $this->client->request('GET', 'http://localhost/drupal-8.7.1/mumbai.json');
		 $res->getStatusCode();
		 $body = $res->getBody();
		 $data = Json::decode($body);
		 return $data['main'];
		
	}
	
	
}
?>