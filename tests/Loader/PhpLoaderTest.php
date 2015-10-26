<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 23.10.2015
 * Time: 14:52
 */

namespace Blast\Tests\Loader;


use Blast\Config\Factory;
use Blast\Config\Loader\PhpLoader;
use Puli\Repository\Api\Resource\Resource;
use Puli\Repository\FilesystemRepository;

class PhpLoaderTest extends \PHPUnit_Framework_TestCase
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
        $this->resource = $this->locator->locate('/config/config.php');
        $this->loader = new PhpLoader();
    }
    
    public function testConfig()
    {
        $loader = $this->loader;
        $resource = $this->resource;
        $this->assertInstanceOf(Resource::class, $resource);
        $this->assertTrue($loader->validateExtension($resource));
        $this->assertFileExists($resource->getFilesystemPath());
        
        $config = $loader->transform($resource);
        $this->assertTrue($loader->validateConfig($config));
        $this->assertInternalType('array', $loader->transform($resource));
        $this->assertInternalType('array', $loader->load($resource));
    }
    
    public function testUnknownExtension(){
        $loader = $this->loader;
        $this->assertFalse($loader->validateExtension($this->locator->locate('/config/config.any')));
    }

}
