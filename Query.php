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
 * Class Query
 * @package Anonym\Components\HttpClient
 */
class Query
{
    /**
     * $name' e atanan veriye göre $_GET da veri varmı yokmu onu kontrol eder
     *
     * @param string $name
     * @return boolean
     */
    public static function has($name = null)
    {
        if (isset($_GET)) {
            return isset($_GET[$name]);
        }
    }

    /**
     * $name'in $_GET içinde var olup olmadığına bakmazsızın veriyi çağırır
     *
     * @param string $name
     * @return mixed
     */
    public static function get($name)
    {
        return $_GET[$name];
    }

    /**
     * $_GET içinde $name'e $value' i atar;
     *
     * @param string $name
     * @param mixed $value
     */
    public static function set($name, $value)
    {
        $_GET[$name] = $value;
    }

    /**
     * $_GET içinden $name'in değerini siler
     *
     * @param string $name
     */
    public static function delete($name)
    {
        unset($_GET[$name]);
    }

    /**
     * @return mixed
     *
     * Post verilerini döndürür
     */
    public static function getAll()
    {
        if (isset($_GET)) {
            return $_GET;
        } else {
            return false;
        }
    }
}