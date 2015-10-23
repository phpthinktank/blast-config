<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 14:23
 */

namespace Blast\Config;


use Puli\Repository\Api\EditableRepository;
use Puli\Repository\Api\Resource\FilesystemResource;
use Puli\Repository\FilesystemRepository;
use Symfony\Component\Config\FileLocatorInterface;

class Locator implements LocatorInterface
{

    /**
     * @var FilesystemRepository
     */
    private $repository;

    /**
     * Create locator by assign a repository instance
     * @param FilesystemRepository $repository
     */
    public function __construct(FilesystemRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return FilesystemRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Locate config files from path.
     * @param $path
     * @return FilesystemResource|bool
     */
    public function locate($path)
    {
        $repository = $this->getRepository();

        if(!$repository->contains($path)){
            throw new \InvalidArgumentException(sprintf('Their is no path %s in repository.', $path));
        }

        $resource = $repository->get($path);

        if(!($resource instanceof FilesystemResource)){
            throw new \RuntimeException(['Expect %s! %s given', FilesystemResource::class, get_class($resource)]);
        }

        return $resource;
    }
}