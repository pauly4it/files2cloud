<?php namespace App\Domain\Files\Repositories;

interface FileRepositoryInterface {

    /**
     * Create a new file entry.
     *
     * @param $userId
     * @param $filename
     * @param $extension
     * @param $mimeType
     * @param $size
     * @return mixed
     */
    public function create($userId, $filename, $extension, $mimeType, $size);

    /**
     * Get all files for a user by their ID.
     *
     * @param $userId
     * @return mixed
     */
    public function getAllByUserId($userId);

}
