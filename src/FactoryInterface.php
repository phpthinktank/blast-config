<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 22.10.2015
 * Time: 15:48
 */

namespace Blast\Config;


use Blast\Config\Transformers\TransformerInterface;
use Puli\Repository\FilesystemRepository;

interface FactoryInterface
{
    /**
     * Add a transformer
     * @param TransformerInterface $transformer
     * @return FactoryInterface
     */
    public function addTransformer(TransformerInterface $transformer);

    /**
     * Add a locator
     * @param LocatorInterface $locator
     * @return FactoryInterface
     */
    public function addLocator(LocatorInterface $locator);

    /**
     * Create a new merged config array from locations in repository
     * @param FilesystemRepository $repository
     * @param array $locations
     * @return mixed
     */
    public function create(FilesystemRepository $repository, array $locations = []);

}