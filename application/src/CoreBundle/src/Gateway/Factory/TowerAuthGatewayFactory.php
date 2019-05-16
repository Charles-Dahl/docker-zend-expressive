<?php

namespace CoreBundle\Gateway\Factory;

use CoreBundle\Gateway\TowerAuthGateway;
use Interop\Container\ContainerInterface;
use Zend\Soap\Client;

class TowerAuthGatewayFactory {

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName) {
        $options = $this->resolveOptions($container->get("config"));
        $client = new Client($options['url']);

        return new TowerAuthGateway($client);
    }

    /**
     * [resolveOptions description]
     *
     * @param  array  $config [description]
     * @return array
     */
    private function resolveOptions(array $config) {
        if (!isset($config['tower_auth_gateway']['options'])) {
            throw new \Exception("Could not resolve tower auth gateway configuration", 1);
        }

        return $config['tower_auth_gateway']['options'];
    }

}
