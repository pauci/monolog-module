<?php

namespace MonologModuleTest\ServiceFactory;

use Monolog\Logger;
use MonologModuleTest\ServiceManagerFactory;
use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface;

class ModuleDefinedServicesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceManager;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        $this->serviceManager = ServiceManagerFactory::getServiceManager();
    }

    /**
     * Verifies that the module defines the correct services
     *
     * @dataProvider getServicesThatShouldBeDefined
     */
    public function testModuleDefinedServices($serviceName, $defined)
    {
        $this->assertEquals($defined, $this->serviceManager->has($serviceName), $serviceName);
    }

    /**
     * Verifies that the module defines the correct services
     *
     * @dataProvider getServicesThatCanBeFetched
     */
    public function testModuleFetchedService($serviceName, $expectedClass)
    {
        $this->assertInstanceOf($expectedClass, $this->serviceManager->get($serviceName));
    }

    /**
     * Verifies that the module defines the correct services
     *
     * @dataProvider getServicesThatCannotBeFetched
     */
    public function testModuleInvalidService($serviceName)
    {
        $this->setExpectedException(ServiceNotFoundException::class);

        $this->serviceManager->get($serviceName);
    }

    /**
     * @return array
     */
    public function getServicesThatShouldBeDefined()
    {
        return [
            ['monolog.logger.default', true],
        ];
    }

    /**
     * @return array
     */
    public function getServicesThatCanBeFetched()
    {
        return [
            ['monolog.logger.default', Logger::class],
        ];
    }

    /**
     * @return array
     */
    public function getServicesThatCannotBeFetched()
    {
        return [
            ['foo'],
            ['foo.bar'],
            ['foo.bar.baz'],
            ['cqrs'],
            ['cqrs.foo'],
            ['cqrs.foo.bar'],
            ['cqrs.command_bus.bar'],
        ];
    }
}
