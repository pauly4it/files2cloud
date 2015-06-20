<?php namespace App\Domain\Files\Services;

use Illuminate\Support\Collection;

class AllFilesFormatter {

    private $formatter;

    /**
     * @param FileFormatter $formatter
     */
    public function __construct(FileFormatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * Format all of a user's uploaded files for return to the client.
     *
     * @param Collection $files
     * @return array
     */
    public function format(Collection $files)
    {
        $data = [];
        foreach ($files as $file)
        {
            $data[] = $this->formatter->format($file);
        }

        return $data;
    }

}