<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Components\HttpClient;
    use Anonym\Components\Cookie\Http\CookieBag;
    use Anonym\Components\HttpClient\Server;

    /**
     * Class Request
     * @package Anonym\Components\HttpClient
     */
    class Request extends Server
    {

        /**
         *  gerekli method sabitleri
         *
         */
        const METHOD_HEAD = 'HEAD';
        const METHOD_GET = 'GET';
        const METHOD_POST = 'POST';
        const METHOD_PUT = 'PUT';
        const METHOD_PATCH = 'PATCH';
        const METHOD_DELETE = 'DELETE';
        const METHOD_PURGE = 'PURGE';
        const METHOD_OPTIONS = 'OPTIONS';
        const METHOD_TRACE = 'TRACE';
        const METHOD_CONNECT = 'CONNECT';
        /**
         * Sınıf çağrılırken kullanılan header bilgilerini tutar
         *
         * @var array
         */
        private $headers;

        /**
         * Cookileri döndürür
         *
         * @var array
         */
        private $cookies;

        /**
         * Sınıfı başlatır ve header bilgilerini atar
         */
        public function __construct(){

            $headers = (new RequestHeaders())->getHeaders();
            $this->setHeaders($headers);
            $this->setCookies( (new CookieBag())->getCookies());
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
         * @return array
         */
        public function getCookies()
        {
            return $this->cookies;
        }

        /**
         * @param array $cookies
         * @return Request
         */
        public function setCookies($cookies)
        {
            $this->cookies = $cookies;

            return $this;
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

        /**
         * Ana yolu dönderir
         *
         * @return string
         */
        public function findBaseUri(){
            return $this->findBasePath();
        }

        /**
         * $_FILES içinden değeri döndürür
         *
         * @param string $name
         * @return bool
         */
        public function file($name = ''){
            if (isset($_FILES[$name])) {
                return $_FILES[$name];
            }else{
                return false;
            }
        }
    }
