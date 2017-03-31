<?php namespace Sirce;


interface AuthenticateUserListener {

    /**
     * @param $user
     * @param $new_user
     * @return mixed
     */
    public function userHasLoggedIn($user, $new_user);

}