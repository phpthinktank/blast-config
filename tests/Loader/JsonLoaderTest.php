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
        /**
     * @var Resource
     */ 
    private $resource;
    
    protected function setUp(){
        $resourceBasePath = dirname(__DIR__) . '/res';
        $repository = new FilesystemRepository($resourceBasePath);
        
        $factory = new Factory();
        $this->resource = $factory->create($repository)->locate('/config/config.json');
    }
    
    public function testConfig()
    {
        $resource = $this->resource;
        $loader = new JsonLoader();
        $this->assertTrue($loader->validateExtension($resource));
        $this->assertInstanceOf(Resource::class, $resource);
        $this->assertInstanceOf(BodyResource::class, $resource);
        
        $config = $loader->transform($resource);
        
        $this->assertTrue($loader->validateConfig($config));
        $this->assertInternalType('array', $loader->transform($resource));
        $this->assertInternalType('array', $loader->load($resource));
    }
}
