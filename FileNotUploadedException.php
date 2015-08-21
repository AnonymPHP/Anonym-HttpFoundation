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
use Exception;

/**
 * Class FileNotUploadedException
 * @package Anonym\Components\HttpClient
 */
class FileNotUploadedException extends Exception
{

    /**
     * throw the new exception
     *
     * @param string $message the message of exception
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}