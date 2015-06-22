<?php namespace App\Domain\Files\Services;

use App\Domain\Core\NotFoundException;
use App\Domain\Files\Repositories\FileRepositoryInterface;

class FileExistenceChecker {

    private $fileRepo;

    /**
     * @param FileRepositoryInterface $fileRepo
     */
    public function __construct(FileRepositoryInterface $fileRepo)
    {
        $this->fileRepo = $fileRepo;
    }

    public function check($userId, $filename)
    {
        $entry = $this->fileRepo->getByUserIdAndFilename($userId, $filename);

        if ( ! $entry )
        {
            throw new NotFoundException('The file you tried to download was not found.');
        }

        return $entry;
    }

}