<?php 
namespace Drupal\db_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Provides a 'cache' Block.
 *
 * @Block(
 *   id = "cache_block",
 *   admin_label = @Translation("Cache Block"),
 *   category = @Translation("Custom"),
 * )
 */ 
class NewBlock extends BlockBase implements ContainerFactoryPluginInterface{
	private $database;
	public function __construct(array $configuration, $plugin_id, $plugin_definition, Connection $connection) {
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->database = $connection;
	}
	
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
		return new static(			$configuration,
				$plugin_id,
				$plugin_definition,
				$container->get('database') //from service name in service.yml
				);
		
		
		
		
	}
	public function build() {
		$build = [];
		$output = '';
		$results = $this->database->select ( 'node_field_data', 'cs' )->fields ( 'cs', [
				'nid','title'
		] )->range(0,3)->orderBy('nid','DESC')->execute ()->fetchAll ();
		
		foreach($results as $result){
			
			$output .= '|' . $result->title;
			$tags[]= 'node'.$result->nid;
			
		}
		$tags[]= 'node_list';
		
		$build['node_title_block']['#markup'] = $output;
		$build['node_title_block']['#cache']['tags'] = $tags;
		return $build;
	
	}
	

}
?>