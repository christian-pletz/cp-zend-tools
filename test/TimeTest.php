<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace CpTest\ZendTools;

use Cp\ZendTools\Time;

use PHPUnit\Framework\TestCase;

/**
 * Class TimeTest
 * @package CpTest\ZendTools
 */
class TimeTest extends TestCase
{
    /**
     * @var TimeTestTestable
     */
    private $handle;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->handle = new TimeTestTestable();
        parent::setUp();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->handle);
        parent::tearDown();
    }

    public function testNow()
    {
        $this->assertSame(time(), $this->handle->now());
    }

    public function testGetTimestampYearStart()
    {
        $this->assertSame(1483225200, $this->handle->getTimestampYearStart());
    }

    public function testGetTimestampYearEnd()
    {
        $this->assertSame(1514761199, $this->handle->getTimestampYearEnd());
    }

    public function testGetTimestampMonthStart()
    {
        $this->assertSame(1485903600, $this->handle->getTimestampMonthStart());
    }

    public function testGetTimestampMonthEnd()
    {
        $this->assertSame(1488322799, $this->handle->getTimestampMonthEnd());
    }
}

class TimeTestTestable
{
    public function now()
    {
        return Time::now();
    }

    public function getTimestampYearStart()
    {
        return Time::getTimestampYearStart(2017);
    }

    public function getTimestampYearEnd()
    {
        return Time::getTimestampYearEnd(2017);
    }

    public function getTimestampMonthStart()
    {
        return Time::getTimestampMonthStart(2017, 2);
    }

    public function getTimestampMonthEnd()
    {
        return Time::getTimestampMonthEnd(2017, 2);
    }
}