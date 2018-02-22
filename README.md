[ViRocket](http://virocket.com) API PHP SDK - Unofficial
========================================================

Installation
------------

Require this package with composer:

`` composer require brainfab/virocket_php_sdk ``

Usage example:
--------------

```php
require_once 'vendor/autoload.php';

session_start();

use Brainfab\ViRocket\ViRocket;

$OAUTH2_CLIENT_ID = 'your client id';
$OAUTH2_CLIENT_SECRET = 'your client secret';

$client = new ViRocket();
$client->setClientId($OAUTH2_CLIENT_ID);
$client->setClientSecret($OAUTH2_CLIENT_SECRET);

if (empty($_SESSION['_token'])) {
    $client->authenticate([
        'grant_type' => 'password',
        'username'   => 'your email',
        'password'   => 'your password',
    ]);

    $_SESSION['_token'] = $client->getAccessToken();
}

if (isset($_SESSION['_token'])) {
    $client->setAccessToken($_SESSION['_token']);
}

$videos = $client->videos->listVideos();

foreach ($videos as $video) {
    echo $video->name . "<br>";
}

```
