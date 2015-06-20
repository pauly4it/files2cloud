<?php namespace App\Domain\Profiles\Services;

use App\Domain\Core\ValidationException;

class UserValidator {

    /**
     * Check if the required parameters for a user were passed.
     *
     * @param array $data
     * @throws ValidationException
     */
    public function validate($data = [])
    {
        $validator = \Validator::make($data, [
            'username' => 'required|alpha_num',
            'password' => 'required'
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
