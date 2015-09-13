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
     * Interface InputInterface
     * @package Anonym\Components\HttpClient
     */
    interface InputInterface
    {

        /**
         * Girilen dosya içeriğini döndürür
         *
         * @param string $name
         * @return mixed
         */
        public static function get($name);

        /**
         * Böyle bir girdi varmı yokmu diye kontrol eder
         *
         * @param null $name
         * @return mixed
         */
        public static function has($name = null);

        /**
         * $_POST içinde $name'e $value' i atar;
         *
         * @param string $name
         * @param mixed  $value
         */
        public static function set($name, $value);

        /**
         * $_GET içinden $name'in değerini siler
         *
         * @param string $name
         */
        public static function delete($name);


        /**
         * @return mixed
         *
         * Post verilerini döndürür
         */
        public static function getAll();
    }
