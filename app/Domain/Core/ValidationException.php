<?php namespace App\Domain\Core;

use Exception;

class ValidationException extends Exception {

    protected $errors;

    public function __construct($message, $code = 400, $errors = null, Exception $previous = null)
    {
        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
