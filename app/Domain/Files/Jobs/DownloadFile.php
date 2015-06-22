<?php namespace App\Domain\Files\Jobs;

use App\Domain\Core\Job;
use App\Domain\Core\NotAuthorizedException;
use App\Domain\Files\Services\FileExistenceChecker;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DownloadFile extends Job implements SelfHandling {

    private $username;
    private $filename;

    /**
     * @param $username
     * @param $filename
     */
    public function __construct($username, $filename)
    {
        $this->username = $username;
        $this->filename = $filename;
    }

    public function handle(FileExistenceChecker $checker)
    {
        // check if user is authorized
        if (Auth::check())
        {
            $user = Auth::user();

            if ($user->username != $this->username)
            {
                throw new NotAuthorizedException('You are not authorized to download that file.');
            }
        }
        else
        {
            throw new NotAuthorizedException('You are not authorized to download that file.');
        }

        // check if the file exists for the user
        $entry = $checker->check($user->id, $this->filename);

        // build the path to the file
        $path = 'user_uploads/' . ($user->username) . '/' . ($this->filename);

        // retrieve file
        $file = Storage::get($path);

        // prepare data to return
        $data = [
            'file' => $file,
            'mime' => $entry->mime
        ];

        return $data;
    }

}