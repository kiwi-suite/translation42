<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\I18n\Translator\Service;

use Translation42\I18n\Translator\DatabaseTranslationLoader;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DatabaseTranslationLoaderFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // TODO: tablegateway
        $db = $serviceLocator->getServiceLocator()->get('DB/Master');

        return new DatabaseTranslationLoader($db);
    }
}
