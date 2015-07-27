<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;


    interface RequestHeadersInterface
    {
        /**
         * Header'ları ekler
         *
         * @return array
         */
        public function getHeaders();

        /**
         * Server verilerini döndürür
         *
         * @return array
         */
        public function getServer();

    }
