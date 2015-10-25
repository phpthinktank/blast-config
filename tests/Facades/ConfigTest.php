<?php
/*
*
* (c) Marco Bunge <marco_bunge@web.de>
*
* For the full copyright and license information, please view the LICENSE.txt
* file that was distributed with this source code.
*
* Date: 25.10.2015
* Time: 18:11
*/

namespace Blast\Tests;


use Blast\Config\ConfigServiceProvider;
use Blast\Config\Facades\Config;
use Blast\Config\Factory;
use Blast\Config\FactoryInterface;
use Blast\Facades\FacadeFactory;
use League\Container\Container;

class ConfigTest extends \PHPUnit_Framework_TestCase
{


    public function testInstanceFromFacade()
    {
        $container = new Container();
        $container->addServiceProvider(new ConfigServiceProvider());
        FacadeFactory::setContainer($container);
        $instance = Config::__instance();
        $this->assertInstanceOf(FactoryInterface::class, $instance);
        $this->assertInstanceOf(Factory::class, $instance);
    }
}
