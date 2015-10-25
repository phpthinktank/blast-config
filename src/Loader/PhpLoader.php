<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 14:46
 */

namespace Blast\Config\Loader;

use Puli\Repository\Api\Resource\FilesystemResource;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class PhpLoader extends AbstractLoader implements LoaderInterface
{
    /**
     * Return valid extension for this transformer
     * @return string
     */
    public function getExtension()
    {
        return 'php';
    }

    /**
     * Load config as Array from resource
     * @param FilesystemResource $resource
     * @return array
     */
    public function load(FilesystemResource $resource)
    {
        if(!$this->validateExtension($resource)){
            return false;
        }

        $path = $resource->getFilesystemPath();

        if(!file_exists($path)){
            throw new FileNotFoundException($path);
        }

        $config = require $path;

        $this->validateConfig($config);

        return $config;
    }
}