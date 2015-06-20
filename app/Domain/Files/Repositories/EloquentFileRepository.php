<?php namespace App\Domain\Files\Repositories;

use App\Domain\Files\File;

class EloquentFileRepository implements FileRepositoryInterface {

    private $file;

    /**
     * @param File $file
     */
    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function create($userId, $filename, $extension, $mimeType, $size)
    {
        return $this->file->create([
            'user_id' => $userId,
            'filename' => $filename,
            'extension' => $extension,
            'mime' => $mimeType,
            'size' => $size
        ]);
    }

    public function getAllByUserId($userId)
    {
        return $this->file->where('user_id', $userId)->get();
    }

}
