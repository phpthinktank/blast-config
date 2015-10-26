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

        return $this->transform($resource);
    }
    
        
    /**
     * Transform resource into a config array
     * @param FilesystemResource $resource
     * @return array 
     */
    public function transform(FilesystemResource $resource)
    {
        $path = $resource->getFilesystemPath();
        $config = require $path;
        
        return $this->validateConfig($config) ? $config : [];
    }
}
