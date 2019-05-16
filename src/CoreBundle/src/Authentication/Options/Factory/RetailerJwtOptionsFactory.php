<?php

namespace CoreBundle\Authentication\Options\Factory;

use CoreBundle\Authentication\Options\RetailerJwtOptions;
use Interop\Container\ContainerInterface;

class RetailerJwtOptionsFactory {

	function __invoke(ContainerInterface $container) {
		$optionsConfig = $container->get('config')['retailer_jwt_options'] ?? [];
		$options = new RetailerJwtOptions();
		$options->setFromArray($optionsConfig);
		return $options;
	}
}