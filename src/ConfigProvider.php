<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools;

use Cp\ZendTools\MigrateConsole\MigrateCommand;
use Cp\ZendTools\MigrateConsole\MigrateCommandFactory;
use Cp\ZendTools\MigrateModel\MigrateTable;
use Cp\ZendTools\MigrateModel\MigrateTableFactory;

/**
 * Class ConfigProvider
 * @package Cp\ZendTools
 */
class ConfigProvider
{
    /**
     * Return configuration for this component.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'console' => $this->getConsoleCommands(),
        ];
    }

    /**
     * @return array
     */
    public function getConsoleCommands()
    {
        return [
            'commands' => [
                MigrateCommand::class
            ],
        ];
    }

    /**
     * Return dependency mappings for this component.
     *
     * @return array
     */
    public function getDependencyConfig()
    {
        return [
            'factories' => [
                MigrateCommand::class => MigrateCommandFactory::class,
                MigrateTable::class => MigrateTableFactory::class,

            ],
            'invokables' => [],
        ];
    }
}