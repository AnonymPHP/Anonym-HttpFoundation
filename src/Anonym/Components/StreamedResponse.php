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

        /**
         * Sınıfın henüz gönderilip gönderilmediği tutulur
         *
         * @var bool
         */
        private $streamed;

        /**
         * Sınıfı başlatır ve çağrılabilir fonksiyonu kullanır
         *
         * @param callable $callback
         * @param int $statusCode
         */
        public function __construct(callable $callback = '', $statusCode = 200){
            parent::__construct('', $statusCode);
            $this->setCallback($callback);
            $this->setStreamed(false);

        }

        /**
         * @return callable
         */
        public function getCallback()
        {
            return $this->callback;
        }

        /**
         * @param callable $callback
         * @return StreamedResponse
         */
        public function setCallback(callable $callback)
        {
            $this->callback = $callback;

            return $this;
        }

        /**
         * @return boolean
         */
        public function isStreamed()
        {
            return $this->streamed;
        }

        /**
         * @param boolean $streamed
         * @return StreamedResponse
         */
        public function setStreamed($streamed)
        {
            $this->streamed = $streamed;

            return $this;
        }

        /**
         *  içeriği gönderir
         */
        public function send(){

            if($this->isStreamed()){
                return;
            }

            $this->setStreamed(true);
            call_user_func($this->getCallback());

        }
    }
