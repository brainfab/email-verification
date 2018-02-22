<?php

namespace Brainfab\EmailVerify\Provider;

use Brainfab\EmailVerify\HttpClient;
use Brainfab\EmailVerify\VerificationResult;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

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
        $result = new VerificationResult();

        $result->setEmail($data['emailAddress']);
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($result, $method)) {

                if ($value === 'true') {
                    $value = true;
                } elseif ($value === 'false') {
                    $value = false;
                } elseif ($value === 'null') {
                    $value = null;
                }

                call_user_func([$result, $method], $value);
            }
        }

        return $result;
    }
}
