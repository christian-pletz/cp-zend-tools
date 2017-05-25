<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools\Filter;

use Zend\Filter\AbstractFilter;

/**
 * Class NormalizeGmailAddressFilter
 *
 * @package Cp\ZendTools\Filter
 */
class NormalizeGmailAddressFilter extends AbstractFilter
{
    /**
     * Valid gmail domains
     *
     * @var array
     */
    protected $domains
        = array(
            'gmail.com',
            'googlemail.com'
        );

    /**
     * Normalize gmail email address
     *
     * @param mixed $value
     *
     * @return array|mixed|string
     */
    public function filter($value)
    {
        $value = mb_strtolower($value);

        foreach ($this->domains as $domain) {
            if (substr_count($value, $domain)) {
                // remove +abc
                $value = preg_replace('/\+.*(@)/i', '\\1', $value);
                $value = explode('@', $value);
                // remove dots
                $value[0] = str_replace('.', '', $value[0]);
                $value    = implode('@', $value);
                // set default domain gmail.com
                $value = str_replace('@' . $domain, '@gmail.com', $value);
            }
        }

        return $value;
    }


}