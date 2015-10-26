<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 15:16
 */

namespace Blast\Config\Loader;


use Puli\Repository\Api\Resource\BodyResource;
use Puli\Repository\Api\Resource\FilesystemResource;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class JsonLoader extends AbstractLoader implements LoaderInterface
{

    /**
     * Return valid extension for this transformer
     * @return string
     */
    public function getExtension()
    {
        return 'json';
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

        if(!($resource instanceof BodyResource)){
            throw new \InvalidArgumentException('Expect an instance of BodyResource, %s given', get_class($resource));
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
        $config = json_decode($resource->getBody(), true);
        return $this->validateConfig($config) ? $config : [];
    }
}
