<?php
/**
 * @author      Christian Pletz <info@christian-pletz.de>
 * @copyright   Copyright (c) 2017 Christian Pletz
 */

/**
 * namespace definition and usage
 */

namespace Cp\ZendTools;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class Time
 * @package Cp\ZendTools
 */
class Domain
{
    /**
     * @var ServerRequestInterface
     */
    private $request;

    /**
     * @return ServerRequestInterface
     */
    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function setRequest(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @param array $serverParams
     * @return string
     * @throws \Exception
     */
    public function getDomainWithProtocol(): string
    {
        if (!$this->request) {
            throw new \Exception('request not set. Please call the method Domain::setRequest first.');
        }

        $uri = new \Zend\Uri\Uri($this->request->getUri()->__toString());
        $path = $uri->getPath();

        $uri->setPath($path);
        $uri->setQuery(array());
        $uri->setFragment('');

        $port = '';
        if (!in_array($uri->getPort(), [80, 443])) {
            $port = ':' . $uri->getPort();
        }

        return $uri->getScheme() . '://' . $uri->getHost() . $port;
    }
}