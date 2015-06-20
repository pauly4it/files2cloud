<?php namespace App\Domain\Core;

use Exception;

class NotFoundException extends Exception {

    protected $errors;

    public function __construct($message, $code = 404, $errors = null, Exception $previous = null)
    {
        $this->errors = $errors;

        parent::__construct($message, $code, $previous);
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
