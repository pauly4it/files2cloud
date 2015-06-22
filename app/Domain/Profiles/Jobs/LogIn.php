<?php namespace App\Domain\Profiles\Jobs;

use App\Domain\Core\Job;
use App\Domain\Core\NotAuthorizedException;
use App\Domain\Profiles\Services\UserValidator;
use App\Domain\Profiles\Services\UserFormatter;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;

class LogIn extends Job implements SelfHandling {

    private $data;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Log a user in.
     *
     * @param UserValidator $validator
     * @param UserFormatter $formatter
     * @return array
     * @throws NotAuthorizedException
     * @throws \App\Domain\Core\ValidationException
     */
    public function handle(UserValidator $validator,
                           UserFormatter $formatter)
    {
        $credentials = [
            'username' => $this->data['username-login'],
            'password' => $this->data['password-login']
        ];

        // validate user data
        $validator->validate($credentials);

        // authenticate user and remember the user
        if (Auth::attempt($credentials, true))
        {
            // format user object
            return $formatter->format(Auth::user());
        }

        throw new NotAuthorizedException('These credentials do not match our records.');
    }

}
