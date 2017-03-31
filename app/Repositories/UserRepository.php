<?php namespace Sirce\Repositories;

use \DB;
use Carbon\Carbon;

use Sirce\Http\Requests\ProfileUpdateRequest;
use Sirce\Models\User;
use Sirce\Services\NewsletterManager;

class UserRepository
{

    protected $newsletterManager;

    /**
     * UserRepository constructor.
     * @param $newsletterManager
     */
    public function __construct(NewsletterManager $newsletterManager)
    {
        $this->newsletterManager = $newsletterManager;
    }


    /**
     * @param $user_id
     *
     * @return mixed
     */
    public function find($user_id)
    {
        return User::findOrFail($user_id);
    }

    /**
     * @param $email
     * @return mixed
     *
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param $email
     * @param $oAuthResource
     * @return mixed
     */
    public function findOAuthUser($email, $oAuthResource)
    {
        return User::where('email', $email)->where('oauth_resource', $oAuthResource)->first();
    }

    public function getAll()
    {
        return User::get();
    }

    public function create($userData, $oAuthResource)
    {
        return User::create([
            'name' => $userData->name,
            'email' => $userData->email,
            'avatar' => $userData->avatar,
            'oauth_resource' => $oAuthResource
        ]);
    }

    /**
     * @param User $user
     */
    public function getNumberOfReceivedFavorites(User $user)
    {
        return DB::table('references')
            ->join('user_favorites', 'user_favorites.reference_id', '=', 'references.id')
            ->where('references.user_id', $user->id)
            ->count();
    }

    public function getNumberOfViews($user)
    {
        return DB::table('references')
            ->where('references.user_id', $user->id)
            ->sum('views');
    }

    /**
     * @param $userData
     * @param $oAuthDriver
     * @param $new_user
     *
     * @return static
     */
    public function findOAuthUserOrCreate($userData, $oAuthDriver, &$new_user)
    {
        /*
         Facebook:
         User {#183 ▼
          +token: "CAAKMrB2QdQQBAI34G9ecwoHm3yDzGM6FdnYZCHeZCzGHtucBQrffe8NASPc09ZAfe7fl85hOtKSkutHOtfHD954EBvNZAOYzmgRVr1Cm9I1k7vwmxfmQUR7BRCOoTGVFIKEOTvpx85shUXZBKOypvr6yGOdZCZBZCAVkthQF19CoEwfLk4GdmUByMfsebkK4U5hsKPzZA435M1i0Yo12XgurO"
          +id: "1093422104016622"
          +nickname: null
          +name: "Vitor Bari Buccianti"
          +email: "ditobari@gmail.com"
          +avatar: "https://graph.facebook.com/v2.2/1093422104016622/picture?type=normal"
          +"user": array:11 [▼
            "id" => "1093422104016622"
            "email" => "ditobari@gmail.com"
            "first_name" => "Vitor"
            "gender" => "male"
            "last_name" => "Bari Buccianti"
            "link" => "https://www.facebook.com/app_scoped_user_id/1093422104016622/"
            "locale" => "en_US"
            "name" => "Vitor Bari Buccianti"
            "timezone" => -2
            "updated_time" => "2014-10-07T20:05:21+0000"
            "verified" => true
          ]
        }

        GitHub:
        User {#241 ▼
          +token: "8675424a08d8f05bdf1fb5ed5be4ebfdaf62cf5b"
          +id: 1184252
          +nickname: "vitorbari"
          +name: "Vitor Bari Buccianti"
          +email: "vitorbari@gmail.com"
          +avatar: "https://avatars.githubusercontent.com/u/1184252?v=3"
          +"user": array:30 [▼
            "login" => "vitorbari"
            "id" => 1184252
            "avatar_url" => "https://avatars.githubusercontent.com/u/1184252?v=3"
            "gravatar_id" => ""
            "url" => "https://api.github.com/users/vitorbari"
            "html_url" => "https://github.com/vitorbari"
            "followers_url" => "https://api.github.com/users/vitorbari/followers"
            "following_url" => "https://api.github.com/users/vitorbari/following{/other_user}"
            "gists_url" => "https://api.github.com/users/vitorbari/gists{/gist_id}"
            "starred_url" => "https://api.github.com/users/vitorbari/starred{/owner}{/repo}"
            "subscriptions_url" => "https://api.github.com/users/vitorbari/subscriptions"
            "organizations_url" => "https://api.github.com/users/vitorbari/orgs"
            "repos_url" => "https://api.github.com/users/vitorbari/repos"
            "events_url" => "https://api.github.com/users/vitorbari/events{/privacy}"
            "received_events_url" => "https://api.github.com/users/vitorbari/received_events"
            "type" => "User"
            "site_admin" => false
            "name" => "Vitor Bari Buccianti"
            "company" => "Tiv Software"
            "blog" => null
            "location" => null
            "email" => "vitorbari@gmail.com"
            "hireable" => false
            "bio" => null
            "public_repos" => 5
            "public_gists" => 0
            "followers" => 0
            "following" => 3
            "created_at" => "2011-11-09T19:10:38Z"
            "updated_at" => "2015-07-30T04:44:30Z"
          ]
        }
         */

        $user = $this->findOAuthUser($userData->email, $oAuthDriver);

        if ($user) {
            return $user;
        }

        $new_user = TRUE;

        return $this->create($userData, $oAuthDriver);

    }

    public function getWeekCreatedCount()
    {
        return User::where('created_at', '>=', Carbon::now()->subWeek())
            ->count();
    }

    public function update(User $user, ProfileUpdateRequest $request)
    {
        $newsletter = $user->getOriginal('newsletter');

        $user->update($request->only(['name', 'location', 'about', 'newsletter']));

        //
        // Newsletter
        //
        if (getenv('APP_ENV') == 'production') {
            if (!$newsletter && $user->newsletter) {
                $this->newsletterManager->subscribe($user);
            } else if ($newsletter && !$user->newsletter) {
                $this->newsletterManager->unsubscribe($user);
            }
        }

        return $user;
    }

    public function getTopAuthros()
    {
        return User::has('references')
            ->with('references')->get()->sortByDesc(function ($user) {
                return $user->references->count();
            })->take(8);
    }

    public function search($needle='')
    {
        $users = User::select(['id', 'name', 'avatar', 'location'])
            ->with('references')
            ->where('users.name', 'like', $needle . '%')
            ->orderBy('users.name')
            ->limit(5)
            ->get();

        $results = [];

        foreach($users as $user)
        {
            $user = $user->toArray();
            $user['references'] = count($user['references']);
            $user['url'] = route('profiles.index', [$user['id']]);

            $results[] = $user;
        }

        return $results;
    }
} 