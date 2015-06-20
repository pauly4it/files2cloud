<?php namespace App\Domain\Files\Services;

use App\Domain\Files\Repositories\FileRepositoryInterface;
use App\Domain\Profiles\User;
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
     * @param User $user
     * @param UploadedFile $file
     * @return mixed
     */
    public function add(User $user, UploadedFile $file, $mimeType, $extension, $filename)
    {
        // get file size to save to entry
        $size = $file->getSize();

        // build path to file
        $path = 'user_uploads/' . ($user->username) . '/' . $filename;
        // put file into storage
        Storage::put($path, File::get($file));

        // save file entry
        $entry = $this->fileRepo->create($user->id, $filename, $extension, $mimeType, $size);

        return $entry;
    }

}
