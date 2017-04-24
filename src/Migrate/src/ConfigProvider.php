<?php

namespace Cp\ZendTools\Migrate;

use Cp\ZendTools\Migrate\Console\MigrateCommand;
use Cp\ZendTools\Migrate\Console\MigrateCommandFactory;
use Cp\ZendTools\Migrate\Model\MigrateTable;
use Cp\ZendTools\Migrate\Model\MigrateTableFactory;

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