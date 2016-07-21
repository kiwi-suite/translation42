<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\FormElements\Service;

use Core42\I18n\Localization\Localization;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Form\Element\Select;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class LocaleFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $localization = $container->get(Localization::class);

        $locales = $localization->getAvailableLocalesDisplay();

        $element = new Select();
        $element->setValueOptions($locales);

        return $element;
    }
}
