<?php namespace App\Domain\Files\Services;

use App\Domain\Files\File;

class FileFormatter {

    /**
     * Format the File entry for return to client.
     *
     * @param File $entry
     * @return array
     */
    public function format(File $entry)
    {
        $data = [
            'filename' => $entry->filename,
            'type' => $entry->mime,
            'size' => $entry->size
        ];

        return $data;
    }

}
