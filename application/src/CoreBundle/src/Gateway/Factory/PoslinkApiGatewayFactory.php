<?php

namespace CoreBundle\Gateway\Factory;

use CoreBundle\Gateway\PoslinkApiGateway;
use Interop\Container\ContainerInterface;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;

class PoslinkApiGatewayFactory {

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName) {
        $options = $this->resolveOptions($container->get("config"));
        $client = new Client();
        $client->setAdapter(new Curl());
        $client->setOptions(['timeout' => 300]);

        return new PoslinkApiGateway($client, $options);
    }

    /**
     * [resolveOptions description]
     *
     * @param  array  $config [description]
     * @return array
     */
    private function resolveOptions(array $config) {
        if (!isset($config['poslink_api_gateway']['options'])) {
            throw new \Exception("Could not resolve poslink api configuration", 1);
        }

        return $config['poslink_api_gateway']['options'];
    }

}
