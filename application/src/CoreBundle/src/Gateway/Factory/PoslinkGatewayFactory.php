<?php

namespace CoreBundle\Gateway\Factory;

use CoreBundle\Gateway\PoslinkGateway;
use Interop\Container\ContainerInterface;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;

class PoslinkGatewayFactory {

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName) {
        $options = $this->resolveOptions($container->get("config"));
        $adapter = new Curl();
        $adapter->setCurlOption(CURLOPT_SSL_VERIFYPEER, false);
        $client = new Client();
        $client->setAdapter($adapter);

        return new PoslinkGateway($client, $options);
    }

    /**
     * [resolveOptions description]
     *
     * @param  array  $config [description]
     * @return array
     */
    private function resolveOptions(array $config) {
        if (!isset($config['poslink_gateway']['options'])) {
            throw new \Exception("Could not resolve poslink configuration", 1);
        }

        return $config['poslink_gateway']['options'];
    }

}
