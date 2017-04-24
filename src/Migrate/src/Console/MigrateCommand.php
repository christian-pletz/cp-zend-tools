<?php

namespace Cp\ZendTools\MigrateConsole;

use Cp\ZendTools\MigrateModel\AbstractMigration;
use Cp\ZendTools\MigrateModel\MigrateTable;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class MigrateCommand
 * @package Cp\ZendTools\MigrateConsole
 */
class MigrateCommand extends Command
{
    /**
     * @var array
     */
    private $migrations;

    /**
     * @var MigrateTable
     */
    private $migrateTable;

    /**
     * @return array
     */
    public function getMigrations(): array
    {
        return $this->migrations;
    }

    /**
     * @param array $migrations
     */
    public function setMigrations(array $migrations)
    {
        $this->migrations = $migrations;
    }

    /**
     * @return MigrateTable
     */
    public function getMigrateTable(): MigrateTable
    {
        return $this->migrateTable;
    }

    /**
     * @param MigrateTable $migrateTable
     */
    public function setMigrateTable(MigrateTable $migrateTable)
    {
        $this->migrateTable = $migrateTable;
    }


    /**
     * Configures the command
     */
    protected function configure()
    {
        $this
            ->setName('migrate-database')
            ->setDescription('Migrates database');
    }

    /**
     * Executes the current command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->getMigrations() as $migration) {
            /** @var AbstractMigration $migration */
            $migration = new $migration;
            $migration->setMigrateTable($this->getMigrateTable());
            $migration->process($output);
        }
    }
}