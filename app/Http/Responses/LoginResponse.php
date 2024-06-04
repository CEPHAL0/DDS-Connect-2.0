<?php

namespace App\Http\Responses;

use App\Models\User;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    /**
     * @param $request
     * @return mixed
     */

    public function toResponse($request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect("/login");
        }

        if ($user->hasRole("admin")) {
            $home = '/admin';
        } else if ($user->hasRole("moderator")) {
            $home = '/moderator';
        } else {
            $home = '/home';
        }
        return redirect($home);
    }
}