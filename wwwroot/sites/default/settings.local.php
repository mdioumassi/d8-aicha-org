<?php  



$settings['trusted_host_patterns'] = array(
//TODO: PREPROD
// https://www.drupal.org/node/1992030
);


$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.local.yml';

$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;


$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


error_reporting(E_ALL & ~(E_STRICT|E_NOTICE));
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set("max_execution_time", "12000");


//$config_directories[CONFIG_SYNC_DIRECTORY] = '../config/sync';
$config_directories['sync'] = 'config/development';


$settings['file_private_path'] =  'sites/default/files/private';