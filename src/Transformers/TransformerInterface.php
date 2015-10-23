<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 14:49
 */

namespace Blast\Config\Transformers;


use Puli\Repository\Api\Resource\FilesystemResource;

interface TransformerInterface
{

    /**
     * Return valid extension for this transformer
     * @return string
     */
    public function getExtension();

    /**
     * Transform resource into a config array
     * @param FilesystemResource $resource
     * @return mixed
     */
    public function transform(FilesystemResource $resource);

}