<?php namespace App\Domain\Profiles\Jobs;

use App\Domain\Core\Job;
use App\Domain\Core\NotAuthorizedException;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;

class DisplayLogIn extends Job implements SelfHandling {

    /**
     *
     */
    public function __construct()
    {}

    /**
     * Determine if the user is logged in and can be sent directly to home.
     *
     * @return array
     * @throws NotAuthorizedException
     */
    public function handle()
    {
        // check if user is already authenticated
        if (Auth::check())
        {
            $user = Auth::user();

            return ['username' => $user->username];
        }

        // user is not yet logged in
        throw new NotAuthorizedException('User is not logged in.');
    }

}