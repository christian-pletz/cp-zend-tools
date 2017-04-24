<?php

namespace Cp\ZendTools\Migrate\Model;

use Symfony\Component\Console\Output\OutputInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\Pdo\Pdo;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\TableGateway;

/**
 * Class MigrateTable
 * @package Cp\ZendTools\Migrate\Model
 */
class MigrateTable
{

    /**
     * @var \Zend\Db\TableGateway\TableGateway
     */
    protected $tableGateway;

    /**
     * @var array
     */
    protected $version = [];

    /**
     * @param TableGateway $tableGateway
     */
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @return int
     */
    public function getVersion($module)
    {
        $version = null;

        try {
            $version = $this->tableGateway->select(function (Select $select) use ($module) {
                $select->where(['module' => $module]);
                $select->limit(1);
            })->current();

        } catch (\Exception $e) {
            /** @var Adapter $adapter */
            $adapter = $this->tableGateway->getAdapter();
            $adapter->query('CREATE TABLE `migrate` ( `module` TEXT, `version` INTEGER)', $adapter::QUERY_MODE_EXECUTE);
        }

        if (null == $version) {
            $this->tableGateway->insert(['version' => 0, 'module' => $module]);
            return 0;
        }

        return (int)$version['version'];
    }

    /**
     * @param int $version
     */
    public function setVersion($module, $version)
    {
        $this->tableGateway->update(['version' => $version], ['module' => $module]);
    }

    /**
     * @param $version
     * @param $callback
     */
    public function migrate($module, $callback, OutputInterface $output)
    {
        if (!isset($this->version[$module])) {
            $this->version[$module] = 1;
        }

        $version = $this->version[$module];

        if ($version > $this->getVersion($module)) {

            $output->writeln($module . ": Executing Migration " . $version);

            $sql = $this->tableGateway->getSql();
            $adapter = $sql->getAdapter();

            $callback($adapter);

            $this->setVersion($module, $version);
        }

        $version++;
        $this->version[$module] = $version;
    }

}