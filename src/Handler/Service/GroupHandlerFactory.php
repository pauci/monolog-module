<?php

namespace MonologModule\Handler\Service;

use Interop\Container\ContainerInterface;
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
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array $options
     * @return GroupHandler
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $handlerOptions = new GroupHandlerOptions($options);

        $handlers = [];
        foreach ($handlerOptions->getHandlers() as $handler) {
            if (is_string($handler)) {
                $handler = $container->get("monolog.handler.$handler");
            } elseif (is_array($handler) && !empty($handler['type'])) {
                $type = $handler['type'];
                unset($handler['type']);
                $handler = $container->get(HandlerPluginManager::class)->get($type, $handler);
            }
            $handlers[] = $handler;
        }

        return $this->create(
            $handlers,
            $handlerOptions->getBubble()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, GroupHandler::class, $this->creationOptions);
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
