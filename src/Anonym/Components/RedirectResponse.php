<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;
    use Anonym\Components\HttpClient\RedirectUrlEmptyException;

    /**
     * Class Redirect
     * @package Anonym\Components\HttpClient
     */
    class Redirect extends Response
    {

        /**
         * Yönlendirme için beklenecek zaman
         *
         * @var integer
         */
        private $time;
        /**
         * Yönlendirilecek url i atar
         *
         * @var string
         */
        private $target;

        /**
         * Yönlendirme işlemi yapar
         *
         * @param string  $adress
         * @param integer $time
         * @throws RedirectUrlEmptyException
         */
        public function __construct($adress = '', $time = 0)
        {

            if($adress === ''){
                throw new RedirectUrlEmptyException('Yönlendirilecek url boş olamaz');
            }

            parent::__construct();
            $this->setTarget($adress);
            $this->setTime($time);
        }
        /**
         *  Eski sayfaya geri döndürür
         */
        public function back()
        {
            self::to($_SERVER['HTTP_REFERER']);
        }

        /**
         * @return string
         */
        public function getTarget()
        {
            return $this->target;
        }

        /**
         * @param string $target
         * @return Redirect
         */
        public function setTarget($target)
        {
            $this->target = $target;

            return $this;
        }

        /**
         * @return int
         */
        public function getTime()
        {
            return $this->time;
        }

        /**
         * @param int $time
         * @return Redirect
         */
        public function setTime($time)
        {
            $this->time = $time;

            return $this;
        }


        /**
         * Yönlendirme işlemini yapar
         *
         * @throws HttpResponseException
         */
        public function send(){

            $time = $this->getTime();
            $target = $this->getTarget();
            if($time === 0)
            {
                $this->header("Location", $target);
            }else{
                $this->header(sprintf('Refresh:%d, url=%s', $time, $target));
            }

            $this->send();
        }

        /**
         * Static olarak içeriği oluşturur
         *
         * @param string $target
         * @param int $time
         * @return static
         */
        public static function create($target = '', $time = 0)
        {
            return new static($target, $time);
        }
    }
