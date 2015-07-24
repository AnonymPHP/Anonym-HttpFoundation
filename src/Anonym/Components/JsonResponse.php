<?php
    namespace Anonym\Components\HttpClient;

    use Anonym\Components\HttpClient\Response;

    /**
     * Bu sınıf AnonymFramework' de kullanılmak üzere tasarlanmıştır, Json Response leri oluşturmak üzere tasarlanmıştır
     * Class JsonResponse
     *
     * @package Anonym\Components\HttpClient
     */
    class JsonResponse extends Response
    {

        /**
         * @param string $content
         * @param int $statusCode
         */

        public function __construct($content = '', $statusCode = 200)
        {

            $this->setContentType('application/json');
            parent::__construct($content, $statusCode);
        }

        /**
         * Yeni bir instance oluşturur
         *
         * @param string $content
         * @param int    $statusCode
         * @return static
         */
        public static function create($content = '', $statusCode = 200)
        {

            return new static($content, $statusCode);
        }
    }
