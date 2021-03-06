<?php

namespace eCampApi;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\Config\Factory as ConfigFactory;
use Laminas\Mvc\Application;
use Laminas\Mvc\MvcEvent;

class Module implements ApiToolsProviderInterface {
    public function getConfig() {
        return ConfigFactory::fromFiles(
            array_merge(
                [__DIR__.'/../../config/module.config.php'],
                glob(__DIR__.'/../../config/Rest/*.config.php')
            )
        );
    }

    public function getAutoloaderConfig() {
        return [
            'Laminas\ApiTools\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    public function onBootstrap(MvcEvent $e) {
        /** @var Application $app */
        $app = $e->getApplication();

        $helpers = $app->getServiceManager()->get('ViewHelperManager');
        /** @var \Laminas\ApiTools\Hal\Plugin\Hal $hal */
        $hal = $helpers->get('Hal');

        $entityExtractor = new HalEntityExtractor($hal->getEntityHydratorManager());
        $hal->setEntityExtractor($entityExtractor);

        $halResourceFactory = new HalResourceFactory($hal->getEntityHydratorManager(), $hal->getEntityExtractor());
        $hal->setResourceFactory($halResourceFactory);
    }
}
