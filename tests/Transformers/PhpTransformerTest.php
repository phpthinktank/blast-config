<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 23.10.2015
 * Time: 14:52
 */

namespace Blast\Tests;


class PhpTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testLocatePhpConfig()
    {
        $resourceBasePath = dirname(__DIR__) . '/assets';
        $repo = new FilesystemRepository($resourceBasePath);
        $config = $repo->get('/config/config.php');
        $this->assertInstanceOf(Resource::class, $config);
        $this->assertFileExists($config->getFilesystemPath());
        $this->assertEquals('php', pathinfo($config->getFilesystemPath(), PATHINFO_EXTENSION));
        $this->assertInternalType('array', require $config->getFilesystemPath());
    }
    public function testLocateJsonConfig()
    {
        $resourceBasePath = dirname(__DIR__) . '/assets';
        $repo = new FilesystemRepository($resourceBasePath);
        $config = $repo->get('/config/config.json');
        $this->assertInstanceOf(Resource::class, $config);
        $this->assertInstanceOf(BodyResource::class, $config);
        $this->assertEquals('json', pathinfo($config->getFilesystemPath(), PATHINFO_EXTENSION));
        $this->assertInternalType('array', json_decode($config->getBody(), true));
    }
}
