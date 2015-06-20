<?php namespace App\Domain\Files\Jobs;

use App\Domain\Core\Job;
use App\Domain\Files\Services\AllFilesFormatter;
use App\Domain\Files\Services\FileFetcher;
use App\Domain\Profiles\Services\UserExistenceChecker;
use Illuminate\Contracts\Bus\SelfHandling;

class GetUserFiles extends Job implements SelfHandling {

    private $username;

    /**
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Get all of a user's uploaded files.
     *
     * @param UserExistenceChecker $existenceChecker
     * @param FileFetcher $fetcher
     * @param AllFilesFormatter $formatter
     * @return array
     * @throws \App\Domain\Core\NotFoundException
     */
    public function handle(UserExistenceChecker $existenceChecker,
                           FileFetcher $fetcher,
                           AllFilesFormatter $formatter)
    {
        // check if user exists
        $user = $existenceChecker->check($this->username);

        // fetch all files for user
        $files = $fetcher->fetch($user->id);

        // format for return
        $response = $formatter->format($files);

        return $response;
    }

}
