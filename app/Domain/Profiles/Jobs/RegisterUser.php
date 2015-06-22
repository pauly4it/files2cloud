<?php namespace App\Domain\Profiles\Jobs;

use App\Domain\Core\Job;
use App\Domain\Profiles\Repositories\UserRepositoryInterface;
use App\Domain\Profiles\Services\RegistrationValidator;
use App\Domain\Profiles\Services\UserFormatter;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;

class RegisterUser extends Job implements SelfHandling {

    private $data;

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Register a new user.
     *
     * @param RegistrationValidator $validator
     * @param UserRepositoryInterface $userRepo
     * @param UserFormatter $formatter
     * @return array
     * @throws \App\Domain\Core\ValidationException
     */
    public function handle(RegistrationValidator $validator,
                           UserRepositoryInterface $userRepo,
                           UserFormatter $formatter)
    {
        $credentials = [
            'username' => $this->data['username-register'],
            'password' => $this->data['password-register']
        ];

        // validate user data
        $validator->validate($credentials);

        // create user
        $user = $userRepo->create($credentials['username'], $credentials['password']);

        // log user in and remember the user
        Auth::login($user, true);

        // format user object
        return $formatter->format($user);
    }

}
