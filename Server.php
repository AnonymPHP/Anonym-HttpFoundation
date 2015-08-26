<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */

namespace Anonym\Components\HttpClient;


class Server
{

    /**
     * the http headers list
     *
     * @var array
     */
    private $references = [
        'useragent' => 'HTTP_USER_AGENT',
        'referer'   => 'HTTP_REFERER',
        'host'      => 'HTTP_HOST',
        'reditect'  => 'REDIRECT_URL',
        'serverip'  => 'SERVER_ADDR',
        'userip'    => 'REMOTE_ADDR',
        'uri'       => 'REQUEST_URI',
        'method'    => 'REQUEST_METHOD',
        'protocol'  => 'SERVER_PROTOCOL',
        'port'      => 'SERVER_PORT',
        'scheme'    => 'REQUEST_SCHEME',
    ];

    /**
     * get the variable in server
     *
     * @param string $name
     * @return string
     */
    public function get($name = 'HTTP_HOST')
    {
        if (isset($_SERVER[$name])) {
            return $_SERVER[$name];
        } else {
            return null;
        }
    }


    public function add($name = '', $value = '')
    {

    }
}