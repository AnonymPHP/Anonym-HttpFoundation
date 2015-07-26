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

    class HttpResponseException extends Exception
    {

        public function __construct($message = '')
        {
            $this->message = $message;
        }
    }