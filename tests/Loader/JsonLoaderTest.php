<?php
/*
*
* (c) Marco Bunge <marco_bunge@web.de>
*
* For the full copyright and license information, please view the LICENSE.txt
* file that was distributed with this source code.
*
* Date: 25.10.2015
* Time: 00:11
*/

namespace Blast\Tests\Loader;


use Blast\Config\Factory;
use Blast\Config\Loader\JsonLoader;
use Puli\Repository\Api\Resource\BodyResource;
use Puli\Repository\Api\Resource\Resource;
use Puli\Repository\FilesystemRepository;

class JsonLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLocateJsonConfig()
    {
        $resourceBasePath = dirname(__DIR__) . '/res';
        $repository = new FilesystemRepository($resourceBasePath);
        $loader = new JsonLoader();
        $factory = new Factory();
        $resource = $factory->create($repository)->locate('/config/config.json');
        $config = $loader->load($resource);

        $this->assertTrue($loader->validateConfig($config, false));
        $this->assertTrue($loader->validateExtension($resource));
        $this->assertInstanceOf(Resource::class, $resource);
        $this->assertInstanceOf(BodyResource::class, $resource);
        $this->assertEquals('json', pathinfo($resource->getFilesystemPath(), PATHINFO_EXTENSION));
        //$this->assertInternalType('array', $config);
    }
}
