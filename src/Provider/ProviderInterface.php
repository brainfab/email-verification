<?php

namespace Brainfab\EmailVerify\Provider;

use Brainfab\EmailVerify\VerificationResult;

interface ProviderInterface
{
    /**
     * Verify email.
     *
     * @param string $email
     *
     * @return VerificationResult
     */
    public function verify($email);
}
