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
    use Anonym\Components\Cookie\ReposityInterface;
    use Anonym\Components\HttpClient\Server;
    use Anonym\Components\HttpClient\ServerHttpHeaders;

    /**
     * the class of request
     *
     * Class Request
     * @package Anonym\Components\HttpClient
     */
    class Request extends Server implements RequestHeaderInterface, ReposityInterface
    {

        /**
         * the instance of response
         *
         * @var Response
         */
        private $response;
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

            $headers = (new ServerHttpHeaders())->getHeaders();
            $this->setHeaders($headers);
            $this->setCookies( (new CookieBag())->getCookies());
            $this->setResponse( new Response());
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
         * Kullanıcının giriş yaptığı aygıtın bilgilerini döndürür
         *
         * @return string
         */
        public function useragent(){
            return $this->useragent;
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
         * Header bilgilerini döndürür
         *
         * @return array
         */
        public function getHeaders()
        {
            return $this->headers;
        }

        /**
         * Header bilgilerini atar
         *
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
         * return the registered response instance
         *
         * @return Response
         */
        public function getResponse()
        {
            return $this->response;
        }

        /**
         * register the response instance
         *
         * @param Response $response the instance of response
         * @return Request return $this
         */
        public function setResponse(Response $response)
        {
            $this->response = $response;
            return $this;
        }


    }
