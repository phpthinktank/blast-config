<?php
/*
*
* (c) Marco Bunge <marco_bunge@web.de>
*
* For the full copyright and license information, please view the LICENSE.txt
* file that was distributed with this source code.
*
* Date: 25.10.2015
* Time: 17:52
*/

namespace Blast\Config;


use Blast\Config\Loader\LoaderInterface;
use Puli\Repository\FilesystemRepository;

interface FactoryInterface
{
    /**
     * Create locator from repository. Repository could be a FilesystemRepository or a valid path
     * @param string|FilesystemRepository $repository
     * @return Locator
     */
    public function create($repository);

    /**
     * Load configuration from locator
     * @param string $path Path to configuration, relative to configured locator repository path e.g. /config/config.php
     * @param LocatorInterface $locator
     * @param LoaderInterface[] $loaders If is empty, PhpLoader and JsonLoader is loading by default
     * @param array $config Default configuration, overwrite by found config
     * @return array
     */
    public function load($path, LocatorInterface $locator, array $loaders = [], array $config = []);
}