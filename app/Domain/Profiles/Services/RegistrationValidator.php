<?php namespace App\Domain\Profiles\Services;

use App\Domain\Core\ValidationException;

class RegistrationValidator {

    /**
     * Check the data passed during registration is valid.
     *
     * @param array $data
     * @throws ValidationException
     */
    public function validate($data = [])
    {
        $validator = \Validator::make($data, [
            'username' => 'required|alpha_num|min:4|max:25|unique:users,username',
            'password' => 'required|min:8|max:60'
        ]);

        if ($validator->fails())
        {
            throw new ValidationException(
                'Validation error.',
                250,
                $validator->messages()
            );
        }
    }

}
