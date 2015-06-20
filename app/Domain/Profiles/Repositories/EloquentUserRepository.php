<?php namespace App\Domain\Profiles\Repositories;

use App\Domain\Profiles\User;

class EloquentUserRepository implements  UserRepositoryInterface {

    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($username, $password)
    {
        return $this->user->create([
            'username' => $username,
            'password' => bcrypt($password)
        ]);
    }

    public function getById($userId)
    {
        return $this->user->where('id', $userId)->first();
    }

    public function getByUsername($username)
    {
        return $this->user->where('username', $username)->first();
    }

}
