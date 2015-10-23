<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 14:46
 */

namespace Blast\Config\Transformers;

use Puli\Repository\Api\Resource\FilesystemResource;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class PhpTransformer implements TransformerInterface
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
     * @return mixed
     */
    public function transform(FilesystemResource $resource)
    {
        $path = $resource->getFilesystemPath();
        if(!file_exists($path)){
            throw new FileNotFoundException($path);
        }

        $extension = pathinfo($path, PATHINFO_EXTENSION);
        if(!$extension !== $this->getExtension()){
            throw new FileException(sprintf('Invalid extension %s for config file %s', $extension, $path));
        }

        $config = require $path;

        if(!is_array($config)){
            throw new \RuntimeException('Invalid internal config type! Array expected, %s given!', gettype($config));
        }

        return $config;
    }
}