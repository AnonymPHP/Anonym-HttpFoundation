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
     * Class Server
     * @package Anonym\Components\HttpClient
     */
    class Server
    {

        /**
         * the address of this script
         *
         * @var string
         */
        public $url;

        /**
         * the http headers list
         *
         * @var array
         */
        public $serverFilters = [
            'useragent' => 'HTTP_USER_AGENT',
            'referer' => 'HTTP_REFERER',
            'host' => 'HTTP_HOST',
            'reditect' => 'REDIRECT_URL',
            'serverip' => 'SERVER_ADDR',
            'userip' => 'REMOTE_ADDR',
            'uri' => 'REQUEST_URI',
            'method' => 'REQUEST_METHOD',
            'protocol' => 'SERVER_PROTOCOL'
        ];

        /**
         * return the current request method
         *
         * @return string
         */
        public function getMethod()
        {
            return $this->method;
        }

        /**
         * return the all server variables
         *
         * @return array
         */
        public function getServer(){
            return $_SERVER;
        }
        /**
         * get the variable in server
         *
         * @param string $name
         * @return string
         */
        public function get($name = 'HTTP_HOST')
        {
            if (isset($_SERVER[$name])) {
                return $_SERVER[$name];
            }else{
                return false;
            }
        }
        /**
         * return the url
         *
         * @return string
         */
        public function getUrl()
        {
            if($path = $this->get('PATH_TRANSLATED'))
            {
                $url = str_replace($this->get('DOCUMENT_ROOT'),'', $path);
            }else{
                $script = ($this->get('PHP_SELF') !== null) ? $this->get('PHP_SELF'):$this->get('SCRIPT_NAME');
                $script = str_replace('index.php','', $script);
                $url = str_replace($script, '', $this->uri);
            }

            $this->url = $url;

            return $url;
        }
        /**
         * get the server variable
         *
         * @param string $name the name of variable
         * @throws ServerVariableException
         * @return string
         */
        public function __get($name)
        {
            if (isset($this->serverFilters[$name])) {
                if (isset($_SERVER[$this->serverFilters[$name]])) {
                    return $_SERVER[$this->serverFilters[$name]];
                } else {
                    return false;
                }
            } else {
                $big = mb_convert_case($name, MB_CASE_UPPER, 'UTF-8');
                if (isset($_SERVER[$big])) {
                    return $_SERVER[$big];
                } else {
                    throw new ServerVariableException(sprintf("%s adında bir değişken bulunamadı", $name));
                }
            }
        }

        /**
         * Sayfanın yürütüldüğü url 'i bulur
         * @return string
         */
        public function findBasePath()
        {
            $type = $this->get('REQUEST_SCHEME');
            return sprintf("%s::%s%s", $type, $this->host, $this->uri);
        }

        /**
         * Kullanıcının ip adresini döndürür
         *
         * @return string
         */
        public function getIP()
        {
            if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ',')) {
                    $tmp = explode(',', $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }

            return $ip;
        }

        /**
         * @return array
         */
        public function getServerFilters()
        {
            return $this->serverFilters;
        }

        /**
         * @param array $serverFilters
         * @return Server
         */
        public function setServerFilters(array $serverFilters)
        {
            $this->serverFilters = $serverFilters;

            return $this;
        }
    }
