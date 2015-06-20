<?php namespace App\Domain\Profiles\Services;

use App\Domain\Profiles\User;

class UserFormatter {

    /**
     * Format the user entry for the client.
     *
     * @param User $user
     * @return array
     */
    public function format(User $user)
    {
        $data = [
            'username' => $user->username
        ];

        return $data;
    }

}
