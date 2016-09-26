<?php

namespace Ttskch\RayDiBundle\Tests\DependencyInjection;

use Ttskch\RayDiBundle\DependencyInjection\TtskchRayDiExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var TtskchRayDiExtension
     */
    private $extension;

    public function setUp()
    {
        $this->container = new ContainerBuilder(new ParameterBag());
        $this->extension = new TtskchRayDiExtension;
    }

    /**
     * @test
     */
    public function testLoad()
    {
        $configs = $this->getConfigs();
        $this->extension->load($configs, $this->container);

        $this->assertTrue($this->container->has('ttskch_ray_di.injector'));

        $definition = $this->container->getDefinition('ttskch_ray_di.injector');
        $this->assertEquals('Ray\Di\Injector', $definition->getClass());

        /** @var Definition $moduleDefinition */
        $moduleDefinition = $definition->getArguments()[0];
        $this->assertInstanceOf('Symfony\Component\DependencyInjection\Definition', $moduleDefinition);
        $this->assertEquals('Foo\BarModule', $moduleDefinition->getClass());
    }

    private function getConfigs()
    {
        return [
            'ttskch_ray_di' => [
                'module_class' => 'Foo\BarModule',
            ],
        ];
    }
}
