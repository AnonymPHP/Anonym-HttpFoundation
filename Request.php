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
use Anonym\Components\Security\Validation as Validate;

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
     * the instance of server
     *
     * @var Server
     */
    private $server;

    /**
     *
     *
     * @var array
     */
    private $segments;

    /**
     * @var Validate
     */
    private $validate;
    /**
     * Sınıfı başlatır ve header bilgilerini atar
     */
    public function __construct(Validate $validation = null)
    {

        $headers = (new ServerHttpHeaders())->getHeaders();
        $this->setHeaders($headers);
        $this->setCookies((new CookieBag())->getCookies());
        $this->setResponse(new Response());
        $this->setServer(new Server());
        $this->setValidate($validation);
        $this->segments = explode('/', $this->getUrl());

    }

    /**
     * @return array
     */
    public function getSegments()
    {
        return $this->segments;
    }

    /**
     * @param array $segments
     * @return Request
     */
    public function setSegments($segments)
    {
        $this->segments = $segments;
        return $this;
    }

    /**
     * @return Validate
     */
    public function getValidate()
    {
        return $this->validate;
    }

    /**
     * @param Validate $validate
     * @return Request
     */
    public function setValidate(Validate $validate = null)
    {
        $this->validate = $validate;
        return $this;
    }



    /**
     * @return \Anonym\Components\HttpClient\Server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * register the server instance
     *
     * @param \Anonym\Components\HttpClient\Server $server
     * @return Request
     */
    public function setServer(Server $server)
    {
        $this->server = $server;
        return $this;
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
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * find and return called url
     *
     * @return string
     */
    public function getUrl()
    {
        if(null !== $path = $this->server->get('PATH_INFO')){
            return $path;
        }

        return '';
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


    /**
     * get the request scheme
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }


    /**
     * get the http referer
     *
     * @return string
     */
    public function back(){
        return $this->referer;
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
        $scheme = $this->getScheme();
        $port = $this->getPort();

        if ('http' === $scheme && $port === '80' || 'https' === $scheme && $port === '443') {
            return $this->getHost();
        }

        return $this->getHost() . ':' . $port;
    }

    /**
     * get the query string
     *
     * @return string
     */
    public function getQueryString()
    {
        return $this->server->get('QUERY_STRING');
    }

    /**
     * get the request uri
     *
     *
     * @return string
     */
    public function getRequestUri()
    {
        return $this->uri;
    }

    /**
     * find the scheme and request uri
     *
     * @return string
     */
    public function getBaseUri()
    {
        if (null !== $qs = $this->getQueryString()) {
            $qs = '?' . $qs;
        }

        return $this->getSchemeAndHost() . $this->getRequestUri() . $qs;
    }

    /**
     * check the url
     *
     * @param string $url
     * @return bool
     */
    public function isAvailableUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }


    /**
     * get all input variables
     *
     * @return mixed
     */
    public function all()
    {
        return Input::getAll();
    }
    /**
     * set the default php locale
     *
     * @param string $locale
     * @return $this
     */
    public function setDefaultLocale($locale)
    {
        try {
            if (class_exists('Locale', false)) {
                \Locale::setDefault($locale);
            }
        } catch (\Exception $e) {
        }
    }

    /**
     * get the scheme and host url
     *
     * @return string
     */
    public function getSchemeAndHost()
    {
        return $this->getScheme() . '://' . $this->getHttpHost();
    }

    /**
     * get url segment
     *
     * @param int $segment
     * @return string|bool
     */
    public function segment($segment){
        $segments = $this->segments;

        return isset($segments[$segment-1]) ? $segments[$segment-1]:false;
    }

    /**
     * get the server variable with references or directly
     *
     * @param string $name the name of variable
     * @throws ServerVariableException
     * @return string
     */
    public function __get($name)
    {
        return $this->server->get($name);
    }

    /**
     * generate an json string
     *
     * @param mixed $content
     * @return string
     */
    public function json($content = null){
        return json_encode($content);
    }

    /**
     * check request, if made with ajax return true
     *
     * @return bool
     */
    public function isAjax(){
        return strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest' ? true:false;
    }
}
