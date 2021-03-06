<?php

require_once 'vendor/autoload.php';

use Brainfab\EmailVerify\EmailVerify;
use Brainfab\EmailVerify\Provider\WhoisxmlapiProvider;

$apiKey = '';//your whoisxmlapi.com API key
$email = 'support@whoisxmlapi.com';//The email address to be verified.

$provider = new WhoisxmlapiProvider($apiKey);//create provider instance
$emailVerify = new EmailVerify($provider);

$result = $emailVerify->verify($email);

var_dump(
    $result->getEmail(),
    $result->getFormatCheck(),
    $result->getSmtpCheck(),
    $result->getDnsCheck(),
    $result->getFreeCheck(),
    $result->getDisposableCheck(),
    $result->getCatchAllCheck(),
    $result->getMxRecords()
);
