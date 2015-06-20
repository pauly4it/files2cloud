<?php namespace App\Domain\Profiles\Repositories;

interface UserRepositoryInterface {

    /**
     * Create a new user entry.
     *
     * @param $username
     * @param $password
     * @return mixed
     */
    public function create($username, $password);

    /**
     * Get a user entry by ID.
     *
     * @param $userId
     * @return mixed
     */
    public function getById($userId);

    /**
     * Get a user entry by username.
     *
     * @param $username
     * @return mixed
     */
    public function getByUsername($username);

}
