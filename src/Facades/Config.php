<?php
/**
 * Created by PhpStorm.
 * User: Marco Bunge
 * Date: 22.10.2015
 * Time: 15:53
 */

namespace Blast\Config\Facades;


use Blast\Config\FactoryInterface;
use Blast\Facades\AbstractFacade;

class Config extends AbstractFacade
{
    protected static function accessor()
    {
        return FactoryInterface::class;
    }
}