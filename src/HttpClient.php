<?php

namespace Brainfab\EmailVerify;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Class HttpClient
 *
 * @method Client get(string|UriInterface $uri, array $options = [])
 * @method Client head(string|UriInterface $uri, array $options = [])
 * @method Client put(string|UriInterface $uri, array $options = [])
 * @method Client post(string|UriInterface $uri, array $options = [])
 * @method Client patch(string|UriInterface $uri, array $options = [])
 * @method Client delete(string|UriInterface $uri, array $options = [])
 * @method Client getAsync(string|UriInterface $uri, array $options = [])
 * @method Client headAsync(string|UriInterface $uri, array $options = [])
 * @method Client putAsync(string|UriInterface $uri, array $options = [])
 * @method Client postAsync(string|UriInterface $uri, array $options = [])
 * @method Client patchAsync(string|UriInterface $uri, array $options = [])
 * @method Client deleteAsync(string|UriInterface $uri, array $options = [])
 */
class HttpClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * HttpClient constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        $configs = array_merge($configs, ['debug' => false]);
        $this->client = new Client($configs);

        $this->serializer = \JMS\Serializer\SerializerBuilder::create()->build();

        \Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            __DIR__.'/../../../jms/serializer/src'
        );
    }

    /**
     * @param ResponseInterface $response
     * @param string            $type DTO class name.
     *
     * @return mixed
     */
    public function decodeResponse(ResponseInterface $response, $type)
    {
        return $this->serializer->deserialize($response->getBody()->getContents(), $type, 'json');
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function encodeRequestData($data)
    {
        return $this->serializer->serialize($data, 'json');
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, array $arguments = [])
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        } else {
            return call_user_func_array([$this->client, $name], $arguments);
        }
    }
}
