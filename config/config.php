<?php

declare (strict_types = 1);

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
	'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
	\Zend\Expressive\Authentication\Session\ConfigProvider::class,
	\Zend\Expressive\Authentication\ConfigProvider::class,
	\Zend\Expressive\Session\Ext\ConfigProvider::class,
	\Zend\Expressive\Session\ConfigProvider::class,
	\Zend\Validator\ConfigProvider::class,
	\Zend\Expressive\Router\FastRouteRouter\ConfigProvider::class,
	\Zend\HttpHandlerRunner\ConfigProvider::class,
	// Include cache configuration
	new ArrayProvider($cacheConfig),

	\Zend\Expressive\Helper\ConfigProvider::class,
	\Zend\Expressive\ConfigProvider::class,
	\Zend\Expressive\Router\ConfigProvider::class,

	// Default App module config

	App\ConfigProvider::class,

	ResourceBundle\ConfigProvider::class,
	UserBundle\ConfigProvider::class,
	CoreBundle\ConfigProvider::class,

	// Load application config in a pre-defined order in such a way that local settings
	// overwrite global settings. (Loaded as first to last):
	//   - `global.php`
	//   - `*.global.php`
	//   - `local.php`
	//   - `*.local.php`
	new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),

	// Load development config if it exists
	new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);
// echo "<pre>";
// print_r($aggregator->getMergedConfig());die;
return $aggregator->getMergedConfig();
