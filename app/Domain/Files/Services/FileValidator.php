<?php namespace App\Domain\Files\Services;

use App\Domain\Core\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileValidator {

    // set file size to 50KB
    private $_MAX_FILE_SIZE = 50000;

    /**
     * Validate an uploaded file.
     *
     * @param UploadedFile $file
     * @throws ValidationException
     */
    public function validate(UploadedFile $file, $filename)
    {
        // check if the file is a valid file and if the file size is set
        if (!$file->isValid() OR is_null($file->getSize()))
        {
            throw new ValidationException('Selected file is invalid.');
        }

        // check if the file size is too large
        if ($file->getClientSize() > $this->_MAX_FILE_SIZE)
        {
            throw new ValidationException('Selected file is too large. A maximum file size of 50KB is allowed.');
        }

        // check if the file name is composed of printable ASCII characters, Hex values 20-7E
        if (preg_match('/[^\x20-\x7E]/', $filename) == 0)
        {
            throw new ValidationException('Your filename contains non-ASCII characters. Please rename the file and try the upload again.');
        }
    }

}
