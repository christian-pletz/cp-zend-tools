<?php

namespace Migrate;

use Cp\ZendTools\MigrateConsole\MigrateCommand;
use Cp\ZendTools\MigrateConsole\MigrateCommandFactory;
use Cp\ZendTools\MigrateModel\MigrateTable;
use Cp\ZendTools\MigrateModel\MigrateTableFactory;

define('MIGRATE_ROOT', __DIR__ . '/..');

/**
 * Class ConfigProvider
 * @package Migrate
 */
class ConfigProvider
{
    /**
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
     * @return array
     */
    public function getDependencyConfig()
    {
        return [
            'factories' => [
                MigrateCommand::class => MigrateCommandFactory::class,
                MigrateTable::class => MigrateTableFactory::class,
            ],
        ];
    }
}