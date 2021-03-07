<?php
use App\Models\User;

if (! function_exists('with_user_id')) {
    /**
     * @param $userIdOrUser
     *
     * @return int
     * @throws \InvalidArgumentException
     */
    function with_user_id($userIdOrUser)
    {
        if (is_numeric($userIdOrUser)) {
            return $userIdOrUser;
        } elseif ($userIdOrUser instanceof User) {
            return $userIdOrUser->id;
        }

        throw new \InvalidArgumentException('The argument must be instance of User or user id.');
    }
}

if (! function_exists('with_user')) {
    /**
     * @param $userIdOrUser
     *
     * @return User
     */
    function with_user($userIdOrUser)
    {
        if ($userIdOrUser instanceof User) {
            return $userIdOrUser;
        }

        return User::where('id', $userIdOrUser)->firstOrFail();
    }
}
