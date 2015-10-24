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

class PhpLoader implements LoaderInterface
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
        $path = $resource->getFilesystemPath();

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if($extension !== $this->getExtension()){
            return false;
        }

        if(!file_exists($path)){
            throw new FileNotFoundException($path);
        }

        $config = require $path;

        if(!is_array($config)){
            throw new \RuntimeException('Invalid internal config type! Array expected, %s given!', gettype($config));
        }

        return $config;
    }
}