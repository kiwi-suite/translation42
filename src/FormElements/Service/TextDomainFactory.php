<?php
/**
 * translation42 (www.raum42.at)
 *
 * @link      http://www.raum42.at
 * @copyright Copyright (c) 2010-2015 raum42 OG (http://www.raum42.at)
 *
 */

namespace Translation42\FormElements\Service;

use Admin42\FormElements\Select;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class TextDomainFactory implements FactoryInterface
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
        $config = $container->get('Config');

        $remoteTranslations = $config['translator']['remote_translation'];

        $textDomains = [];
        if (count($remoteTranslations) > 0) {
            foreach ($remoteTranslations as $textDomain) {
                $textDomains[$textDomain['text_domain']] = $textDomain['display_name'];
            }
        }

        $element = $container->get('FormElementManager')->get(Select::class);
        $element->setValueOptions($textDomains);

        return $element;
    }
}
