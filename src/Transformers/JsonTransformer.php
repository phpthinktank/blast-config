<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 15:16
 */

namespace Blast\Config\Transformers;


use Puli\Repository\Api\Resource\BodyResource;
use Puli\Repository\Api\Resource\FilesystemResource;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class JsonTransformer implements TransformerInterface
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
     * Transform resource into a config array
     * @param FilesystemResource $resource
     * @return array
     */
    public function transform(FilesystemResource $resource)
    {
        if(!($resource instanceof BodyResource)){
            throw new \InvalidArgumentException('Expect an instance of BodyResource, %s given', get_class($resource));
        }

        $path = $resource->getPath();
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if(!$extension !== $this->getExtension()){
            throw new FileException(sprintf('Invalid extension %s for config file %s', $extension, $path));
        }

        $config = json_decode($resource->getBody(), true);

        if(!is_array($config)){
            throw new \RuntimeException('Invalid internal config type! Array expected, %s given!', gettype($config));
        }

        return $config;
    }
}