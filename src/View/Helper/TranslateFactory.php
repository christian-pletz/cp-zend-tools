<?php

namespace Cp\ZendTools\View\Helper;

use Zend\Authentication\AuthenticationServiceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\I18n\Translator\Translator;

/**
 * Class TranslateFactory
 * @package Cp\ZendTools\View\Helper
 */
class TranslateFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return Translate
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $translateConfig = null;

        $config = $container->get('config');

        if (isset($config['cp_zendtools_translate'], $config['cp_zendtools_translate']['defaultParams'])) {
            $translateConfig = $config['cp_zendtools_translate']['defaultParams'];
        }

        $translate = new Translate($translateConfig);
        $translate->setTranslator($container->get(Translator::class));

        return $translate;
    }
}