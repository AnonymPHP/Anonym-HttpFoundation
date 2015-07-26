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
     * Interface ResponseInterface
     * @package Anonym\Components\HttpClient
     */
    interface ResponseInterface
    {
        /**
         * İçeriği gönderir
         *
         * @return bool
         */
        public function send();
    }