<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools\Model\Storage\Db;

use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Hydrator;

/**
 * Class AbstractDbStorage
 * @package Cp\Model\Storage\Db
 */
abstract class AbstractDbStorage
{
    /**
     * Table gateway
     *
     * @var TableGatewayInterface
     */
    private $tableGateway;

    /**
     * Hydrator
     *
     * @var Hydrator\ClassMethods
     */
    private $hydrator;

    /**
     * @return \Zend\Db\TableGateway\TableGateway
     */
    public function getTableGateway(): TableGatewayInterface
    {
        return $this->tableGateway;
    }

    /**
     * @return Hydrator\ClassMethods
     */
    public function getHydrator(): Hydrator\ClassMethods
    {
        return $this->hydrator;
    }

    /**
     * UserDbStorage constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;

        $resultSetPrototype = $this->tableGateway->getResultSetPrototype();

        if ($resultSetPrototype instanceof HydratingResultSet) {
            $this->hydrator = $resultSetPrototype->getHydrator();
        }

    }
}