<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\HttpClient;
use Anonym\Components\Route\AsCollector;

/**
 * Class Redirect
 * @package Anonym\Components\HttpClient
 */
class Redirect
{

    /**
     * redirect user to somewhere else
     *
     * @param string $url
     * @param int $time
     */
    public function to($url = '', $time = 0)
    {
        $redirect = new RedirectResponse($url, $time);
        $redirect->send();
    }

    /**
     * redirect user to it referer url
     *
     * @param int $time
     */
    public function back($time = 0){
        $redirect = new RedirectResponse((new Request())->back(), $time);
        $redirect->send();
    }



    /**
     * redirect to a route
     *
     * @param string $name
     * @throws RouteNotFoundException
     */
    public function route($name = ''){
        $routes = AsCollector::getAs();

        if (isset($routes[$name])) {
            $this->to($routes[$name]);
        }else{
            throw new RouteNotFoundException(sprintf('%s Route Not Found'));
        }
    }


    /**
     * register errors
     *
     * @param array $errors
     * @return $this
     */
    public function withErrors($errors = []){
        errorr()->setErrors($errors)->run();

        return $this;
    }
}
