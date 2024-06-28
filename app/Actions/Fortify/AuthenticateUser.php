<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    public function authenticate($request)
    {
        $username = $request->post(config('fortify.username'));

        $user = Admin::where('username', $username)
            ->orWhere('email', $username)
            ->orWhere('phone', $username)
            ->where('password', $request->post('password'))
            ->first();

        if ($user && Hash::check($request->post('password'), $user->password)) {
            return $user;
        }
        return false;
    }
}
