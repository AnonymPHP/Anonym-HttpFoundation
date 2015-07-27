<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;
    use Anonym\Components\HttpClient\Response;

    /**
     * Class StreamedResponse
     * @package Anonym\Components\HttpClient
     */
    class StreamedResponse extends Response
    {
        /**
         * Çağırlabilir fonksiyonu tutar
         *
         * @var callable
         */
        private $callback;

        public function __construct(callable $callback = '', $statusCode = 200){
            parent::__construct('', $statusCode);

        }



    }
