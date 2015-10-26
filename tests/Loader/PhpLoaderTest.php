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
    public function testLocatePhpConfig()
    {
        $resourceBasePath = dirname(__DIR__) . '/res';
        $repository = new FilesystemRepository($resourceBasePath);
        $loader = new PhpLoader();
        $factory = new Factory();
        $resource = $factory->create($repository)->locate('/config/config.php');
        var_dump(require $resource->getFilesystemPath());
        var_dump($loader->validateConfig($config, false));
        var_dump($loader->validateExtension($resource));
        $config = $loader->load($resource);
        var_dump($config);

        $this->assertTrue($loader->validateConfig($config, false));
        $this->assertTrue($loader->validateExtension($resource));
        $this->assertInstanceOf(Resource::class, $resource);
        $this->assertFileExists($resource->getFilesystemPath());
        $this->assertEquals('php', pathinfo($resource->getFilesystemPath(), PATHINFO_EXTENSION));
        $this->assertInternalType('array', $config);
    }

}
