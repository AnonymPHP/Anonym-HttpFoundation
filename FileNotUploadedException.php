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

class FileNotUploadedException extends Exception
{

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }
}