<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadır.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */

namespace Anonym\Components\HttpClient;
use Exception;

/**
 * the exception class of server variable exception
 *
 * Class ServerVariableException
 * @package Anonym\Components\HttpClient
 */
class ServerVariableException extends Exception
{

    /**
     * throw the exception
     *
     * @param string $message the message of exception
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}
