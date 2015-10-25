<?php
/*
*
* (c) Marco Bunge <marco_bunge@web.de>
*
* For the full copyright and license information, please view the LICENSE.txt
* file that was distributed with this source code.
*
* Date: 25.10.2015
* Time: 18:00
*/

namespace Blast\Tests;


use Blast\Config\ConfigServiceProvider;
use Blast\Config\Factory;
use Blast\Config\FactoryInterface;
use League\Container\Container;

class ConfigServiceProviderTest extends \PHPUnit_Framework_TestCase
{


    public function testGetFactoryAsService()
    {
        $container = new Container();
        $container->addServiceProvider(new ConfigServiceProvider());
        $factory = $container->get(FactoryInterface::class);
        $this->assertInstanceOf(Factory::class, $factory);
        $this->assertInstanceOf(FactoryInterface::class, $factory);
    }
}
