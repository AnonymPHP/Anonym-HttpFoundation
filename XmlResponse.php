<?php
/**
 * Bu Dosya AnonymFramework'e ait bir dosyadýr.
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 */


namespace Anonym\Components\HttpClient;

/**
 * Class XmlResponse
 * @package Anonym\Components\HttpClient
 */
class XmlResponse extends Response implements ResponseInterface
{

    /**
     * Sýnýfý baþlatýr ve içerik ve durum kodunu ayalar
     *
     * @param string $content Ýçerik
     * @param int $statusCode Durum kodu
     */
    public function __construct($content = '', $statusCode = 200)
    {
        parent::__construct($content, $statusCode);
        $this->setContentType('text/xml');
    }

    /**
     *
     * Ýçeriði gönderiri
     *
     */
    public function send()
    {
        parent::send();
    }
}
