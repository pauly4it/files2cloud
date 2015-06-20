<?php namespace App\Domain\Files\Services;

use App\Domain\Files\Repositories\FileRepositoryInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileAdder {

    private $fileRepo;

    /**
     * @param FileRepositoryInterface $fileRepo
     */
    public function __construct(FileRepositoryInterface $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }

    /**
     * Move the uploaded file to the disk and add a file entry for the user.
     *
     * @param $userId
     * @param UploadedFile $file
     * @return mixed
     */
    public function add($userId, UploadedFile $file, $mimeType, $extension, $filename)
    {
        // get file size to save to entry
        $size = $file->getSize();

        // build path to file
        $path = 'user_uploads/' . $userId . '/' . $filename;
        // put file into storage
        Storage::put($path, File::get($file));

        // save file entry
        $entry = $this->fileRepo->create($userId, $filename, $extension, $mimeType, $size);

        return $entry;
    }

}
