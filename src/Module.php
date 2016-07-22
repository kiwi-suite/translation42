<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42;

use Admin42\ModuleManager\Feature\AdminAwareModuleInterface;
use Translation42\FormElements\Service\LocaleFactory;
use Translation42\FormElements\Service\TextDomainFactory;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

class Module implements
    ConfigProviderInterface,
    DependencyIndicatorInterface,
    AdminAwareModuleInterface
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return array_merge(
            include __DIR__.'/../config/cli.config.php',
            include __DIR__.'/../config/module.config.php',
            include __DIR__.'/../config/navigation.config.php',
            include __DIR__.'/../config/routing.config.php',
            include __DIR__.'/../config/translation.config.php'
        );
    }

    /**
     * Expected to return an array of modules on which the current one depends on
     *
     * @return array
     */
    public function getModuleDependencies()
    {
        return [
            'Core42',
            'Admin42'
        ];
    }

    /**
     * @return array
     */
    public function getAdminStylesheets()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAdminJavascript()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAdminViewHelpers()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAdminFormElements()
    {
        return [
            'factories' => [
                'locale'      => LocaleFactory::class,
                'text_domain' => TextDomainFactory::class,
            ],
        ];
    }
}
