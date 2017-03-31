<?php namespace Sirce\Http\Controllers;

use Sirce\Http\Requests;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Http\Request;
use Sirce\Http\Requests\ProfileUpdateRequest;
use Sirce\Repositories\UserRepository;

class ProfileController extends Controller
{

    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var UserRepository
     */
    private $userRepository;

    function __construct(Guard $auth, UserRepository $userRepository)
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;

        $this->middleware('auth', ['except' => ['show', 'references']]);
    }

    public function show($user_id = NULL)
    {
        $my_profile = FALSE;

        $logged_user = $this->auth->user();

        if($logged_user) {
            if($user_id == NULL || $user_id == $logged_user->id) {
                $my_profile = TRUE;
                $user = $logged_user;

                $references_total = $user->myReferences()->count();
                $references = $user->myReferences()->orderBy('id', 'desc')->take(5)->get();
            }
        }

        if ( ! $my_profile) {
            $user = $this->userRepository->find($user_id);

            $references_total = $user->references()->count();
            $references = $user->references()->orderBy('id', 'desc')->take(5)->get();
        }

        $page_views = $this->userRepository->getNumberOfViews($user);
        $favorited  = $this->userRepository->getNumberOfReceivedFavorites($user);

        return view('profiles.index', compact(
            'user',
            'my_profile',
            'references_total',
            'references',
            'page_views',
            'favorited'
        ));
    }

    /**
     * Show a listing of references created by the user
     *
     * @param $user_id
     *
     * @return Response
     */
    public function references($user_id = NULL)
    {
        $my_profile = FALSE;

        $logged_user = $this->auth->user();

        if($logged_user) {
            if($user_id == NULL || $user_id == $logged_user->id) {
                $my_profile = TRUE;
                $user = $logged_user;

                $references_total = $user->myReferences()->count();
                $references = $user->myReferences()->orderBy('id', 'desc')->take(5)->get();
            }
        }

        if ( ! $my_profile) {
            $user = $this->userRepository->find($user_id);

            $references_total = $user->references()->count();
            $references = $user->references()->orderBy('id', 'desc')->take(5)->get();
        }

        return view('profiles.references', compact(
            'user',
            'my_profile',
            'references_total',
            'references'
        ));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $user = $this->auth->user();

        return view('profiles.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfileUpdateRequest $request
     * @return Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        $user = $this->auth->user();

        $this->userRepository->update($user, $request);

        flash()->success('Your profile was updated successfully!');

        return redirect()->route('profiles.index');
    }

    public function starred()
    {
        $user = $this->auth->user();

        $references = $user->favorites;
        $references_total = $user->favorites->count();

        return view('profiles.starred', compact('user', 'references', 'references_total'));
    }

}
