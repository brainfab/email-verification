<?php

namespace Brainfab\EmailVerify;

use JMS\Serializer\Annotation as JMS;

/**
 * Class VerificationResult.
 */
class VerificationResult
{
    /**
     * The email address to be verified.
     *
     * @JMS\Type("string")
     * @var string
     */
    protected $email;

    /**
     * Lets you know if there are any syntax errors in the email address.
     *
     * @JMS\Type("boolean")
     * @var bool
     */
    protected $formatCheck = false;

    /**
     * Check if the email address exists and can receive emails using SMTP connection
     * and email-sending emulation techniques.
     *
     * @JMS\Type("boolean")
     * @var bool
     */
    protected $smtpCheck = false;

    /**
     * Ensures that the domain in the email address, eg: gmail.com, is a valid domain.
     *
     * @JMS\Type("boolean")
     * @var bool
     */
    protected $dnsCheck = false;

    /**
     * Check to see if the email address is from a free email provider like Gmail or not.
     *
     * @JMS\Type("boolean")
     * @var bool
     */
    protected $freeCheck = false;

    /**
     * Tells you whether or not the email address is disposable (created via a service like Mailinator).
     *
     * @JMS\Type("boolean")
     * @var bool
     */
    protected $disposableCheck = false;

    /**
     * Tells you whether or not this email address is a “catch-all” address.
     * This refers to a special type of address that can receive email for any number of other addresses.
     * This is common in businesses where if you send an email to test@hi.com and another email to test2@hi.com,
     * both of those emails will go into the same inbox.
     *
     * @JMS\Type("boolean")
     * @var bool
     */
    protected $catchAllCheck = false;

    /**
     * Mail servers list.
     *
     * @JMS\Type("array<string>")
     * @var array
     */
    protected $mxRecords = [];

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function getFormatCheck()
    {
        return $this->formatCheck;
    }

    /**
     * @param bool $formatCheck
     */
    public function setFormatCheck($formatCheck)
    {
        $this->formatCheck = $formatCheck;
    }

    /**
     * @return bool
     */
    public function getSmtpCheck()
    {
        return $this->smtpCheck;
    }

    /**
     * @param bool $smtpCheck
     */
    public function setSmtpCheck($smtpCheck)
    {
        $this->smtpCheck = $smtpCheck;
    }

    /**
     * @return bool
     */
    public function getDnsCheck()
    {
        return $this->dnsCheck;
    }

    /**
     * @param bool $dnsCheck
     */
    public function setDnsCheck($dnsCheck)
    {
        $this->dnsCheck = $dnsCheck;
    }

    /**
     * @return bool
     */
    public function getFreeCheck()
    {
        return $this->freeCheck;
    }

    /**
     * @param bool $freeCheck
     */
    public function setFreeCheck($freeCheck)
    {
        $this->freeCheck = $freeCheck;
    }

    /**
     * @return bool
     */
    public function getDisposableCheck()
    {
        return $this->disposableCheck;
    }

    /**
     * @param bool $disposableCheck
     */
    public function setDisposableCheck($disposableCheck)
    {
        $this->disposableCheck = $disposableCheck;
    }

    /**
     * @return bool
     */
    public function getCatchAllCheck()
    {
        return $this->catchAllCheck;
    }

    /**
     * @param bool $catchAllCheck
     */
    public function setCatchAllCheck($catchAllCheck)
    {
        $this->catchAllCheck = $catchAllCheck;
    }

    /**
     * @return array
     */
    public function getMxRecords()
    {
        return $this->mxRecords;
    }

    /**
     * @param array $mxRecords
     */
    public function setMxRecords(array $mxRecords)
    {
        $this->mxRecords = $mxRecords;
    }
}
