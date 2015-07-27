<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;
    use Anonym\Components\HttpClient\Server;

    /**
     * Class Request
     * @package Anonym\Components\HttpClient
     */
    class Request extends Server
    {


        /**
         * Sınıf çağrılırken kullanılan header bilgilerini tutar
         *
         * @var array
         */
        private $headers;

        /**
         * Sınıfı başlatır ve header bilgilerini atar
         */
        public function __construct(){


        }

        /**
         * Kullanıcının geldiği url i döndürür
         *
         * @return string
         */
        public function back(){
            return $this->referer;
        }


        /**
         * Kullanıcının şuanda aktif olarak buluğu url i döndürür
         *
         * @return string
         */
        public function url(){
            return $this->getUrl();
        }

        /**
         * Kullanıcının bulunduğu host u döndürür
         *
         * @return string
         */
        public function host(){
            return $this->host;
        }

        /**
         * @return array
         */
        public function getHeaders()
        {
            return $this->headers;
        }

        /**
         * @param array $headers
         * @return Request
         */
        public function setHeaders($headers)
        {
            $this->headers = $headers;

            return $this;
        }



    }
