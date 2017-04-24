<?php

namespace Cp\ZendTools\Migrate\Model;


use Cp\ZendTools\Migrate\Model\Exception\RuntimeException;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AbstractMigration
 * @package Cp\ZendTools\Migrate\Model
 */
abstract class AbstractMigration
{

    /**
     * @var MigrateTable
     */
    private $migrateTable;

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

    protected function getModuleName()
    {
        $namespace = explode('\\', get_class($this));
        return $namespace[0];
    }

    /**
     * @param string $file
     * @return string
     */
    protected function loadFile($file)
    {

        $sqlDir = getcwd() . '/modules/' . $this->getModuleName() . '/migrations';
        $file = $sqlDir . '/' . $file;

        if (!file_exists($file)) {
            throw new RuntimeException('File not found ' . $file);
        }

        return file_get_contents($file);
    }

    /**
     * @param \Closure $closure
     */
    protected function migrate(\Closure $closure, OutputInterface $output)
    {
        $this->migrateTable->migrate($this->getModuleName(), $closure, $output);
    }

    abstract public function process(OutputInterface $output);
}