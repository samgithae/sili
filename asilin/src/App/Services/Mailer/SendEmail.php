<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 6/14/17
 * Time: 9:34 AM
 */

namespace App\Services;


class SendEmail
{
    private $receiver;
    private $sender;
    private $message;
    private $subject;
    private $vendor;

    public function __construct($to, $sender)
    {
        $this->receiver=$to;
        $this->sender = $sender;
    }

    public function send(){
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = "From:$this->vendor <$this->sender>";

        $sent = mail($this->receiver, $this->subject, $this->message, implode("\r\n", $headers));
        return $sent ? true : false;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }
}