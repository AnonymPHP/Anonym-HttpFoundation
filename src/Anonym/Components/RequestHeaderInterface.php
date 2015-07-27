<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;

    /**
     * Interface RequestHeaderInterface
     * @package Anonym\Components\HttpClient
     */
    interface RequestHeaderInterface
    {

        /**
         * Header bilgilerini döndürür
         *
         * @return array
         */
        public function getHeaders();


        /**
         * Header bilgilerini atar
         *
         * @param array $headers
         * @return Request
         */
        public function setHeaders($headers);
    }