<?php namespace App\Domain\Files\Services;

use App\Domain\Files\Repositories\FileRepositoryInterface;

class FileFetcher {
    
    private $fileRepo;

    /**
     * @param FileRepositoryInterface $fileRepo
     */
    public function __construct(FileRepositoryInterface $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }

    /**
     * Fetch all entries of the user's uploaded files.
     *
     * @param $userId
     * @return mixed
     */
    public function fetch($userId)
    {
        return $this->fileRepo->getAllByUserId($userId);
    }

}
