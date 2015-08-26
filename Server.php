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

/**
 * Class Server
 * @package Anonym\Components\HttpClient
 */
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
     * @throws ServerVariableException
     * @return string
     */
    public function get($name = 'HTTP_HOST')
    {
        if (isset($this->references[$name])) {
            $return =  isset($this->references[$name]) ? $_SERVER[$this->references[$name]]: null;
        } else {
            $big = mb_convert_case($name, MB_CASE_UPPER, 'UTF-8');
            if (isset($_SERVER[$big])) {
                $return =  $_SERVER[$big];
            } else {
                throw new ServerVariableException(sprintf("%s Not found!", $name));
            }
        }

        return $return === '' ? null : $return;
    }


    /**
     * remova a server variable
     *
     * @param string $name
     * @return $this
     */
    public function remove($name = '')
    {
        if(isset($_SERVER[$name])){
            unset($_SERVER[$name]);
        }

        return $this;
    }

    /**
     * add a new variable
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function add($name = '', $value = '')
    {
        $_SERVER[$name] = $value;
        return $this;
    }
}