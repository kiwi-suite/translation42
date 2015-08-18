<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\I18n\Translator\Service;

use Translation42\I18n\Translator\DatabaseTranslationLoader;
use Translation42\TableGateway\TranslationTableGateway;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DatabaseTranslationLoaderFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return DatabaseTranslationLoader
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var TranslationTableGateway $tableGateway */
        $tableGateway = $serviceLocator->getServiceLocator()->get('TableGateway')->get('Translation42\Translation');
        return new DatabaseTranslationLoader($tableGateway);
    }
}
