<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\FormElements\Service;

use Zend\Form\Element\Select;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LocaleFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $localization = $serviceLocator->getServiceLocator()->get('Localization');

        $locales = $localization->getAvailableLocalesDisplay();

        $element = new Select();
        $element->setValueOptions($locales);

        return $element;
    }
}
