<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class CustomErrorException extends Exception
{
    public function __construct($message="Something went wrong",$status=Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($message,$status);
    }
}
