<?php namespace Sirce;

use Illuminate\Contracts\Auth\Guard AS Authenticator;
use Sirce\Repositories\UserRepository;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthenticateUser
{

    /**
     * @var array
     */
    private $validDrivers = ['facebook', 'github'];

    /**
     * @var string
     */
    private $driver;

    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var Socialite
     */
    private $socialite;

    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * @param UserRepository $users
     * @param Socialite      $socialite
     * @param Authenticator  $auth
     */
    public function __construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    /**
     * @param boolean $hasCode
     * @param AuthenticateUserListener $listener
     * @param $driver
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function execute($hasCode, AuthenticateUserListener $listener, $driver)
    {
        $this->setDriver($driver);

        if (!$hasCode) return $this->getAuthorizationFirst();

        $new_user = FALSE;

        $user = $this->users->findOAuthUserOrCreate($this->getOAuthUser(), $this->driver, $new_user);

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user, $new_user);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    private function getAuthorizationFirst()
    {
        return $this->socialite->driver($this->driver)->redirect();
    }

    /**
     * @return \Laravel\Socialite\Contracts\User
     */
    private function getOAuthUser()
    {
        return $this->socialite->driver($this->driver)->user();
    }

    /**
     * @return \Laravel\Socialite\Contracts\User
     */
    public function logout()
    {
        return $this->auth->logout();
    }

    private function setDriver($driver)
    {
        if( ! in_array($driver, $this->validDrivers)) {
            throw new \Exception('Invalid driver.');
        }

        $this->driver = $driver;
    }

}