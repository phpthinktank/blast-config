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
     * Transform resource into a config array
     * @param FilesystemResource $resource
     * @return array
     */
    public function load(FilesystemResource $resource)
    {

        if($this->validateExtension($resource)){
            return false;
        }

        if(!($resource instanceof BodyResource)){
            throw new \InvalidArgumentException('Expect an instance of BodyResource, %s given', get_class($resource));
        }

        $config = json_decode($resource->getBody(), true);

        $this->validateConfig($config);

        return $config;
    }
}