<?php

namespace Brainfab\EmailVerify\Provider;

use Brainfab\EmailVerify\HttpClient;
use Brainfab\EmailVerify\VerificationResult;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class HunterProvider implements ProviderInterface
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
            'base_uri' => 'https://api.hunter.io'
        ]);
    }

    /**
     * @param string $email
     *
     * @return VerificationResult
     */
    public function verify($email)
    {
        $res = $this->httpClient->get('v2/email-verifier', [
            RequestOptions::QUERY => [
                'api_key' => $this->apiKey,
                'email'   => $email
            ]
        ]);

        return $this->createVerificationResult($res);
    }

    /**
     * @param ResponseInterface $res
     *
     * @return VerificationResult
     */
    protected function createVerificationResult(ResponseInterface $res)
    {
        $data = json_decode($res->getBody()->getContents(), true);
        $verData = $data['data'];
        $result = new VerificationResult();

        $result->setEmail($verData['email']);
        $result->setCatchAllCheck($verData['accept_all']);
        $result->setDisposableCheck($verData['disposable']);
        $result->setFormatCheck($verData['regexp']);
        $result->setFreeCheck($verData['webmail']);
        $result->setSmtpCheck($verData['smtp_check'] && $verData['smtp_server']);

        return $result;
    }
}
