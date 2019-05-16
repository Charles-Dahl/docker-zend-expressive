<?php

namespace CoreBundle\Gateway\Factory;

use Interop\Container\ContainerInterface;
use Towersystems\Subscription\Gateway\TowerSubscriptionsGateway;
use Zend\Http\Client;
use Zend\Http\Client\Adapter\Curl;

class TowerSubscriptionsGatewayFactory {

    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName) {
        $config = $container->get("config");
        $options = $this->resolveOptions($config);
        $client = $this->buildClient();

        return new TowerSubscriptionsGateway($options, $client);
    }

    /**
     * [resolveOptions description]
     *
     * @param  array  $config [description]
     * @return array
     */
    private function resolveOptions(array $config) {
        if (!isset($config['tower_subscription_gateway']['options'])) {
            throw new \Exception("Could not resolve tower subscriptions gateway configuration", 1);
        }

        return $config['tower_subscription_gateway']['options'];
    }

    /**
     * [buildClient description]
     *
     * @return [type] [description]
     */
    private function buildClient(): Client {
        $adapter = new Curl();
        $adapter->setCurlOption(CURLOPT_SSL_VERIFYPEER, false);
        $client = new Client();
        $client->setAdapter($adapter);
        return $client;
    }

}
