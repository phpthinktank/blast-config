<?php
/*
*
* (c) Marco Bunge <marco_bunge@web.de>
*
* For the full copyright and license information, please view the LICENSE.txt
* file that was distributed with this source code.
*
* Date: 25.10.2015
* Time: 17:12
*/

namespace Blast\Config\Loader;


use Puli\Repository\Api\Resource\FilesystemResource;

abstract class AbstractLoader implements LoaderInterface
{
    /**
     * Validate extension
     * @param FilesystemResource $resource
     * @return bool
     */
    public function validateExtension(FilesystemResource $resource)
    {
        return pathinfo($resource->getPath(), PATHINFO_EXTENSION) === $this->getExtension();
    }

    /**
     * Validate config. Config should be an arra
     * @param $config
     * @param bool $throw
     * @return bool
     */
    public function validateConfig($config)
    {
        return is_array($config);
    }
}
