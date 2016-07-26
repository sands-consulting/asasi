<?php

namespace App\Policies;

use Session;
use App\User;

class ProfilePolicy extends BasePolicy
{
    public function show()
    {
        return $this->auth->check();
    }

    public function edit(User $user)
    {
        return $this->auth->check();
    }

    public function update(User $user)
    {
        return $this->edit($user);
    }

    public function resume()
    {
        return Session::has('original_user_id');
    }
}
