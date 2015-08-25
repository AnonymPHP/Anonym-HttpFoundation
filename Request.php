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
use Anonym\Components\Upload\FileUpload;

/**
 * the class of request
 *
 * Class Request
 * @package Anonym\Components\HttpClient
 */
class Request implements RequestHeaderInterface, ReposityInterface
{

    /**
     * the instance of response
     *
     * @var Response
     */
    private $response;


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
     * the http headers list
     *
     * @var array
     */
    private $references = [
        'useragent' => 'HTTP_USER_AGENT',
        'referer'   => 'HTTP_REFERER',
        'host'      => 'HTTP_HOST',
        'reditect'  => 'REDIRECT_URL',
        'serverip'  => 'SERVER_ADDR',
        'userip'    => 'REMOTE_ADDR',
        'uri'       => 'REQUEST_URI',
        'method'    => 'REQUEST_METHOD',
        'protocol'  => 'SERVER_PROTOCOL',
        'port'      => 'SERVER_PORT',
        'scheme'    => 'REQUEST_SCHEME',
    ];

    /**
     * the url
     *
     * @var string
     */
    private $url;

    /**
     * Sınıfı başlatır ve header bilgilerini atar
     */
    public function __construct()
    {

        $headers = (new ServerHttpHeaders())->getHeaders();
        $this->setHeaders($headers);
        $this->setCookies((new CookieBag())->getCookies());
        $this->setResponse(new Response());
        $this->resolveQueryUrl();

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

    /**
     * upload a file
     *
     * @param string $name
     * @param string $uploadDir
     * @throws FileNotUploadedException
     * @return FileUpload
     */
    public function file($name = '', $uploadDir = UPLOAD)
    {
        if (isset($_FILES[$name])) {
            $file = new FileUpload($_FILES[$name], $uploadDir);
            return $file;
        } else {
            throw new FileNotUploadedException(sprintf('Your %s file is not uploaded yet', $name));
        }
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
        } else {
            return false;
        }
    }


    /**
     * return the user ip
     *
     * @return string
     */
    public function ip()
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
     * add a new header
     *
     * @param string $name the name of header
     * @param string $value the value of header
     * @return $this
     */
    public function header($name, $value = '')
    {
        $this->getResponse()->header($name, $value);
        return $this;
    }

    /**
     * return the current request method
     *
     * @return string
     */
    public function method()
    {
        return $this->method;
    }


    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * resolve the url
     */
    private function resolveQueryUrl()
    {

    }


    /**
     * get the port
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * get the host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }


    public function getScheme()
    {
        return $this->
    }

    /**
     * get the http host
     *
     * example : localhost
     * example : localhot:443
     *
     * @return string
     */
    public function getHttpHost()
    {
        $scheme = $this->get('REQUEST_SCHEME');
        $port = $this->getPort();

        if ('http' === $scheme && $port === 80 || 'https' === $scheme && $port === 443) {
            return $this->getHost();
        }

        return $this->getHost() . ':' . $port;
    }


    public function getSchemeAndHost()
    {
        $host = $this->getHost();
        $scheme = $this->get('REQUEST_SCHEME');

    }

    /**
     * @param string $url
     * @return Request
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
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
        if (isset($this->references[$name])) {

            $reference = $this->references[$name];
            return $this->get($reference) ? $this->get($reference) : false;
        } else {
            $big = mb_convert_case($name, MB_CASE_UPPER, 'UTF-8');
            if ($get = $this->get($big)) {
                return $get;
            } else {
                throw new ServerVariableException(sprintf("%s Not found!", $name));
            }
        }
    }
}
