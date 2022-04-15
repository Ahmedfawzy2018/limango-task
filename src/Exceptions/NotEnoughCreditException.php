<?php
namespace App\Exceptions;

class NotEnoughCreditException extends \Exception
{
    /**
     * @var string
     */
    protected  $message="Not Enough Credit";

    /**
     * NotEnoughCreditException constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }


}