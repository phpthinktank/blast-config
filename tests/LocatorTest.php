<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 23.10.2015
 * Time: 14:22
 */

namespace Blast\Tests;


use Blast\Config\Locator;
use Puli\Repository\FilesystemRepository;
use Puli\Repository\Api\Resource\FilesystemResource;

class LocatorTest extends \PHPUnit_Framework_TestCase
{

    private $repository;

    public function testLocateResource()
    {
        $locator = new Locator($this->repository);
        $resource = $locator->locate('/config/config.php');
        $this->assertInstanceOf(FilesystemResource::class, $resource);
    }

    public function testInitiation()
    {
        $locator = new Locator($this->repository);
        $this->assertInstanceOf(FilesystemRepository::class, $locator->getRepository());
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidPath()
    {
        $locator = new Locator($this->repository);
        $locator->locate('/not/a.file')
    }
    
    /**
     * @expectedException RuntimeException
     */
    public function testInvalidRepository()
    {
        $locator = new Locator($this->repository);
        $locator->locate(new \stdClass);
    }

    protected function setUp()
    {
        parent::setUp();

        $this->repository = new FilesystemRepository(__DIR__ . '/res');
    }


}
