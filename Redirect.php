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
}