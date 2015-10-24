<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 21.10.2015
 * Time: 14:49
 */

namespace Blast\Config\Loader;


use Puli\Repository\Api\Resource\FilesystemResource;

interface LoaderInterface
{

    /**
     * Return valid extension for this transformer
     * @return string
     */
    public function getExtension();

    /**
     * Transform resource into a config array
     * @param FilesystemResource $resource
     * @return array
     */
    public function load(FilesystemResource $resource);

}