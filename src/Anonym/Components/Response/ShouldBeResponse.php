<?php

    /**
     *  Bu interface AnonymFramework 'Route Manager ve response arasındaki ilişikiyi sağlamakta kullanılır

     */
    namespace Anonym\Components\HttpClient\Response;

    /**
     * Interface ShouldBeResponse
     *
     * @package Anonym\Components\HttpClient\Response
     */
    interface ShouldBeResponse
    {
        /**
         *
         * @return mixed
         */
        public function send();
    }
