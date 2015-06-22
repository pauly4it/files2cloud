<?php namespace App\Domain\Profiles\Jobs;

use App\Domain\Core\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;

class LogOut extends Job implements SelfHandling {

    /**
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Log the user out.
     */
    public function handle()
    {
        // check if user is already authenticated
        if (Auth::check())
        {
            Auth::logout();
        }
    }

}