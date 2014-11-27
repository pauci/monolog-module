<?php

namespace MonologModule\Formatter\Service;

use Monolog\Formatter\LineFormatter;
use MonologModule\Service\AbstractPluginFactory;
use MonologModule\Formatter\Options\LineFormatterOptions;
use Zend\ServiceManager\ServiceLocatorInterface;

class LineFormatterFactory extends AbstractPluginFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return LineFormatter
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new LineFormatterOptions($this->creationOptions);

        return new LineFormatter(
            $options->getFormat(),
            $options->getDateFormat(),
            $options->getAllowInlineLineBreaks(),
            $options->getIgnoreEmptyContextAndExtra()
        );
    }
}
