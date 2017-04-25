<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools;

use Cp\ZendTools\Migrate\Console\MigrateCommand;
use Cp\ZendTools\Migrate\Console\MigrateCommandFactory;
use Cp\ZendTools\Migrate\Model\MigrateTable;
use Cp\ZendTools\Migrate\Model\MigrateTableFactory;

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
            'invokables' => [
                Domain::class => Domain::class,
            ],
        ];
    }


}