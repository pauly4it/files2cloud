<?php namespace App\Domain\Files\Jobs;

use App\Domain\Core\Job;
use App\Domain\Core\NotAuthorizedException;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;

class DisplayHome extends Job implements SelfHandling {

    private $username;

    /**
     * @param $username
     */
    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * Determine if user is logged in and username in URI matches authorized user.
     *
     * @throws NotAuthorizedException
     */
    public function handle()
    {
        if (Auth::check())
        {
            $user = Auth::user();

            if ($user->username == $this->username)
            {
                return ['username' => $this->username];
            }
        }

        // user is either not logged in or the usernames do not match
        throw new NotAuthorizedException('User not yet logged in.');
    }

}