<?php

namespace Brainfab\EmailVerify;

use Brainfab\EmailVerify\Provider\ProviderInterface;

/**
 * Class EmailVerify.
 */
class EmailVerify
{
    /**
     * @var ProviderInterface
     */
    protected $provider;

    /**
     * EmailVerify constructor.
     *
     * @param ProviderInterface $provider
     */
    public function __construct(ProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param string $email
     *
     * @return VerificationResult
     */
    public function verify($email)
    {
        return $this->provider->verify($email);
    }
}
