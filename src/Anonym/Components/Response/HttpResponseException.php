<?php
    namespace Anonym\Components\HttpClient\Response;
    use Exception;
    class HttpResponseException extends Exception
    {
        public function __construct($message = '')
        {
            $this->message = $message;
        }
    }