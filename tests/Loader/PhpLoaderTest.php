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
    private $locator;
    
    protected function setUp(){
        $resourceBasePath = dirname(__DIR__) . '/res';
        $repository = new FilesystemRepository($resourceBasePath);
        
        $factory = new Factory();
        $this->locator = $factory->create($repository);
        $this->resource = $this->locator->locate('/config/config.php');
    }
    
    public function testConfig()
    {
        $loader = new PhpLoader();
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
        $loader = new PhpLoader();
        $this->assertFalse($loader->validateExtension($this->locator->locate('/config/config.any')));
    }
    
    /**
     * @expectedException \Symfony\Component\Filesystem\Exception\FileNotFoundException
     */
    public function testUnknownExtension(){
        $loader = new PhpLoader();
        $loader->load($this->locator->locate('/not/existing.file'));
    }

}
