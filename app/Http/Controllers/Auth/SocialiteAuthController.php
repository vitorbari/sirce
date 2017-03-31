<?php namespace Sirce\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Sirce\AuthenticateUser;
use Sirce\AuthenticateUserListener;

class SocialiteAuthController extends Controller implements AuthenticateUserListener
{

    /**
     * @var AuthenticateUser
     */
    private $authenticateUser;
    /**
     * @var Request
     */
    private $request;

    /**
     * @param AuthenticateUser $authenticateUser
     * @param Request          $request
     */
    public function __construct(AuthenticateUser $authenticateUser, Request $request)
    {
        $this->authenticateUser = $authenticateUser;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function login($driver=null)
    {
        $hasCode = $this->request->has('code');

        return $this->authenticateUser->execute($hasCode, $this, $driver);
    }

    /**
     * When a user has successfully been logged in...
     *
     * @param $user
     * @param $new_user
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function userHasLoggedIn($user, $new_user)
    {
        if($new_user)
        {
            flash()->message('Welcome Aboard! Please complete your profile.');

            return redirect()->route('profiles.edit');
        }
        else
        {
            flash()->message('Welcome Aboard!');

            return redirect()->intended('/');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->authenticateUser->logout();

        return redirect('/');
    }

}
