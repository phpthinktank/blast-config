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
    
    /**
     * @var Blast\Config\Locator
     */ 
    private $locator;
    
    /**
     * @var Blast\Config\Loader\LoaderInterface
     */ 
    private $loader;
    
    protected function setUp(){
        $resourceBasePath = dirname(__DIR__) . '/res';
        $repository = new FilesystemRepository($resourceBasePath);
        
        $factory = new Factory();
        $this->locator = $factory->create($repository);
        $this->resource = $this->locator->locate('/config/config.json');
        $this->loader = new JsonLoader();
    }
    
    public function testConfig()
    {
        $resource = $this->resource;
        $loader = $this->loader;
        $this->assertTrue($loader->validateExtension($resource));
        $this->assertInstanceOf(Resource::class, $resource);
        $this->assertInstanceOf(BodyResource::class, $resource);
        
        $config = $loader->transform($resource);
        
        $this->assertTrue($loader->validateConfig($config));
        $this->assertInternalType('array', $loader->transform($resource));
        $this->assertInternalType('array', $loader->load($resource));
    }
    
    public function testUnknownExtension(){
        $loader = $this->loader;
        $this->assertFalse($loader->load($this->locator->locate('/config/config.any')));
    }
}
