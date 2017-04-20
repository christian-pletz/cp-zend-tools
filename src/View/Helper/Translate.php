<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools\View\Helper;

use Zend\I18n\View\Helper\Translate as ZendTranslateHelper;

/**
 * Class Translate
 * @package Cp\ZendTools\View\Helper
 */
class Translate extends ZendTranslateHelper
{
    /**
     * Default translate params
     *
     * @var array
     */
    private $defaultTranslateParams = [];

    /**
     * Translate constructor
     */
    public function __construct(array $defaultTranslateParams = null)
    {
        if (is_array($defaultTranslateParams)) {
            $this->defaultTranslateParams = $defaultTranslateParams;
        }
    }


    /**
     * Translate a message
     *
     * @param  string $message
     * @param  string $textDomain
     * @param  string $locale
     * @throws Exception\RuntimeException
     * @return string
     */
    public function __invoke($message, $params = array(), $textDomain = null, $locale = null)
    {
        $translation = parent::__invoke($message, $textDomain, $locale);

        if (is_array($params)) {
            $params = $params + $this->defaultTranslateParams;
        }

        if (is_array($params) && count($params) > 0) {
            foreach ($params as $key => $value) {
                $translation = str_replace('%' . $key . '%', $value, $translation);
            }
        }

        return $translation;
    }
}