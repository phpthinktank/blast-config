<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 22.10.2015
 * Time: 15:43
 */

namespace Blast\Config;


use Blast\Config\Loader\JsonLoader;
use Blast\Config\Loader\LoaderInterface;
use Blast\Config\Loader\PhpLoader;
use Puli\Repository\Api\Resource\FilesystemResource;
use Puli\Repository\FilesystemRepository;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class Factory
{
    public function create($repository)
    {

        //if repository is a string
        //given repository should be a valid directory path
        if (is_string($repository)) {
            //clear stat cache to avoid loading cached files,
            //which where unlinked in system
            clearstatcache(TRUE);
            if (!is_dir($repository)) {
                throw new FileNotFoundException($repository);
            }

            $repository = new FilesystemRepository($repository);
        }

        //if there is no valid instance cancel creation
        if (!($repository instanceof FilesystemRepository)) {
            throw new \RuntimeException('Expected instance of FilesystemRepository. %s given', get_class($repository));
        }

        $locator = new Locator($repository);

        return $locator;
    }

    /**
     * Load configuration by loader
     * @param string $path Path to configuration, relative to configured locator repository path e.g. /config/config.php
     * @param LocatorInterface $locator
     * @param LoaderInterface[] $loaders If is empty, PhpLoader and JsonLoader is loading by default
     * @param array $config Default configuration, overwrite by found config
     * @return array
     */
    public function load($path, LocatorInterface $locator, array $loaders = [], array $config = [])
    {
        $resource = $locator->locate($path);

        if(count($loaders) < 1){
            $loaders = [
                new PhpLoader(),
                new JsonLoader()
            ];
        }

        foreach($loaders as $loader){
            if(pathinfo($resource->getPath(), PATHINFO_EXTENSION) !== $loader->getExtension()){
                continue;
            }

            $config = $loader->load($resource);
            break;
        }

        return $config;
    }

}