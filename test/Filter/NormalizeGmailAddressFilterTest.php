<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace CpTest\ZendTools\Filter;

use Cp\ZendTools\Filter\NormalizeGmailAddressFilter;
use PHPUnit\Framework\TestCase;

/**
 * Class NormalizeGmailAddressFilterTest
 *
 * @package CpTest\ZendTools\Filter
 */
class NormalizeGmailAddressFilterTest extends TestCase
{
    /**
     * @var NormalizeGmailAddressFilter
     */
    private $handle;

    protected function setUp()
    {
        $this->handle = new NormalizeGmailAddressFilter();
    }

    protected function tearDown()
    {
        unset($this->handle);
    }

    public function testFilterProvider()
    {
        return [
            ['Max.Mustermann@googlemail.com', 'maxmustermann@gmail.com'],
            ['max.mustermann+Dk289sdf@googlemail.com', 'maxmustermann@gmail.com'],
            ['Max.Mustermann@gmail.com', 'maxmustermann@gmail.com'],
            ['max.mustermann+Dk289sdf@gmail.com', 'maxmustermann@gmail.com'],
        ];
    }

    /**
     * @dataProvider testFilterProvider
     */
    public function testFilter($value, $expected)
    {
        $this->assertSame($expected, $this->handle->filter($value));
    }
}