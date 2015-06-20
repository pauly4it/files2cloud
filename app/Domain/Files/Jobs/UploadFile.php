<?php namespace App\Domain\Files\Jobs;

use App\Domain\Core\Job;
use App\Domain\Files\Services\FileAdder;
use App\Domain\Files\Services\FileFormatter;
use App\Domain\Files\Services\FileValidator;
use App\Domain\Profiles\Services\UserExistenceChecker;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFile extends Job implements SelfHandling {

    private $username;
    private $file;
    private $mimeType;
    private $extension;
    private $filename;

    /**
     * @param $username
     * @param UploadedFile $file
     * @param $mimeType
     * @param $extension
     * @param $filename
     */
    public function __construct($username, UploadedFile $file, $mimeType, $extension, $filename)
    {
        $this->username = $username;
        $this->file = $file;
        $this->mimeType = $mimeType;
        $this->extension = $extension;
        $this->filename = $filename;
    }

    /**
     * Upload a file for a user.
     *
     * @param UserExistenceChecker $existenceChecker
     * @param FileValidator $validator
     * @param FileAdder $fileAdder
     * @return array
     * @throws \App\Domain\Core\NotFoundException
     * @throws \App\Domain\Core\ValidationException
     */
    public function handle(UserExistenceChecker $existenceChecker,
                           FileValidator $validator,
                           FileAdder $fileAdder)
    {
        // check if user exists
        $user = $existenceChecker->check($this->username);

        // check if file is a valid file
        $validator->validate($this->file);

        // add file for user
        $fileAdder->add(
            $user->id,
            $this->file,
            $this->mimeType,
            $this->extension,
            $this->filename
        );

        // add username to data being sent back
        $response['username'] = $this->username;

        return $response;
    }

}
