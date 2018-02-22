<?php

namespace Brainfab\EmailVerify\Provider;

use Brainfab\EmailVerify\HttpClient;
use Brainfab\EmailVerify\VerificationResult;
use GuzzleHttp\RequestOptions;

class WhoisxmlapiProvider implements ProviderInterface
{
    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * WhoisxmlapiProvider constructor.
     *
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;

        $this->httpClient = new HttpClient([
            'base_uri' => 'https://emailverification.whoisxmlapi.com'
        ]);
    }

    /**
     * @param string $email
     *
     * @return VerificationResult
     */
    public function verify($email)
    {
        $res = $this->httpClient->get('/api/v1', [
            RequestOptions::QUERY => [
                'apiKey'       => $this->apiKey,
                'emailAddress' => $email
            ]
        ]);

        return $this->httpClient->decodeResponse($res, VerificationResult::class);
    }
}
