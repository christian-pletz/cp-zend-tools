<?php

namespace Cp\ZendTools\Migrate\Console;

use Cp\ZendTools\Migrate\Model\MigrateTable;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

/**
 * Class MigrateCommandFactory
 * @package Cp\ZendTools\Migrate\Console
 */
class MigrateCommandFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return MigrateCommand
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $migrateCommand = new MigrateCommand();
        $migrateCommand->setMigrations($container->get('config')['migrations']);
        $migrateCommand->setMigrateTable($container->get(MigrateTable::class));
        return $migrateCommand;
    }
}