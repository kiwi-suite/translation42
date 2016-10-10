<?php

/*
 * translation42
 *
 * @package translation42
 * @link https://github.com/raum42/translation42
 * @copyright Copyright (c) 2010 - 2016 raum42 (https://www.raum42.at)
 * @license MIT License
 * @author raum42 <kiwi@raum42.at>
 */

namespace Translation42;

use Admin42\ModuleManager\Feature\AdminAwareModuleInterface;
use Admin42\ModuleManager\GetAdminConfigTrait;
use Core42\ModuleManager\GetConfigTrait;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements
    ConfigProviderInterface,
    DependencyIndicatorInterface,
    AdminAwareModuleInterface
{
    use GetConfigTrait;
    use GetAdminConfigTrait;

    /**
     * Expected to return an array of modules on which the current one depends on
     *
     * @return array
     */
    public function getModuleDependencies()
    {
        return [
            'Core42',
            'Admin42',
        ];
    }
}
