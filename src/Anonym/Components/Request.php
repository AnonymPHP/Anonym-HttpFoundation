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
         * Kullanıcının geldiği url i döndürür
         *
         * @return string
         */
        public function back(){
            return $this->referer;
        }

    }
