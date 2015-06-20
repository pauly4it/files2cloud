<?php namespace App\Domain\Profiles\Services;

use App\Domain\Core\NotFoundException;
use App\Domain\Profiles\Repositories\UserRepositoryInterface;

class UserExistenceChecker {

    private $userRepo;

    /**
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Check if a user is registered using their username.
     *
     * @param $username
     * @return mixed
     * @throws NotFoundException
     */
    public function check($username)
    {
        $user = $this->userRepo->getByUsername($username);

        if (is_null($user))
        {
            throw new NotFoundException('Invalid username.');
        }

        return $user;
    }

}
