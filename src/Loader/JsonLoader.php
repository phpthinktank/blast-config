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

class JsonLoader implements LoaderInterface
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
        $path = $resource->getPath();
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if($extension !== $this->getExtension()){
            return false;
        }

        if(!($resource instanceof BodyResource)){
            throw new \InvalidArgumentException('Expect an instance of BodyResource, %s given', get_class($resource));
        }

        $config = json_decode($resource->getBody(), true);

        if(!is_array($config)){
            throw new \RuntimeException('Invalid internal config type! Array expected, %s given!', gettype($config));
        }

        return $config;
    }
}