<?php namespace Sirce\Http\Controllers;

use \App;
use SEO;
use Sirce\Repositories\ComponentRepository;
use Sirce\Repositories\ReferenceRepository;
use Sirce\Repositories\UserRepository;

class HomeController extends Controller
{


    /**
     * Show the application home
     *
     * @param ReferenceRepository $referenceRepository
     * @param UserRepository $userRepository
     * @param ComponentRepository $componentRepository
     * @return Response
     */
    public function index(ReferenceRepository $referenceRepository,
                          UserRepository $userRepository,
                          ComponentRepository $componentRepository)
    {
        // stats
        $week_favorited_references = $referenceRepository->getWeekFavoritedCount();
        $week_new_references       = $referenceRepository->getWeekCreatedCount();
        $week_new_users            = $userRepository->getWeekCreatedCount();
        $week_new_components       = $componentRepository->getWeekCreatedCount();

        // panels
        $most_favorited = $referenceRepository->getMostFavorited();
        $most_viewed    = $referenceRepository->getMostViewed();
        $top_authors    = $userRepository->getTopAuthros();

        return view('home.index', compact(
            'week_favorited_references',
            'week_new_references',
            'week_new_users',
            'week_new_components',
            'most_favorited',
            'most_viewed',
            'top_authors'
        ));
    }

    /**
     * Show the about page
     *
     * @return Response
     */
    public function about()
    {
        SEO::setTitle('About');

        return view('pages.about');
    }

    /**
     * Show the privacy policy page
     *
     * @return Response
     */
    public function privacy_policy()
    {
        SEO::setTitle('Application Privacy Statement');

        return view('pages.privacy_policy');
    }

    public function search($type, $term = NULL)
    {
        $app = app();

        $repository = NULL;

        switch ($type) {
            case 'sketches':
                $repository = $app->make('Sirce\Repositories\ReferenceRepository');
                break;

            case 'components':
                $repository = $app->make('Sirce\Repositories\ComponentRepository');
                break;

            case 'boards':
                $repository = $app->make('Sirce\Repositories\BoardRepository');
                break;

            case 'mcus':
                $repository = $app->make('Sirce\Repositories\McuRepository');
                break;

            case 'users':
                $repository = $app->make('Sirce\Repositories\UserRepository');
                break;

            default:
                abort(404);
        }

        $results = $repository->search(trim($term));

        return response()->json($results);
    }

    public function sitemap()
    {
        $boardRepository        = App::make('Sirce\Repositories\BoardRepository');
        $componentRepository    = App::make('Sirce\Repositories\ComponentRepository');
        $manufacturerRepository = App::make('Sirce\Repositories\ManufacturerRepository');
        $mcuRepository          = App::make('Sirce\Repositories\McuRepository');
        $referenceRepository    = App::make('Sirce\Repositories\ReferenceRepository');
        $userRepository         = App::make('Sirce\Repositories\UserRepository');

        $sitemap = App::make("sitemap");

        $sitemap->add(route('pages.home'),              NULL, '1.0', 'hourly');
        $sitemap->add(route('pages.about'),             NULL, '0.6', 'weekly');
        $sitemap->add(route('pages.privacy_policy'),    NULL, '0.4', 'monthly');
        $sitemap->add(route('auth.index'),              NULL, '0.6', 'monthly');

        // Boards
        $sitemap->add(route('boards.index'), NULL, '0.9', 'daily');
        foreach($boardRepository->getAll() as $board) {
            $images = [];

            if($board->picture) {
                $images = [
                    ['url' => $board->picture, 'title' => $board->board, 'caption' => ''],
                ];
            }

            $sitemap->add(route('boards.show', $board->id), $board->updated_at, '0.8', 'weekly', $images);
        }

        // Components
        $sitemap->add(route('components.index'), NULL, '0.9', 'daily');
        foreach($componentRepository->getAll() as $component) {
            $images = [];

            if($component->picture) {
                $images = [
                    ['url' => $component->picture, 'title' => $component->component, 'caption' => ''],
                ];
            }

            $sitemap->add(route('components.show', $component->id), $component->updated_at, '0.8', 'weekly', $images);
        }

        // Manufacturers
        foreach($manufacturerRepository->getAll() as $manufacturer) {
            $images = [];

            if($manufacturer->picture) {
                $images = [
                    ['url' => $manufacturer->picture, 'title' => $manufacturer->manufacturer, 'caption' => ''],
                ];
            }

            $sitemap->add(route('manufacturers.show', $manufacturer->id), $manufacturer->updated_at, '0.7', 'weekly', $images);
        }

        // Mcus
        foreach($mcuRepository->getAll() as $mcu) {
            $images = [];

            if($mcu->picture) {
                $images = [
                    ['url' => $mcu->picture, 'title' => $mcu->mcu, 'caption' => ''],
                ];
            }

            $sitemap->add(route('mcus.show', $mcu->id), $mcu->updated_at, '0.8', 'weekly', $images);
        }

        // Sketches
        $sitemap->add(route('sketches.index'), NULL, '1.0', 'hourly');
        foreach($referenceRepository->getAll() as $reference) {
            $images = [];

            if($reference->component->picture) {
                $images[] = ['url' => $reference->component->picture, 'title' => $reference->title, 'caption' => ''];
            }

            foreach($reference->boards as $board) {
                if($board->picture) {
                    $images[] = ['url' => $board->picture, 'title' => $reference->title, 'caption' => ''];
                }
            }

            $sitemap->add(route('sketches.show', $reference->id), $reference->updated_at, '1.0', 'daily', $images);
        }

        // Profiles
        foreach($userRepository->getAll() as $user) {
            $images = [];

            if($user->avatar) {
                $images = [
                    ['url' => $user->avatar, 'title' => $user->name, 'caption' => ''],
                ];
            }

            $sitemap->add(route('profiles.index', $user->id),       $user->updated_at, '0.7', 'weekly',    $images);
            $sitemap->add(route('profiles.sketches', $user->id),    $user->updated_at, '0.9', 'daily',     $images);
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }

}
