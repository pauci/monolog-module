<?php

namespace MonologModule\Handler\Service;

use Monolog\Handler\GroupHandler;
use MonologModule\Handler\HandlerPluginManager;
use MonologModule\Handler\Options\GroupHandlerOptions;
use MonologModule\Service\AbstractPluginFactory;
use Zend\ServiceManager\ServiceLocatorInterface;

class GroupHandlerFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return GroupHandler
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new GroupHandlerOptions($this->creationOptions);

        $handlers = [];
        foreach ($options->getHandlers() as $handler) {
            if (is_string($handler)) {
                $handler = $serviceLocator->get("monolog.handler.$handler");
            } elseif (is_array($handler) && !empty($handler['type'])) {
                $type = $handler['type'];
                unset($handler['type']);
                $handler = $serviceLocator->get(HandlerPluginManager::class)->get($type, $handler);
            }
            $handlers[] = $handler;
        }

        return $this->create($handlers, $options->getBubble());
    }

    /**
     * @param array $handlers
     * @param bool $bubble
     * @return GroupHandler
     */
    protected function create($handlers, $bubble)
    {
        return new GroupHandler($handlers, $bubble);
    }
}
