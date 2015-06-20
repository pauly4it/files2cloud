<?php namespace App\Domain\Files\Services;

use App\Domain\Core\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileValidator {

    private $_MAX_FILE_SIZE = 50000;

    /**
     * Validate an uploaded file.
     *
     * @param UploadedFile $file
     * @throws ValidationException
     */
    public function validate(UploadedFile $file)
    {
        if (!$file->isValid() OR is_null($file->getClientSize()))
        {
            throw new ValidationException('Selected file is invalid.');
        }

        if ($file->getClientSize() > $this->_MAX_FILE_SIZE)
        {
            throw new ValidationException('Selected file is too large. A maximum file size of 50KB is allowed.');
        }
    }

}
