<?php

namespace MonologModule\Formatter\Service;

use Interop\Container\ContainerInterface;
use Monolog\Formatter\LineFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\LineFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class LineFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ContainerInterface $serviceLocator
     * @param string $requestedName
     * @param array $options
     * @return LineFormatter
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $formatterOptions = new LineFormatterOptions($options);

        return new LineFormatter(
            $formatterOptions->getFormat(),
            $formatterOptions->getDateFormat(),
            $formatterOptions->getAllowInlineLineBreaks(),
            $formatterOptions->getIgnoreEmptyContextAndExtra()
        );
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, LineFormatter::class, $this->creationOptions);
    }
}
