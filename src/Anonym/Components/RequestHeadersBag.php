<?php
    /**
     *  AnonymFramework Request Kısmında yapılan headersları toplar.
     *  Ayrıca cookie kısmlarınıda parçalar
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     */

    namespace Anonym\Components\HttpClient;

    /**
     * Class RequestHeadersBag
     *
     * @package Anonym\Components\HttpClient
     */

    class RequestHeadersBag
    {

        protected $headers;
        private $server;

        public function __construct()
        {

            $this->headers = getallheaders();
            $this->server = $_SERVER;
        }

        /**
         * Server verilerini döndürür
         *
         * @return mixed
         */
        public function getServer()
        {

            return $this->server;
        }

        /**
         * Header'ları ekler
         *
         * @return mixed
         */
        public function getHeaders()
        {

            return $this->headers;
        }
    }
