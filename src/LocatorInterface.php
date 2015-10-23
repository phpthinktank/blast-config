<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 22.10.2015
 * Time: 15:16
 */

namespace Blast\Config;

use Puli\Repository\Api\Resource\FilesystemResource;
use Puli\Repository\FilesystemRepository;

interface LocatorInterface
{
    /**
     * Create locator by assign a repository instance
     * @param FilesystemRepository $repository
     */
    public function __construct(FilesystemRepository $repository);

    /**
     * Locate config files from path.
     * @param $path
     * @return FilesystemResource
     */
    public function locate($path);

}