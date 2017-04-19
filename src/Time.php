<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools;

/**
 * Class Time
 * @package Cp\ZendTools
 */
class Time
{
    /**
     * One hour in seconds
     */
    const ONE_HOUR = 3600;

    /**
     *  One day in seconds
     */
    const ONE_DAY = self::ONE_HOUR * 24;

    /**
     * One week in seconds
     */
    const ONE_WEEK = self::ONE_DAY * 7;

    /**
     * Current timestamp
     *
     * @var int|null
     */
    private static $now = null;

    /**
     * Returns the current timestamp
     *
     * @return int The current timestamp
     */
    public static function now()
    {
        if (!self::$now) {
            self::$now = time();
        }

        return self::$now;
    }

    /**
     * Returns the timestamp of the start of a year
     *
     * @param int $year The year from which the timstamp should be created
     * @return int The timestamp of the start of year
     */
    public static function getTimestampYearStart(int $year): int
    {
        return strtotime($year . '-01-01 00:00:00');
    }

    /**
     * Returns the timestamp of the end of a year
     *
     * @param int $year The year from which the timstamp should be created
     * @return int The timestamp of the end of year
     */
    public static function getTimestampYearEnd(int $year): int
    {
        return strtotime($year . '-12-31 23:59:59');
    }

    /**
     * Returns the timestamp of the start of a month
     *
     * @param int $year The year from which the timestamp should be created
     * @param int $month The month from which the timestamp should be created
     * @return int The timestamp of the start of month
     */
    public static function getTimestampMonthStart(int $year, int $month): int
    {
        return strtotime($year . '-' . $month . '-01 00:00:00');
    }

    /**
     * Returns the timestamp of the end of a month
     *
     * @param int $year The year from which the timestamp should be created
     * @param int $month The month from which the timestamp should be created
     * @return int The timestamp of the end of month
     */
    public static function getTimestampMonthEnd(int $year, int $month): int
    {
        if ($month == 12) {
            $month = 1;
            $year += 1;
        } else {
            $month += 1;
        }

        return self::getTimestampMonthStart($year, $month) - 1;
    }

    /**
     * Checks whether the given year is the current year
     *
     * @param int $year The year to check
     * @return bool true, if whether the given year is the current year
     */
    public static function getIsCurrentYear(int $year): bool
    {
        return $year == date('Y');
    }

    /**
     * Returns the current month
     *
     * @return int The current month
     */
    public static function getCurrentMonth(): int
    {
        return (int)date('m');
    }
}