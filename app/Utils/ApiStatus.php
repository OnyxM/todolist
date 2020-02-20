<?php


namespace App\Utils;


class ApiStatus
{
    private $code;
    private $message;
    public const STATUS_OK = "ok";
    public const STATUS_ERR = "error";

    /**
     * ApiStatus constructor.
     * @param string $code
     * @param string $message
     */
    public function __construct(string $code, string $message = "")
    {
        $this->code = $code;
        $this->message = $message;
    }


    public static function ok(string $message = ""){
        return new self(self::STATUS_OK,$message);
    }
    public static function err(string $message = ""){
        return new self(self::STATUS_ERR,$message);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}