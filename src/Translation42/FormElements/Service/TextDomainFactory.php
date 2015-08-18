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

class TextDomainFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('Config');

        $remoteTranslations = $config['translator']['remote_translation'];

        $textDomains = [];
        if (count($remoteTranslations) > 0) {
            foreach ($remoteTranslations as $textDomain) {
                $textDomains[$textDomain['text_domain']] = $textDomain['display_name'];
            }
        }

        $element = new Select();
        $element->setValueOptions($textDomains);

        return $element;
    }
}
