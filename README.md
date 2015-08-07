Anonym-HttpClient
================

Bu açýklamada http client de sahip olunan sýnýflarýn nasýl kullanýldýðýný açýklýyorum.

Response
----------------


```php

$response = new Response('Ýçerik', 200); // durum kodu
// $response = Response::make('Hello World', 200);
// $response->setCharset('UTF-8');
$response->send();

```


**getCookies:**

```php
$cookies = $response->getCookies();
```


Baþlýk Eklemek
-------------

```php

$respone->header('baslik:deger');

```

JsonResponse
-----------

```php

$json = Response::jsonResponse('Hello world', 200);

```