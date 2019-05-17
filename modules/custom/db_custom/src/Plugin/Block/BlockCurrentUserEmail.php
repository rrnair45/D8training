<?php 
namespace Drupal\db_custom\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Session\AccountProxy;
/**
 * Provides a 'BlockCurrentUserEmail' Block.
 *
 * @Block(
 *   id = "BlockCurrentUserEmail",
 *   admin_label = @Translation("User Email Block"),
 *   category = @Translation("Custom"),
 * )
 */ 
class BlockCurrentUserEmail extends BlockBase implements ContainerFactoryPluginInterface{
	private $database;
	public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountProxy $connection) {
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->database = $connection;
	}
	
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition){
		return new static(			$configuration,
				$plugin_id,
				$plugin_definition,
				$container->get('current_user') //from service name in service.yml
				);
		
		
		
		
	}
	public function build() {
		$build = [];
		$output = '';
		$output = $this->database->getEmail();
		$tags[]= 'node_list';
		
		
		$build['node_title_block']['#markup'] = $output;
		$build['node_title_block']['#cache']['tags'] = $tags;
		$build['node_title_block']['#cache']['contexts']= array('user');
		return $build;
	
	}
	

}
?>