<?php
/*
*
* (c) Marco Bunge <marco_bunge@web.de>
*
* For the full copyright and license information, please view the LICENSE.txt
* file that was distributed with this source code.
*
* Date: 24.10.2015
* Time: 23:27
*/

namespace Blast\Tests;


use Blast\Config\Factory;
use Blast\Config\LocatorInterface;
use Puli\Repository\FilesystemRepository;

class FactoryTest extends \PHPUnit_Framework_TestCase
{


    public function testCreateFromPath()
    {
        $factory = new Factory();
        $locator = $factory->create(__DIR__ . '/res');
        $this->assertInstanceOf(LocatorInterface::class, $locator);
    }

    public function testCreateFromRepository(){
        $factory = new Factory();
        $locator = $factory->create(new FilesystemRepository(__DIR__ . '/res'));
        $this->assertInstanceOf(LocatorInterface::class, $locator);
    }

    public function testLoad(){
        $factory = new Factory();
        $locator = $factory->create(__DIR__ . '/res');
        $config = $factory->load('/config/config.json', $locator);
        $this->assertInstanceOf(LocatorInterface::class, $locator);
        $this->assertInternalType('array', $config);
    }


}
