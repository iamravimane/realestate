<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserService.
 */
class UserService
{
    public function findById($id)
    {
        $user = User::find($id);

        if(!$user)
        {
            throw new ModelNotFoundException('User is not found by id '. $id);
        }
        return $user;
    }
}
